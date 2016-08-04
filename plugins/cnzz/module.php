<?php
 
namespace plugin\cnzz;
use hook;
class module{
	
	function init(){
		hook::add('page.footer','plugin\cnzz\module@action');
	}

	function action(&$arg){
	 
	 
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'cnzz']);
		$code = $one['value'];
		if(!$code){
			 
			return;
		}
		 
		echo "<div style='display:none'>".$code."</div>";
	}
	 
	function admin(){
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'cnzz']);
	 	if($_POST){
	 		//$t = htmlspecialchars($_POST['cnzz']);
	 		$t = ($_POST['cnzz']);
	 		if($t){
	 			
	 			if(!$one){
	 				$obj->insert(['type'=>'cnzz','value'=>$t]);
	 			}else{
	 				$obj->update(['_id'=>$one['_id']],['type'=>'cnzz','value'=>$t]);
	 			}
	 			flash('success',__('Action Success'));
	 			redirect(plugin_url('cnzz','admin'));
	 		}
	 	}
		return view(__DIR__.'/views/index.php',['value'=>$one['value']]);
	}
}