<?php
namespace app\modules\admin;
class login extends base{
	
	public $allowAction = [
		 '*'
	];
	
	
	function init(){ 
		parent::init();
	 
	}
	
	 
	
	function index(){
	 	return view('login');
	}
}