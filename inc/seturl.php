<?php
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */
if(!defined("a")) exit("Error 001");

$ourl = $list['data'][$ni]['link'];
//seturl
if(is_file(ROOT_PATH.'/data/huoduan.seturl.php')){
  include(ROOT_PATH.'/data/huoduan.seturl.php');
  if(is_array($seturl['type'])){
	  foreach($seturl['type'] as $k=>$v){
		if($v==1){
			if(clear_url($ourl)==clear_url($seturl['oldurl'][$k])){
				$list['data'][$ni]['link'] = newurl($ourl,$seturl['newurl'][$k]);
			}
			
		}else if($v==2){
			if(strpos($ourl,$seturl['oldurl'][$k])>-1){
				$list['data'][$ni]['link'] = newurl($ourl,$seturl['newurl'][$k]);
			}
		}
		
	  }
  }
}


?>
