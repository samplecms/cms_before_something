<?php namespace app\models;
class menu extends _tree{
	
	public $tb = 'menu';
	 
	public $allowFields = [
		'title',
		'pid',
		'status',
		'slug',
		'sort',
		'value',
	];
	
	public $int = [
		 'status','sort'
	];
	
	public $validate = [
		'title'  => 'required',
		'slug'  => 'required|unique(menu,slug)',
	];
	
	public $validateMessage = [
		'title'  => [
					'required'=>'菜单名不能为空',
				],
		'slug'  => [
				'required'=>'标识不能为空',
				'unique'=>'已存在标识',
		],
	];
	 
	
	 
}