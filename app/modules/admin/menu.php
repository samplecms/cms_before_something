<?php
namespace app\modules\admin;
class menu extends base_auto{
	
	 
	public function init(){
		parent::init();
		$this->obj = $this->model = obj('app\models\menu');
	}

	function sort(){

		$t = $_POST['t'];

		$n = count($t);

		foreach($t as $v){
			$this->model->update(['_id'=>new \MongoId($v)],['sort'=>$n]);
			$n--;
		}

		echo json_encode(['status'=>1,'msg'=>__('Success'),'label'=>__('Info')]);

	}

	function ajax(){
		 $key = trim($_GET['key']);
		 $limit = 15;
		 $a = obj('app\models\post')->find(['title'=>new \MongoRegex("/$key/i")])->limit($limit);
		 foreach($a as $v){
		 	$list[] = [
		 		'id'=>(string)$v['_id'],
		 		'title'=>$v['title'],
		 	];
		 }

		 $a = obj('app\models\category')->find(['title'=>new \MongoRegex("/$key/i")])->limit($limit);
		 foreach($a as $v){
		 	$list[] = [
		 		'id'=>(string)$v['_id'],
		 		'title'=>$v['title'],
		 	];
		 }
		 
		  exit(json_encode($list));
	}


	function index(){
			
			$r = $this->model->pager([
					'url'=>'admin/menu/index',
					'sort'=>[
						'sort'=>-1,
						'_id'=>1,
					],
					'size'=>100,

				]);

			
		 	$r['list'] = 1;
			return view('menu',$r);
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
 
		flash('success',__('Action Success'));
		redirect(url('admin/menu/index',$_GET));
	}
	
	function view(){
		$data = [];
		
		$id = $_GET['id'];
		if($id){
			$model = $this->model;
			$data['data'] = $model->one(['_id'=>new \MongoId($id)]);
		}
		if(is_post()){
			$model = $this->model;
			if(!$_POST['pid']){
				$_POST['pid'] = '0';
			}
			$url = url('admin/menu/index',$_GET);
			if($id){
				$r = $model->updateValidate();
					 
				if($r['errors']){
					exit(json_encode(['msg'=>$r['errors']]));
				}else{
					flash('success',__('Update Action Success'));
					
					
					exit(json_encode(['msg'=>$r['errors'],'go_to'=>$url]));
					
					
				}
			}else{
				$r = $model->insertValidate();
				if($r['errors']){
					exit(json_encode(['msg'=>$r['errors']]));
				}else{
					flash('success',__('Create Action Success'));
					exit(json_encode(['msg'=>$r['errors'],'go_to'=>$url]));
					
				}
			}
			
		}
	
		$data['view']  = 1;
		$data['category'] = $this->model->getTree($data['data']->pid);
		return view('menu',$data);
	}
	
	 
	
	
}