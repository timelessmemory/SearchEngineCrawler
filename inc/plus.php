<?php
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */
if(!defined("a")) exit("Error 001");

$s_q = strtolower($q);

include(ROOT_PATH.'/data/huoduan.plus.php');
function plusecho($str,$q=''){
	if(strpos($str,'class="g"')){
		$title = huoduan_get_body($str,'class="s">','</a>',1);
		$title1 = str_ireplace($q,'<em>'.$q.'</em>',$title);
		$str = str_ireplace($title,$title1,$str);
		
		$des = huoduan_get_body($str,'class="std">','</div>',1);
		$des1 = str_ireplace($q,'<em>'.$q.'</em>',$des);
		$str = str_ireplace($des,$des1,$str);
		
	}
	$str = str_replace('{$q}',$q,$str);
	$str = str_replace('{q}',$q,$str);
	return $str;
}
$pluscontent='';
$plussidebar = '';
$plusnum = '';
if(is_array($plus['type']) && $p==1){
	
	foreach($plus['type'] as $k=>$v){
		if($v==1){
			if(strpos($plus['key'][$k],'|')){
				$keys = explode('|',$plus['key'][$k]);
				foreach($keys as $kk=>$vv){
					if($s_q==strtolower($vv)){
						$pluscontent[] = plusecho($plus['value'][$k],$q);
						$plusnum[] = $plus['num'][$k];
						$plussidebar[] = $plus['value1'][$k];
						if(!isset($plus['user'][$k])){
							$plususer[] = 2;
						}else{
							$plususer[] = $plus['user'][$k];
						}
						break;
					}
				}
			}else{
			   if($s_q==strtolower($plus['key'][$k])){
					$pluscontent[] = plusecho($plus['value'][$k],$q);
					$plusnum[] = $plus['num'][$k];
					$plussidebar[] = $plus['value1'][$k];
					if(!isset($plus['user'][$k])){
							$plususer[] = 2;
						}else{
							$plususer[] = $plus['user'][$k];
						}
					//break;
				}	
			}
			
		}else if($v==2){
			if(strpos($plus['key'][$k],'|')){
				$keys = explode('|',$plus['key'][$k]);
				foreach($keys as $kk=>$vv){
					if(strpos($s_q,strtolower($vv))>-1){
						$pluscontent[] = plusecho($plus['value'][$k],$q);
						$plusnum[] = $plus['num'][$k];
						$plussidebar[] = $plus['value1'][$k];
						if(!isset($plus['user'][$k])){
							$plususer[] = 2;
						}else{
							$plususer[] = $plus['user'][$k];
						}
						break;
					}
				}
			}else{
				if(strpos($s_q,strtolower($plus['key'][$k]))>-1){
					$pluscontent[] = plusecho($plus['value'][$k],$q);
					$plusnum[] = $plus['num'][$k];
					$plussidebar[] = $plus['value1'][$k];
					if(!isset($plus['user'][$k])){
						$plususer[] = 2;
					}else{
						$plususer[] = $plus['user'][$k];
					}
					//break;
				}
			}
		}else if($v==3){
			$plus['key'][$k] = str_replace('\\\\','\\',$plus['key'][$k]);
			if(preg_match($plus['key'][$k],$q)){
				$pluscontent[] = plusecho($plus['value'][$k],$q);
				$plusnum[] = $plus['num'][$k];
				$plussidebar[] = $plus['value1'][$k];
				if(!isset($plus['user'][$k])){
					$plususer[] = 2;
				}else{
					$plususer[] = $plus['user'][$k];
				}
				//break;
			}
		}
	}
	
}

?>
