<?php
namespace app\modules\admin;
class base extends \app\controllers\admin{
	
	 
	public $model;
	 
	public $allowAction = [
	    
	];
	function init(){
		
		if(in_array(ip(),['127.0.0.1','::1'])){
			$this->allowAction = ['*'];
		}
		
		parent::init();
	}
	
	
	
}