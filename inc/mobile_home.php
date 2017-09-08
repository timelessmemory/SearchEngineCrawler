<?php

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title><?php echo $huoduan['title']?></title>
<meta name="keywords" content="<?php echo $huoduan['keywords']?>" />
<meta name="description" content="<?php echo $huoduan['description']?>" />
<link rel="canonical" href="<?php echo HTTP.PCDOMAIN.SYSPATH?>" />
<link href="images/mobilehome.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo SYSPATH?>favicon.ico">
</head>
<body>
<div class="homelogo"><h1><img src="<?php echo SYSPATH?>images/logo.png" alt="<?php echo $huoduan['sitename']?>" /></h1></div>
<div class="searchbox">
 <form action="./" method="<?php if(REWRITE=='1'){echo 'post';}else{echo 'get';}?>"><input align="middle" name="q" class="q" id="kw" value="请输入关键字搜索" onfocus="javascript:if(this.value=='请输入关键字搜索'){this.value='';this.style.color='#333'}" onblur="javascript:if(this.value==''){this.value='请输入关键字搜索';this.style.color='#CCC'}" maxlength="1000" baiduSug="1" size="50" autocomplete="off" x-webkit-speech /><input name="re" type="hidden" value="1" /><input id="btn" class="btn" align="middle" value="搜索" type="submit" />
        </form>
</div>
<?php 
if($huoduan['close_hotlist']!=1){ 

?>
<div class="hotsearch">
<h2>热门搜索</h2>
<div class="cl10"></div>
  <ul class="ranklist">
     <?php 
	 if($huoduan['hotkeytype']==1){
		 $topkey = huoduan_get_baidu_top($huoduan['hotcachetime']);
		 for($i=0;$i<10;$i++){
			echo '<li><span class="num  top'.($i+1).'">'.($i+1).'</span><a href="'.huoduansourl($topkey[$i]).'">'.$topkey[$i].'</a></li>'; 
			 
		 } 
	 }else{
		 if(is_file('data/huoduan.diykey.txt')){
			$diykey = file_get_contents('data/huoduan.diykey.txt');
		}else{
			$diykey = file_get_contents('../data/huoduan.diykey.txt');
		}
		$diylist = explode("\r\n",$diykey);
		
		shuffle($diylist);
		if(is_array($diylist)){
		  $count = count($diylist);
		  if($count>10){
			  $j = 10;
		  }else{
			  $j = $count;
		  }
		   for($i=0;$i<$j;$i++){
				echo '<li><span class="num  top'.($i+1).'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	
		} 
	 }
	 
	 ?>
  
  </ul>

</div>

<?php 
}

?>

<div id="footer"><p><a href="<?php echo HTTP.PCDOMAIN.SYSPATH?>">电脑版</a></p><?php echo $huoduan['foot']?></div>
<script charset="gbk" src="//www.baidu.com/js/opensug.js"></script>
</body>
</html>
