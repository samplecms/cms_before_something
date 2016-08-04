<?php

namespace app\modules\home;
class page extends \app\controllers\front{


	function view(){

			$id = $_GET['id'];
			 
			$model = obj('app\models\post');
			$post  = $data['post'] = $model->one(['_id'=>new \MongoId($id)]);
			$view = '/view';
			
			return view($view,$data);
	}

	function index(){

			$id = $_GET['tag'];
			$model = obj('app\models\menu'); 
			$one = $model->one(['slug'=>$id]);
			$value = $one['value'];
			if($value){

					if(strpos($value,'|')!==false){
						$value = substr($value,strpos($value,'|')+1);
						
					}
					$model = obj('app\models\post');
					$post  = $data['post'] = $model->one(['_id'=>new \MongoId($value),'status'=>1]);
					$view = '/view';
					if(!$post){
						
						$data = $model->pager([
								'condition'=>['category'=>$value,'status'=>1],
								'sort'=>['top'=>-1,'sort'=>-1,'_id'=>-1]
							]);

						

						$view = '/lists';
					}

			}


			return view($view,$data);


	}


 }
