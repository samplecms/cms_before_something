<?php
namespace app\modules\admin;

class plugin extends base{
	
	public $allowAction = [
		
		'load',
		
	];


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



	function load(){
		$name = $_GET['name'];
		$action = $_GET['action'];
	 	$cls = "plugin\\$name\module";
	 	$obj =	new $cls;
	 	
	 	return $obj->$action();
	}
	public function init(){
		parent::init();
		$this->obj = $this->model = obj('app\models\plugin');
	}


	function status(){
 

		if($this->disable === true){
			return;
		}
		if(!$_GET['id']){
			return;
		}
		$condition = ['_id'=>new \MongoId($_GET['id'])];
		$one = $this->model->findOne($condition);
		$s = $one['status']==1?0:1;
	 
		
		$this->model->update($condition,['status'=>(int)$s]);



		$all  = $this->model->find(['status'=>1]);
		if($all){
			foreach($all as $v){
				$pl[] = $v['key'];
			}
		}

		$r = include BASE.'/plugins/'.$one['key'].'/info.php';
		if($r['menu']){
			if($s==1){
				$up = db('plugins_menu')->findOne(['key'=>$one['key']]);
				if(!$up){
					  
					db('plugins_menu')->insert(['key'=>$one['key'],'menu'=>[$one['key']=>$r['menu'] ] ]);
				}
			}else{
				db('plugins_menu')->remove(['key'=>$one['key']]);
			}
		}

		


		file_put_contents(BASE.'/config/plugins.php',"<?php \n return ".var_export($pl, true).";");

		


 
		flash('success',__('Action Success'));
		redirect(url('admin/plugin/index'));
	}


	function index(){
				
		  $dir = BASE.'/plugins/';
		  $list = scandir($dir);
		  foreach ($list as $key => $value) {
		  		if(!in_array($value,['.','..','.svn','.git'])){
		  			$file = $dir.$value.'/info.php';
		  			if(file_exists($file)){
		  				$d = include $file;
		  				if($d['title']){
		  					//
		  					if(!$this->model->findOne(['key'=>$value])){
		  							$this->model->insert([
		  									'key'=>$value,
		  									'title'=>$d['title'],
		  									'author'=>$d['author']?:'author',
		  									'connection'=>$d['connection']?:'connection',
		  								]);
		  					}



		  				}


		  			}
		  			$ps[$value] = $value;
		  		}
		  }

		  

			$r = $this->model->pager(['sort'=>['sort'=>-1,'_id'=>-1] , 'size'=>100,'url'=>'admin/plugin/index'] );
			$r['ps'] = $ps;
			return view('plugin',$r);


	}
	
	function edit(){
		$data = [];
		
		$id = $_GET['id'];
		if($id){
			$model = $this->model;
			$data['output'] = $model->one(['_id'=>new \MongoId($id)]);
		}
		if(is_post()){
			$model = $this->model;
			if($id){
				$r = $model->updateValidate();
					 
				if($r['errors']){
					$data['error'] = $r['errors'];
				}else{
					flash('success',__('Update Action Success'));
					redirect(url('admin/plugin/index',$_GET));
					
				}
			}else{
				$r = $model->insertValidate();
				if($r['errors']){
					$data['error'] = $r['errors'];
				}else{
					flash('success',__('Create Action Success'));
					redirect(url('admin/plugin/index',$_GET));
					
				}
			}
			
		}
	
	
		return view('plugin',$data);
	}
	
	 
	
	
}