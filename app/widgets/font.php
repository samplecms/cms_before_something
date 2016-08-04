<?php
namespace app\widgets;
/**  
 * 
 * @author SUN KANG
 *
 */
 
class  font extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('Font-Awesome-4.6.3');
		 
		$this->cssLink[] = $baseUrl.'css/font-awesome.css';
		 
		
	}
	
}

 