<?php
namespace app\models;

class base extends \core\models\base{
	public $tbVersion;
	 


	function insertValidate($data=[]){
		if($this->tbVersion){
			$data['version'] = date('YmdHis');
			db($this->tbVersion)->insert($data);
		}
		return parent::insertValidate($data);
	}
	
	function updateValidate($condition=[] , $data=[]){
		if($this->tbVersion){
			$data['version'] = date('YmdHis');
			db($this->tbVersion)->insert($data);
		}
		return parent::updateValidate($condition,$data);
	}

	function save($data){
		if($data['_id']){
			$con = ['_id'=>new \MongoId($data['_id']) ];
			unset($data['_id']);
			$a = $this->updateValidate($con,$data);
		}else{
			$a = $this->insertValidate($data);	
		}
		return $a;
	}

	
	
	 

	
}