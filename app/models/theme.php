<?php
namespace app\models;
class theme extends base{
	public $tb = 'theme';
	 
	/**
	 * 允许保存到数据库的字段 
	 * @var array $allowFields
	 */
	public $allowFields = [
		'title',
		'key',
		'author',
		'connection',
		'admin',
		'status',
	];
	/**
	 * INT类型的字段说明
	 * @var unknown
	 */
	public $int = [
			'status'
	];
	/**
	 * 验证规则 
	 * @var unknown
	 */
	public $validate = [
		'title'=>'required',
		'key'=>'unique(plugin,title)',
	];
	/**
	 * 验证错误提示信息
	 * @var array $validateMessage
	 */
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空啊啊',
					'unique'=>'已存在设置标题',
				],
		 
		 
		 
	];
	
	
  
 
}