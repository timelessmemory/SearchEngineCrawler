<?php
if(!defined("a")) exit("Error 001");
if(!empty($_GET['u']) && !empty($_GET['k']) && !empty($_GET['t']) && !empty($_GET['s'])){
	
	$url = $_GET['u'];	
	$key = $_GET['k'];
	$title = $_GET['t'];
	$q = $_GET['s'];
	
	$url = htmlspecialchars(qdecode($url));
	$url = str_replace('&amp;','&',$url);
	$title = htmlspecialchars(qdecode($title));
	$q = htmlspecialchars(qdecode($q));
	$ref = $_SERVER['HTTP_REFERER'];
	if($_SERVER['HTTP_HOST'] ==MOBILEDOMAIN){
		$huoduan['link_open']=2;
	}
	if($huoduan['link_open']==2){
	
			header("location: $url");
		    exit;
	
		
	}
}else{
	echo 'URL错误!<a href="./"><<请返回</a>';
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<meta name="keywords" content="<?php echo $q?>,<?php echo $title?>" />
<meta name="description" content="<?php echo $q?>相关信息，<?php echo $title?>" />
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
<link href="images/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript"> 
window.onerror=function(){return true;} 
$(function() { 
   headerH = 70;
   var h = $(window).height();
   $("#huoduan_frame").height((h-headerH)+"px"); 
});
</script>
<!--[if IE 6]>
<script type="text/javascript" src="js/DDPNG.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png');
</script><![endif]-->
</head>
<body scroll="no" style="margin:0; padding:0; overflow-y:hidden ">

<div id="header">
  <div class="con">
      <h1 class="logo png"><a href="./"></a></h1>
      <div class="searchbox">
       <form action="./" method="get"><input align="middle" name="q" class="q" id="kw" value="<?php echo $q?>" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜索一下" type="submit" />
              </form>
      </div><a class="close" title="点击关闭" href="<?php echo $url?>" target="_self">X</a>
  </div>
</div><!--header-->
<div class="cl"></div>

<iframe id="huoduan_frame" frameborder="0" scrolling="yes" name="main" src="<?php echo $url?>" style=" height:500px; visibility: inherit; width: 100%; z-index: 1;overflow: visible;"></iframe>
<?php include(ROOT_PATH.'/data/huoduan.ads_iframe.php'); ?>
<div style="display:none">
<?php echo $huoduan['foot']?>
</div>
</body></html>
<!-- powered by huoduan.com -->