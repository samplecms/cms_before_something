<?php
namespace app\modules\post;
use app\modules\admin\base_auto;
use app\models\category as PostModel;
class type extends base_auto{
	
	 
	public $obj;
	//跳转
	public $jump = 'post/type/index';
	//分页
	public $per_page = 10;
	//列表页排序 
	public $sort = ['sort'=>-1,'_id'=>1];
	//列表页查寻条件
	public $condition = [];
	//当前视图
	public $view = 'index';
	
	function init(){
		parent::init();
		$this->obj = new PostModel;
	}
	

	function sort(){

		$t = $_POST['t'];

		$n = count($t);

		foreach($t as $v){
			$this->obj->update(['_id'=>new \MongoId($v)],['sort'=>$n]);
			$n--;
		}

		echo json_encode(['status'=>1,'msg'=>__('Success'),'label'=>__('Info')]);

	}
	
	function view(){
		parent::view();
		$this->data['category'] = $this->obj->getTree($this->data['data']->pid);
		return $this->render($this->view,$this->data);
	}
	
	
}