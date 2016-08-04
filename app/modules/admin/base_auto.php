<?php
namespace app\modules\admin;
use app\controllers\admin_auto;
class base_auto extends admin_auto{
	
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