<?php
namespace app\controllers;
class front{


	function __construct(){  
		$this->init();
	}
	function init(){
		\hook::listen('front.action.init');
	}
}