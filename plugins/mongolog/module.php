<?php
 
namespace plugin\mongolog;
use hook;
class module{
	 
	function init(){

			
	}

	static function plugin_mongolog_array($v){
			$vo['ns'] = $v['ns'];
			$vo['query'] = $v['query'];
			$vo['op'] = $v['op'];
			$vo['client'] = $v['client'];
			$vo['ts'] = $v['ts'];
			$vo['millis'] = $v['millis'].'毫秒';
			return $vo;
	}
	 
	
	function admin(){
		$pr = 'system.profile';
		
		
		$data = pager($pr,[
				'url'=>plugin_url('mongolog'),
				'sort'=>['ts'=>-1]
		]);

		return view(__DIR__.'/views/index.php',$data);
	}
}