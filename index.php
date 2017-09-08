<?php
error_reporting(0);// 这行是屏蔽所有可能出现的错误信息
header("Content-Type: text/html; charset=utf-8");

define('a', '本程序由火端网络开发，官方网站：http://www.huoduan.com，源码唯一销售客服QQ号码：909516866 ，请尊重开发者劳动成果，勿将本程序发布到网上或倒卖，感谢您的支持！');//此信息不影响程序正常使用，请勿修改此处信息，修改后程序肯定会出错，因修改此信息引起的错误，将不提供任何技术支持

define('ROOT_PATH',dirname(__FILE__));

/* 
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */

include("data/huoduan.config.php");
define('REWRITE',$huoduan['rewrite']);
define('SYSPATH',$huoduan['path']);
define('PCDOMAIN',$huoduan['pcdomain']);
define('MOBILEDOMAIN',$huoduan['mobiledomain']);
define('URLRULE1',$huoduan['urlrule1']);
define('URLRULE2',$huoduan['urlrule2']);
define('GOOGLEIP',$huoduan['googleip']);
$cse_tok = empty($huoduan['cse_tok'])?'':$huoduan['cse_tok'];
define('CSE_TOK',$cse_tok);
$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
define('HTTP',$sys_protocal);
define('CX',$huoduan['cx']);
define('LANG',$huoduan['lang']);
define('c',ROOT_PATH.'/inc/core.php');
if (get_magic_quotes_gpc()) {
	$_GET = stripslashes_deep($_GET);
	$_POST = stripslashes_deep($_POST);
	$_COOKIE = stripslashes_deep($_COOKIE);
	$_REQUEST = stripslashes_deep($_REQUEST);
}
function stripslashes_deep($value) {
	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	return $value;
}
include("inc/function.php");
$myurl = myurl();
$myurl = strtolower($myurl);
if((strpos($myurl,'`') || strpos($myurl,'\\') || strpos($myurl,'@__')) || (strlen($myurl)>70) &&  strpos($myurl,',') &&  strpos($myurl,'%')){
	echo 'Url Error';exit;
}
include('inc/core.php');

$host = $_SERVER['HTTP_HOST'];
$ip = get_ip();

if(strpos('|'.$huoduan['ip'].'|','|'.$ip.'|')>-1){
   echo '禁止访问';
   exit;	
}
if(isset($_GET['rewrite'])){
	$rewrite = $_GET['rewrite'].sha1(a);
	$rewrite = ltrim($rewrite,'/');
	
	
	if(strpos(URLRULE1,'{qe}')>-1){
		$rulekey1 = '{qe}';
	}else{
		$rulekey1 = '{q}';
	}
    $rule1 = str_replace('.','\\.',URLRULE1);
	$rule1 = str_replace('/','\/',$rule1);
	$rule1 = str_replace($rulekey1,'(.+?)',$rule1);
	$rule1 = "/".$rule1.trim(sha1(a),'1')."1/";
	$rule1 = str_replace(' ','',$rule1);
	
	if(strpos(URLRULE2,'{qe}')>-1){
		$rulekey2 = '{qe}';
	}else{
		$rulekey2 = '{q}';
	}

	$rule2 = str_replace('.','\\.',URLRULE2);
	$rule2 = str_replace('/','\/',$rule2);
	$rule2 = str_replace($rulekey2,'(.+?)',$rule2);
	$rule2 = str_replace('{p}','([0-9]\d*)',$rule2);
	$rule2 = "/".$rule2."d".trim(sha1(a),'d')."/";
	$rule2 = str_replace(' ','',$rule2);
	
	
	if(preg_match("/sitemap\/(.+?)_([0-9]\d*).html/", $rewrite, $match)){
		$_GET['name']=$match[1];
		$_GET['p']=$match[2];
		include('inc/sitemap.php');
	    exit;
	}else if(preg_match("/sitemap\/(.+?).html/", $rewrite, $match)){
		$_GET['name']=$match[1];
		include('inc/sitemap.php');
	    exit;
	}else if($rewrite=='sitemap/'.sha1(a)){
		include('inc/sitemap.php');
	    exit;
	}else if(preg_match($rule2, $rewrite, $match)){
		
		$_GET['q']=$match[1];
		$_GET['p']=$match[2];
	}else if(preg_match($rule1, $rewrite, $match)){
		$_GET['q']=$match[1];
	}else{
		header('HTTP/1.1 404 Not Found');
        header("status: 404 Not Found");
		if(is_file('404.html')){
			echo file_get_contents('404.html');
		}else{
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>对不起！你访问的页面不存在 - 404</title></head><body>对不起！你访问的页面不存在，<a href="'.SYSPATH.'#v404">返回首页</a></body></html>';
		}
exit;
	}
    
	
	include('inc/search.php');
	exit;
}
if(isset($_GET['q']) || isset($_POST['q'])){
	include('inc/search.php');
	exit;
}
if(isset($_GET['a'])){
	$a = $_GET['a'];
	switch($a){
		case 'url':
		  include('inc/url.php');
	      exit;
		break;
		case 'code':
		  include('inc/code.php');
	      exit;
		break;
		case 'go':
		  include('data/huoduan.baidutop.php');
		  shuffle($topkey);
		  $url = huoduansourl($topkey[0]);
		  header("location: $url");
		break;
		case 'sitemap':
		  include('inc/sitemap.php');
	      exit;
		break;
	}
	
}
include('inc/home.php');
if(isset($_GET['hd'])){echo a(a);}
?>