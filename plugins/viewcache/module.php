<?php
 
namespace plugin\viewcache;
use hook;
class module{
	
	function init(){
		hook::add('front.action.init','plugin\viewcache\module@action');
	}

	function action(&$arg){
	 
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'viewcache']);
		$time = $one['value']['time'];

		if($time){
			
		 	view_cache((int)$time);
			return;
		}
		 
	}

	
	function admin(){
		if($_GET['cache']==1){
			$dir = WEB.'/cache/';
			\file::rmdir($dir);

			flash('success',__('Cache Cleaning Success'));
	 		redirect(plugin_url('viewcache','admin'));

			exit;
		}
		
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'viewcache']);
	 	if($_POST){
	 		$t = $_POST['viewcache'];
	 		if($t){
	 			
	 			if(!$one){
	 				$obj->insert(['type'=>'viewcache','value'=>$t]);
	 			}else{
	 				$obj->update(['_id'=>$one['_id']],['type'=>'viewcache','value'=>$t]);
	 			}
	 			flash('success',__('Action Success'));
	 			redirect(plugin_url('viewcache','admin'));
	 		}
	 	}
		return view(__DIR__.'/views/index.php',['value'=>$one['value']]);
	}
}