<?php
 
namespace plugin\cdn;
use hook;
class module{
	

	public function init(){
		hook::add('page.end','plugin\cdn\module@action');
	}

	function plugin_cdn_script($content){  
        $preg = "/<\s*script\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i";
        preg_match_all($preg,$content,$out);
        return $out[2];  
	}
	function plugin_cdn_linkStyle($content){ 
	        $preg = "/<\s*link\s+[^>]*?href\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i";
	        preg_match_all($preg,$content,$out);
	        return $out[2];  
	    
	}

	function action(&$par){
		$data = ob_get_contents();
		ob_end_clean();
		 
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'cdn']);
		$cdn = $one['value']['url'];
		if(!$cdn){
			echo $data;
			return;
		}
		$img = \app\comm\img::get_local_all($data);
		
		if($img){
			foreach ($img as $v){
				if(strpos($v,'://')!==false){
					continue;
				}
				$data = str_replace($v,$cdn.$v,$data);
			}
		}

		if($one['value']['css']){
			unset($s2);
			$s2 = $this->plugin_cdn_linkStyle($data);
			if($s2){
				foreach ($s2 as $v){
					if(strpos($v,'://')!==false){
						continue;
					}
					$data = str_replace($v,$cdn.$v,$data);
				}
			}

		}
		if($one['value']['js']){
				unset($s2);
				$s2 = $this->plugin_cdn_script($data);
				if($s2){
					foreach ($s2 as $v){
						if(strpos($v,'://')!==false){
							continue;
						}
						$data = str_replace($v,$cdn.$v,$data);
					}
				}

		}


		echo $data;
	}
	 
	function admin(){
		$obj = obj('app\models\plugin_option');
		$one = $obj->findOne(['type'=>'cdn']);
	 	if($_POST){
	 		$t = $_POST['cdn'];
	 		if($t){
	 			
	 			if(!$one){
	 				$obj->insert(['type'=>'cdn','value'=>$t]);
	 			}else{
	 				$obj->update(['_id'=>$one['_id']],['type'=>'cdn','value'=>$t]);
	 			}
	 			flash('success',__('Action Success'));
	 			redirect(plugin_url('cdn','admin'));
	 		}
	 	}
		return view(__DIR__.'/views/index.php',['value'=>$one['value']]);
	}
}