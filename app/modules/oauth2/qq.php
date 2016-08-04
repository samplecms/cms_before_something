<?php
namespace app\modules\oauth2;
 
class qq extends base{


	 function index(){
 
	 	$user = $this->config('qq');
	 	dump($user);exit;
 
 		$arr['id'] = $user['id'];
 		$arr['avatar_url'] = $user['avatar_url'];
 		$arr['name'] = $user['login'];
 		$this->insert_user($arr);
 		cookie('id',$this->uid,0);
 		cookie('name',$arr['name'],0);

 		if($this->is_admin){
 			return redirect(url('admin/lang/index'));
 		}else{
 			return redirect(url('home/index/index'));
 		}
	 	 

	 }

}