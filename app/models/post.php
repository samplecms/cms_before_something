<?php namespace app\models;
class post extends base{
	
	public $tb = 'post';
	
	public $allowFields = [
		'title',
		'body',
		'category',
		'status',
		'slug',
		'top',
		'file',
		'status',
		'sort',
		 
	];

	public $int = [
		'status',
	];
	
	public $validate = [
		'title'  => 'required',
		'body'  => 'required',
	];
	
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
	];

	public function beforeInsert($data,$condition = null){
		
		$this->data['sort'] = microtime(true);
	}
	

}