<?php
/**
 * @author  SUN KANG [sunkang@wstaichi.com]
 * @copyright 
 * @version 1.0
 */
namespace core\models\core;
use Violin\Violin;
class validateViolinExt extends Violin
{
	public function errors()
	{
		$messages = [];
		foreach ($this->errors as $rule => $items) {
			foreach ($items as $item) {
				$field = $item['field'];
				$message = $this->fetchMessage($field, $rule);
				// If there is any alias for the current field, swap it.
				if (isset($this->fieldAliases[$field])) {
					$item['field'] = $this->fieldAliases[$field];
				}
				$messages[$field][] = $this->replaceMessageFormat($message, $item);
			}
		}
		return $messages;
	}

  function lang(){
		$lang = [
				'alnum'=>'{field}不是字母或数字',
				'alnumDash'=>'{field}不是字母或下划线',
				'alpha'=>'{field}不是字母',
				'array'=>'{field}不是数组',
				'between'=>'{field}区间{min},{max}',
				'bool'=>'{field}不是布尔类型',
				'email'=>'{field}不是正确的邮件地址',
				'int'=>'{field}不是整型',
				'number'=>'{field}不是数字',
				'ip'=>'{field}不是IP地址',
				'min'=>'{field}最小值为{value}',
				'max'=>'{field}最大值为{value}',
				'matches'=>'{field}匹配错误',
				'url'=>'{field}不是正确的网址',
				'date'=>'{field}时间格式错误',
				'checked'=>'{field}没有选中',
				'required' => '{field}不能为空',
				'regex'      => '字段{field}不符合表达式.',
		];
		return $lang;
	}
    public function __construct()
    {
        $this->addRuleMessage('unique', '已存在相同记录');
    }
	/**
	 * 
	 * unique(users,user)
	 * @param unknown $value
	 * @param unknown $input
	 * @param unknown $args
	 */
	public function validate_unique($value, $input, $args)
	{
		$tb = $args[0];
		$name = $args[1];
		if(!$tb || !$name){
			return true;
		}
		$con = [];
		if($args[2]){
			$con = [$args[2]=>1];
		}
		$one = db($tb)->findOne([$name=>$input[$name]]+$con);
		$flag = true;

		$id = $_GET['id']?:$_POST['id'];
		if($id){
			if($one && (string)$one['_id'] == $id ){  
				$flag = true;
			}else{
				$flag = false;
			}
			
			if(!$one){
				$flag = true;
			}
			
		}elseif($one){
			$flag = false;
		}
		 

		
		return $flag;
	}
	
	
	
	
	
	
}
