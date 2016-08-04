<?php
define('WEB',__DIR__);
define('BASE',realpath(__DIR__.'/../'));  

include '../vendor/autoload.php';

use core\router;

//默认的namespace 自动会加上的
router::$module = 'app\modules';

view_module_path('app/modules');
 
try{
	echo router::run();  
}catch(Exception $e){
	 
	hook::listen('index_error');
	
	dump($e->getMessage());
	 
}

