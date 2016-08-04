<?php 
	
function plugin_url($name,$action = null,$arg = []){
	if($action)
		return url('admin/plugin/load',['name'=>$name,'action'=>$action]+$arg);
	return 'admin/plugin/load';
}
//languages translate
function __($key){
	static $out;
	$lang = config('app.lang');
	if(!$out){
		$r = db('langs')->find(['lang'=>$lang]);
		foreach($r as $v){
			$out[trim($v['title'])] = trim($v['body']);
		}
	}
	return $out[$key]?:$key;
}
 


function db_config($key){
	return db('configs')->findOne(['title'=>$key])['body'];
}
//plugin 使用
function plugin(){
	$data = ob_get_contents();
    ob_end_clean();
    return $data;
}

function h($str){
	return strip_tags($str);
}

function load_plugins(){
	$plugins = db('plugin')->find()->sort(['sort'=>-1,'_id'=>-1]);

	
	foreach($plugins as $v){
		$key = $v['key'];
		if(!$key){
			continue;
		}
		$cls = '\plugin\\'.$key.'\module';
		$obj = obj($cls);
		if(method_exists($obj, 'init')){
			$obj->init();
		}
	}
	
}