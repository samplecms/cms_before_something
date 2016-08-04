<?php
namespace app\comm;
use app\models\menu;
class front{


	static function menu(){

		$model = obj('app\models\menu');

		$new = $model->find(['pid'=>'0','status'=>1])->sort(['sort'=>-1,'_id'=>1]);
 		foreach ($new as $key => $value) {
 			$m[$value['title']] = ['url'=> url('home/page/index',['tag'=>$value['slug']]),'tag'=>$value['slug'] ];
 		}
		return $m;

	}

 




}