<?php
namespace app\models;
class category extends _tree{
	public $tb = 'categroy';
	//public $tbVersion = "version_configs";
	/**
	 * 允许保存到数据库的字段 
	 * @var array $allowFields
	 */
	public $allowFields = [
		'title',
		'slug',
		'status',
		'pid',
		'sort',
	];
	/**
	 * INT类型的字段说明
	 * @var unknown
	 */
	public $int = [
			'status','sort',
	];
	/**
	 * 验证规则 
	 * @var unknown
	 */
	public $validate = [
		
		'title'=>'required',
		'slug'  => 'required|unique(categroy,slug)',
	];
	/**
	 * 验证错误提示信息
	 * @var array $validateMessage
	 */
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空啊啊',
					
				],
		'slug'  => [
					'required'=>'内容不能为空',
					'unique'=>'已存在标识',
			],
		 
		 
	];
	
	 
	
	
}