<?php
namespace app\modules\admin;
class logout extends base{
	
	public $accessDeny = [
	 
	];
	
	
	function init(){
		parent::init();
	}
	
	 
	
	function index(){
		cookie_delete(['adminId','adminUser']);
		flash('success','退出成功');
		redirect(url('admin/login/index'));
	}
}