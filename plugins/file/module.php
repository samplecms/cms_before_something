<?php
 
namespace plugin\file;
use hook;
class module{
	
	

	
	function admin(){
		$data = pager('upload',[
			'sort'=>['_id'=>-1],
			'size'=>20,
			'url'=>'admin/plugin/load',
		]);
		 
		return view(__DIR__.'/views/index.php',$data);
	}
}