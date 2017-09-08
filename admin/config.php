<?php
session_start();
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
include('../data/huoduan.config.php'); 
define('REWRITE',$huoduan['rewrite']);
define('SYSPATH',$huoduan['path']);
$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
define('HTTP',$sys_protocal);
define('a', '本程序由火端网络开发，官方网站：http://www.huoduan.com，源码唯一销售客服QQ号码：909516866 ，请尊重开发者劳动成果，勿将本程序发布到网上或倒卖，感谢您的支持！');$rep='foot';
if($_SESSION['admin_huoduan']!=base64_decode('aHR0cDovL3d3dy5odW9kdWFuLmNvbQ==')){
	header("location: ./login.php");
	exit;
}
$nav='';

?>