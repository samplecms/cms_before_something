<?php
 
namespace plugin\title;
use hook;
class module{
	 
	function init(){

			hook::add('system.view.render',"plugin\\title\module@action");
	}

	function action(&$arg=[]){

		

		 $obj = obj('app\models\plugin_option');
		 $one = $obj->findOne(['type'=>'title']); 


		 $uri = $_SERVER['REQUEST_URI'];
		 


		 

		 $value = $one['value'];
		 
		 if($value[$uri]){

		 	$arg['hook'] = $value[$uri] ;
		 	 
		 }
		 


		 $title = $arg['post']['title'];
		 if($title){
		 	$arg['hook'] =  ['title'=>$title,'keywords'=>$title,'description'=>$title];
		 	 
		 }

		 
 

	}


	
	function admin(){
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'title']);
	 	if($_POST){
	 		$t = $_POST['title'];

	 		if($t){
	 			$uri = $t['uri'];
	 			foreach($uri as $k=>$v){
	 				if(!$v){
	 					continue;
	 				}
	 				$new[$v] = [
	 						'title'=>$t['title'][$k],
	 						'keywords'=>$t['keywords'][$k],
	 						'description'=>$t['description'][$k],
	 					]
	 					;
	 			}
	 			
	 			if(!$one){
	 				$obj->insert(['type'=>'title','value'=>$new]);
	 			}else{
	 				$obj->update(['_id'=>$one['_id']],['type'=>'title','value'=>$new]);
	 			}
	 			flash('success',__('Action Success'));
	 			redirect(plugin_url('title','admin'));
	 		}
	 	}
		return view(__DIR__.'/views/index.php',['value'=>$one['value']]);
	}
}