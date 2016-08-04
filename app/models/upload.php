<?php namespace app\models;
class upload extends base{
	
	public $tb = 'upload';
	
	public $allowFields = [
		'path',
		'extension',
		'mime',
		'size',
		'hash'
	];
	
	public $validate = [
		'path'  => 'required',
		'extension'  => 'required',
	];
	
	/*public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
	];*/
	

}