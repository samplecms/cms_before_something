<?php namespace app\models;
class oauth extends base{
	
	public $tb = 'oauth';
	
	public $allowFields = [
		'oauth_id',
		'type',
		'is_admin',
		'avatar_url',
		'id',
		'name',
		'created',
	];
	/*
	public $validate = [
		'oauth_id'  => 'required',
		'extension'  => 'required',
	];
	
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
	];*/
	

}