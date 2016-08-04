<?php
namespace app\modules\admin;

class theme extends base{
	
	
	
	public function init(){
		parent::init();
		$this->model = obj('app\models\theme');
	}


	function status(){
 

		if($this->disable === true){
			return;
		}
		if(!$_GET['id']){
			return;
		}
		$is = 0;
		if($_GET['admin']){
			$is = 1;
		}
		$con = ['admin'=>$is];

		$this->model->updateAll($con,['status'=>0]);
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


		file_put_contents(BASE.'/config/theme.php',"<?php \n return ".var_export($pl, true).";");

		


 
		flash('success',__('Action Success'));
		redirect(url('admin/theme/index'));
	}


	function index(){
				
		  $dir = WEB.'/themes/';
		  $list = scandir($dir);
		  foreach ($list as $key => $value) {
		  		if(!in_array($value,['.','..','.svn','.git'])){
		  			$file = $dir.$value.'/info.php';
		  			if(file_exists($file)){
		  				$d = include $file;
		  				if($d['title']){
		  					//
		  					if(!$this->model->findOne(['key'=>$value])){
		  						$is = 0;
		  						if(strpos($value,'admin')!==false){
		  							$is = 1;
		  						}
		  							$this->model->insert([
		  									'key'=>$value,
		  									'title'=>$d['title'],
		  									'admin'=>$is,
		  									'author'=>$d['author']?:'author',
		  									'connection'=>$d['connection']?:'connection',
		  								]);
		  						
		  					}



		  				}


		  			}
		  		}
		  }

		  

			$r = $this->model->pager(['sort'=>['status'=>-1]]);
			 
			return view('theme',$r);


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
	
	
		return view('theme',$data);
	}
	
	 
	
	
}