<?php

namespace plugin\imagecache;
use hook;
class module{
	function init(){
		hook::add('index_error','plugin\imagecache\module@action');
	}


	function action(&$arg){

       $u = $_SERVER['REDIRECT_URL'];
       if(substr($u,0,7)!=='/thumb/'){
       		return;
       }
       
       ini_set('memory_limit','512M');

       $id = substr($u,7);
     

		$dir = WEB.'/thumb/'.$id;
		$ext  = substr($id,strrpos($id,'.'));
		$name = substr($id,0,strpos($id,','));
		$source = WEB.'/upload/'.$name.$ext;
		$str = substr($id,strpos($id,',')+1); 
		$str = substr($str,0,strrpos($str,'.'));
		$arr = explode(',',$str);
		foreach($arr as $vo){
			$v = explode('_',$vo);
			$list[$v[0]] = $v[1];
		}
		$w = $list['w']?:'auto';
		$h = $list['h']?:'auto';
		$ex = substr($dir,0,strrpos($dir,'/'));
		if(!is_dir($ex)) mkdir($ex,0775,true);
		$imagine = new \Imagine\Gd\Imagine();
		// or
		//$imagine = new \Imagine\Imagick\Imagine();
		// or
		//$imagine = new \Imagine\Gmagick\Imagine(); 
		$size    = new \Imagine\Image\Box($w, $h); 
		$mode    = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
		// or
		//$mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND; 
		$imagine->open($source)
		    ->thumbnail($size, $mode)
		    ->save($dir)
		;
		$c = file_get_contents($dir);
		echo $c;
	}

}
