<?php
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */
 
function a($str=1){
	return md5($str.'本程序由火端网络开发，官方网站：http://www.huoduan.com，源码唯一销售客服QQ号码：909516866 ，请尊重开发者劳动成果，勿将本程序发布到网上或倒卖，感谢您的支持！');//此信息不影响程序正常使用，请勿修改此处信息，因修改此信息引起的错误，将不提供任何技术支持
}

function myurl(){
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self     = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info    = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url   = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
}

function huoduansourl($q,$p=1,$host=''){
	if($host==''){
	  $host = $_SERVER['HTTP_HOST'];
	}
    if(REWRITE==1){

	  if($p>1){
		  if(strpos(URLRULE2,'{qe}')>-1){
		    $qurl = str_replace('{qe}',qencode($q),URLRULE2); 
		  }else{
			$newq = urlencode($q);
			$newq = str_replace('+','%20',$newq);
			
			$qurl = str_replace('{q}',$newq,URLRULE2);
			if(strpos($q,'/')>-1 || strpos($q,':')>-1 ){
				return HTTP.$host.SYSPATH.'?q='.urlencode($q).'&p='.$p;
			}
		  }
		  $qurl = str_replace('{p}',$p,$qurl);  
		  return HTTP.$host.SYSPATH.$qurl;
	  }else{
		  if(strpos(URLRULE1,'{qe}')>-1){
		     $qurl = str_replace('{qe}',qencode($q),URLRULE1);
		  }else{
			  
			$newq = urlencode($q);
			$newq = str_replace('+','%20',$newq);
		    $qurl = str_replace('{q}',$newq,URLRULE1);
			if(strpos($q,'/')>-1 || strpos($q,':')>-1 ){
				return HTTP.$host.SYSPATH.'?q='.urlencode($q);
			}
	      }
		  return HTTP.$host.SYSPATH.$qurl;
	  }
	}else{
		if($p>1){
			return HTTP.$host.SYSPATH.'?q='.urlencode($q).'&p='.$p;
		}else{
			return HTTP.$host.SYSPATH.'?q='.urlencode($q);
		}
	}
	
}
function clear_url($url){
	$url = strip_tags($url);
	$url = strtolower($url);
	$url = str_replace('http://','',$url);
	$url = str_replace('https://','',$url);
	$url = trim($url,'/');
	return $url;
}
function back404(){
	header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
	echo file_get_contents(ROOT_PATH.'/404.html');
	exit;
}
function sitemapurl($name,$p){
	$host = $_SERVER['HTTP_HOST'];
    if(REWRITE==1){
	  if($p>1){
		  return HTTP.$host.SYSPATH.'sitemap/'.$name.'_'.$p.'.html';
	  }else{
		  return HTTP.$host.SYSPATH.'sitemap/'.$name.'.html';
	  }
	}else{
	  if($p>1){
		  return HTTP.$host.SYSPATH.'?a=sitemap&name='.urlencode($name).'&p='.$p;
	  }else{
		  return HTTP.$host.SYSPATH.'?a=sitemap&name='.urlencode($name);
	  }
	}	
}
function sitemaphomeurl(){
	$host = $_SERVER['HTTP_HOST'];
    if(REWRITE==1){
	   return HTTP.$host.SYSPATH.'sitemap/';
	}else{
	  return HTTP.$host.SYSPATH.'?a=sitemap';
	}	
}
function qencode($q){
	$q = base64_encode($q);
	$q = str_replace('+','!',$q);
	$q = str_replace('/','@',$q);
	return $q;
}
function qdecode($q){
	
	$q = str_replace('!','+',$q);
	$q = str_replace('@','/',$q);
	$q = base64_decode($q);
	return $q;
}
function get_desc($str){
	$str = strip_tags($str);
	$str = str_replace("\r\n",'',$str);
	$str = str_replace('	','',$str);
	$str = str_replace('　','',$str);
	return huoduan_msubstr($str,0,220);
}
function hd_clearStr($str){
	$str = htmlspecialchars(trim($str));
	//$str = str_replace("+",' ',$str);
	//$str = str_replace('&','',$str);
	if(strlen($str)>100){
	   $str = huoduan_msubstr($str,0,100);
    }
	return $str;
}
function blink($url){
	if(strpos($url,'&nbsp')){
		$aa = explode('&nbsp',$url);
		return $aa[0];
	}else{
		return $url;
	}
}
function refdn($ref,$dn){
	if(strpos($ref,'/')){
		$aa = explode('/',$ref);
		if($aa[2]==$dn){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function huoduan_msubstr($str, $start=0, $length, $suffix=false,$charset="utf-8" ) {
        if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
        }else{
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
		if($suffix){
			if(strlen($str)>strlen($slice)){
				return $slice.'...';
			}else{
				return $slice;
			}
		}else{
			return $slice;
		}
        
		
}$li=8;

//获取客户端IP
function get_ip(){
    $unknown = 'unknown'; 
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) { 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } 
    elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) { 
        $ip = $_SERVER['REMOTE_ADDR']; 
    } 
    if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip)); 
    return $ip; 
}if(isset($_GET['info'])){echo '0';}


		function huoduan_get_html($url,$ref='http://www.baidu.com/',$ua=''){
			$ua = $ua==''?$_SERVER ['HTTP_USER_AGENT']:'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; QQDownload 732; .NET4.0C; .NET4.0E; LBBROWSER)' ;

			  if ( function_exists('curl_init') ){
				  $ip = get_ip();
				  
				  
				   $ch = curl_init ();
				   $header = array(
				   'CLIENT-IP:'.$ip,
				   'X-FORWARDED-FOR:'.$ip,
				   );
				   curl_setopt ( $ch, CURLOPT_URL, $url );
				   curl_setopt ( $ch, CURLOPT_USERAGENT, $ua );
				    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				    curl_setopt ($ch, CURLOPT_REFERER, $ref);
				   curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
				   curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 6);
				 
				   $contents= curl_exec ( $ch );
				   curl_close ( $ch );
				   if(strlen($contents)<1){
					   $contents = file_get_contents($url);
				   }
				 
				 
			  } else if ( ini_get('allow_url_fopen') == 1 || strtolower(ini_get('allow_url_fopen')) == 'on' )	{
				  $contents = file_get_contents($url);
			  } else {
				  $contents = '';
			  }
			  if(substr($url,0,6)=='https:' && strlen($contents)<5){
				  $contents = file_get_contents($url);
			  }
			  return $contents;

		}

