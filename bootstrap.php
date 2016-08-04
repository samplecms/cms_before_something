<?php 
use core\db\mongo;
use core\di;
use core\config;
 


session_start();
 
date_default_timezone_set('Asia/Shanghai');
import(__DIR__.'/app/function.php');

 

 

if(in_array(ip(), ['127.0.0.1','::1'])){
	ini_set('display_errors',1);
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
}else{
	ini_set('display_errors',0);
	error_reporting(0);
}



di::set('mongo',function($c){
	$config = config('db');
	mongo::$server = "mongodb://".$config['host'];
	mongo::$options = array('db'=>$config['db']);
	return new mongo;
});

function db($collection = null){
	return di::get('mongo')->table($collection);
}



function model($class){
	return obj('models\\'.$class);
}


function pager($tb,$par = []){
	$url = $par['url']?:'/posts';
	$size = $par['size']?:10;
	$condition = $par['condition']?:[];
	unset($par['url'],$par['size'],$par['condition']);

	$count = db($tb)
	->count($condition);

	$pageArray =  page($url,$count,$size);
	$data['pager'] = $pageArray['link'];
	$mo = db($tb)
	->find($condition);

	if($par){
		foreach ($par as $k=>$v){
			$mo = $mo->$k($v);
		}
	}
	$mo = $mo->skip($pageArray['offset']);
	$mo = $mo->limit($size);
	$data['datas'] = $mo;
	$data['count'] = $count;
	return $data;
}


///////////////////////////////////////
// 过滤MONGODB ARRAY中的KEY为$的 $_GET POST COOKIE REQUEST
///////////////////////////////////////
function clean_mongo_array_injection(){
	$in = array(& $_GET, & $_POST, & $_COOKIE, & $_REQUEST);
	while (list ($k, $v) = each($in))
	{
		if(is_array($v)){
			foreach ($v as $key => $val)
			{
				if(strpos($key,'$')!==false){
					unset($in[$k][$key]);
					$key = str_replace('$','',$key);
				}
				$in[$k][$key] = $val;
				$in[] = & $in[$k][$key];
			}
		}
	}
}
clean_mongo_array_injection();



if( !headers_sent() &&  
	extension_loaded("zlib") &&  
	strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip"))  
{
  ini_set('zlib.output_compression', 'On');
  ini_set('zlib.output_compression_level', '4');
}





import(__DIR__.'/route.php');	
 