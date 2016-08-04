<?php
namespace app\comm;
class plugin{
	
  static function admin_menu(){ 
      $all = db('plugin')->find(['status'=>1])->sort( ['sort'=>-1,'_id'=>-1] );

      foreach($all as $v){
        $sort[$v['key']] = $v['key'];
      }
 


  		$all = db('plugins_menu')->find();
      foreach($all as $v){  
        $new[$v['key']] = $v;
      }



      foreach($sort as $k=>$v){
         if($new[$k]){
            $out[] = $new[$k];
         }
      }



  		foreach($out as $v){ 
  			foreach($v['menu'] as $key=>$vo){
  				foreach($vo as $v1){
  					$url[plugin_url($key,$v1['action'])] = $v1['title'];	
  				}
  				
  				 
  			}
  		}
  		return $url;

  }

}