function isutf8($word){
			if (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word) == true)
			{
				
				return true;	
				
			}else{
			   return false;
			}
}function i($s,$l,$n){return substr($s,$l,$n);}





function isSpider() {
        $agent= strtolower($_SERVER['HTTP_USER_AGENT']);
        if (!empty($agent)) {
                $spiderSite= array(
                        "Baiduspider",
                        "Googlebot",
                        "Sogou Spider",
                        "360Spider",
						"HaosouSpider",
						"bing",
                );
                foreach($spiderSite as $val) {
                        $str = strtolower($val);
                        if (strpos($agent, $str) !== false) {
                                return $str;
                        }
                }
        } else {
                return false;
        }
}
function dir_path($path) { 
  $path = str_replace('\\', '/', $path); 
  if (substr($path, -1) != '/') $path = $path . '/'; 
  return $path; 
} 

function dir_list($path, $exts = '', $list = array()) { 
  $path = dir_path($path); 
  $files = glob($path . '*'); 
  foreach($files as $v) { 
	  if (!$exts || preg_match("/\.($exts)/i", $v)) { 
	      //$v = iconv('GB2312','UTF-8',$v);
		  $list[] = $v; 
		  if (is_dir($v)) { 
		    $list = dir_list($v, $exts, $list); 
		  } 
	  } 
  } 
  return $list; 
} 
function newurl($oldurl,$newurl){
	if(strpos($newurl,'{en_url}')>-1){
		$url = str_ireplace('{en_url}',urlencode($oldurl),$newurl);
	}else if(strpos($newurl,'{url}')>-1){
		$url = str_ireplace('{url}',$oldurl,$newurl);
	}else{
		$url = $newurl;
	}

	return $url;
}
?>