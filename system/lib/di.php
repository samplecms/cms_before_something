<?php
namespace core;

use Pimple\Container;

class di{

	static $is_set = [];
	static $container;

	public static function set($name,$c){
		if(self::$is_set[$name]){
			return;
		}
		self::init()[$name] = $c;
		self::$is_set[$name] = true;
	}

	public static function get($name){
		return self::init()[$name];
	}
 	

 	public static function init(){
 		if(!self::$container){
			self::$container = new Container();
		}
		return self::$container;
 	}
	 
	
}