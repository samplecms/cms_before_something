<?php
 
namespace plugin\pageclip;
use hook;
class module{
	public $value;
	function __construct(){
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'pageclip']);
		$this->value = $one['value'];

	}
	function init(){
		
		if($this->value){

			foreach($this->value as $v){ 
				hook::add($v['key'], 'plugin\pageclip\module@hook_'.$v['key']);	
			}
			

		}
		
	}

	function __call($method,$arg){
		$m = str_replace('hook_', '', $method);

		if($this->value){
			foreach($this->value as $v){ 
				if($v['key'] == $m){
					echo $v['value'];
				}
			}
		}

	}


	function action(&$arg){

		dump($arg);
	}

	 
	function admin(){
		 
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'pageclip']);
	 	if($_POST){
	 		$t = $_POST['pageclip'];
	 		if($t){
	 			
	 			$n = count($t['key']);
	 			for($i=0;$i<$n;$i++){
	 				if(!$t['key'][$i] || !$t['value'][$i]){
	 					continue;
	 				}
	 				$new[$i]['key'] = $t['key'][$i];
	 				$new[$i]['value'] = $t['value'][$i];
	 				
	 			}
	 			$t = $new;
	 			 
	 			if(!$one){
	 				$obj->insert(['type'=>'pageclip','value'=>$t]);
	 			}else{
	 				$obj->update(['_id'=>$one['_id']],['type'=>'pageclip','value'=>$t]);
	 			}
	 			flash('success',__('Action Success'));
	 			redirect(plugin_url('pageclip','admin'));
	 		}
	 	}

		return view(__DIR__.'/views/index.php',['value'=>$one['value']]);
	}
}