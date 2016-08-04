<?php

load_plugins();

get('/', function(){
	\hook::listen('front.action.init');
 	$data['posts'] = obj('app\models\post')
 			->find(['file'=>['$exists'=>true]])
 			->limit(20)
 			->sort(['top'=>-1,'sort'=>-1,'_id'=>-1]);
							
	return view('index',$data);
});


 
 


 
get('pages/<tag:\w+>','home/page@index');
get('view/<id:\w+>','home/page@view');



get('admin','admin/plugin@index');