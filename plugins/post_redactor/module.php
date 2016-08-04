<?php
namespace plugin\post_redactor;
use hook;
class module{


	function init(){
		hook::add('post.admin.form','plugin\post_redactor\module@action');		
	}

	function action(&$arg){

        widget('redactor',['ele'=>'#body']);
 
	}

}
