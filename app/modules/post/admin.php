<?php
namespace app\modules\post;
use app\modules\admin\base_auto;
use app\models\post as PostModel;
use app\models\category as CateModel;
class admin extends base_auto{
	
	 
	public $obj;
	//跳转
	public $jump = 'post/admin/index';
	//分页
	public $per_page = 10;
	//列表页排序 
	public $sort = ['top'=>-1,'sort'=>-1,'_id'=>-1];
	//列表页查寻条件
	public $condition = [];
	//当前视图
	public $view = 'index';
	
	function init(){
		parent::init();
		$this->obj = new PostModel;

		\hook::listen('post.admin.index.sort');
		if($sort=\hook::value('sort')){
			$this->sort = $sort;
		}

		
	}
	

	function top(){

		$id = $_GET['id'];
		$con = ['_id'=>new \MongoId($id)];
		$one = $this->obj->findOne($con);
		$s = 1;	 
		if($one['top']==1){
			$s = 0;
		}
		$this->obj->update($con,['top'=>$s]);

		flash('success',__('Action Success'));
		redirect(url('post/admin/index'));

	}



	function sort(){
		$n = $this->obj->count([]);
		$page = (int)$_GET['page'];
		$m = $n-$page*$this->per_page;
		
		$t = $_POST['t'];
 		
		foreach($t as $v){
			$m--;
			
			$this->obj->update(['_id'=>new \MongoId($v)],['sort'=> $m ]);
			
		}

		echo json_encode(['status'=>1,'msg'=>__('Success'),'label'=>__('Info')]);

	}
	
	function index(){
		if(isset($_GET['s'])){
			$condition['status'] = (int)$_GET['s'];
		}
		$q = trim($_GET['q']);
		if($q){
			$condition['$or'] = [ 
					['body'=> new \MongoRegex("/$q/i"),],
					['title'=>new \MongoRegex("/$q/i"),],
			];
		}
		
		
		$this->condition = $condition;
		
		return parent::index();
	}
	
	function view(){
		parent::view();
		$obj = new CateModel;

		$this->data['category'] = $obj->getTree($this->data['data']->pid);
		
		return $this->render($this->view,$this->data);
		
	}
	 
}