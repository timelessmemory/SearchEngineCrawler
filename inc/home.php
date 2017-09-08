<?php
if(!defined("a")) exit("Error 001");if(substr(md5(a),0,3)!='a68'){echo 'Error 222';exit;}
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */

if($host==strtolower(MOBILEDOMAIN)){
   	include(ROOT_PATH.'/inc/mobile_home.php');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $huoduan['title']?></title>
<meta name="keywords" content="<?php echo $huoduan['keywords']?>" />
<meta name="description" content="<?php echo $huoduan['description']?>" />
<link rel='canonical' href='<?php echo HTTP.PCDOMAIN.SYSPATH?>' />
<link rel="alternate" media="only screen and(max-width: 640px)" href="<?php echo HTTP.MOBILEDOMAIN.SYSPATH?>" >
<link href="<?php echo SYSPATH?>images/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SYSPATH?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SYSPATH?>js/main.js"></script>
<?php 
if(MOBILEDOMAIN!=''){
	$mobileurl = 'http://'.MOBILEDOMAIN.SYSPATH;
	echo '<meta name="mobile-agent" content="format=html5;url='.$mobileurl.'">
<meta name="mobile-agent" content="format=xhtml;url='.$mobileurl.'"><meta name="mobile-agent" content="format=wml; url='.$mobileurl.'">';
	$ref = $_SERVER['HTTP_REFERER'];
	if($host!=MOBILEDOMAIN && !refdn($ref,MOBILEDOMAIN)){
?><script type="text/javascript">gotomurl('<?php echo $mobileurl?>');</script>
<?php
	} 
}
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo SYSPATH?>favicon.ico">
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo SYSPATH?>js/DDPNG.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png');
</script><![endif]-->
<script type="text/javascript">
function subck(){
	var q = document.getElementById("kw").value;
	if(q=='' || q=='请输入关键字搜索网页'){return false;}else{return true;}
}
function toptab(obj,id){
	$(".hothead a").removeClass("current");
	$("#tab"+id).addClass("current");
    $(".hotsearch ul").hide();
	$("#toplist"+id).show();
}
$(document).ready(function() {
	var WinH = $(window).height();
    var offset = $('#footer').offset(); 
	if(WinH>offset.top+$('#footer').height()){
		var MH = WinH-offset.top-$('#footer').height()+19;
		$('#footer').css("margin-top",MH.toString()+"px");
	
	}
    $('#footer').css("visibility","visible");
});
</script>
</head>

<body>

<div id="top"><span class="fl"><?php echo $huoduan['hometopleft']?></span><span class="fr"><?php echo $huoduan['hometopright']?></span></div>
<div class="homelogo png"><h1><?php echo $huoduan['sitename']?></h1></div>


<?php 
/* 以下代码是首页导航切换标签，如果要启用，请取消这里的注释
?>
<div class="navtab" id="navtab"><a href="http://so.huoduan.net" class="current">网页</a>
<a href="http://pan.huoduan.net">网盘</a>
<a href="http://music.huoduan.net">音乐</a>
</div>
<?php */?>

<div class="searchbox">
 <form action="./" method="<?php if(REWRITE=='1'){echo 'post';}else{echo 'get';}?>" onsubmit="return subck();"><input align="middle" name="q" class="q" id="kw" value="请输入关键字搜索网页" onfocus="javascript:if(this.value=='请输入关键字搜索网页'){this.value='';this.style.color='#333';this.style.borderColor='#4B8DF9';}" onblur="javascript:if(this.value==''){this.value='请输入关键字搜索网页';this.style.color='#CCC';this.style.borderColor='#CFC7C8';}" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜索一下" type="submit" />
        </form>
</div>



<?php 
if($huoduan['close_hotlist']!=1){ 
  if($huoduan['hotkeytype']==1){ 
//下面这里是自动获取百度排行榜热门关键词
?>
<div class="hotsearch">
  <div class="hothead"><a href="javascript:void(0)" id="tab1" onmouseover="toptab(this,'1');" class="current">实时热点</a><a id="tab2" href="javascript:void(0)" onmouseover="toptab(this,'2');">今日关注</a><a id="tab3" href="javascript:void(0)" onmouseover="toptab(this,'3');">七日关注</a><a id="tab4" href="javascript:void(0)" onmouseover="toptab(this,'4');">网友在搜</a></div>
  <ul id="toplist1">
     <?php 
	     $topkey = huoduan_get_baidu_top($huoduan['hotcachetime']);
		 for($i=0;$i<30;$i++){
			 $numclass = $i<6?' top1':' top2';
			 if(strlen($topkey[$i])>0){
			echo '<li><span class="num'.$numclass.'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($topkey[$i]).'">'.$topkey[$i].'</a></li>'; 	} 
		 }
	 ?>
  
  </ul>
  <ul id="toplist2" style="display:none;">
     <?php 
         
		 $topkey2 = huoduan_get_baidu_top($huoduan['hotcachetime'],341);
		 for($i=0;$i<30;$i++){
			 $numclass = $i<6?' top1':' top2';
			 if(strlen($topkey[$i])>0){
			echo '<li><span class="num'.$numclass.'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($topkey2[$i]).'">'.$topkey2[$i].'</a></li>'; 
			 }
		 } 
		 ?>
    </ul>
   <ul id="toplist3" style="display:none;">
     <?php 
       
		 $topkey3 = huoduan_get_baidu_top($huoduan['hotcachetime'],42);
		 for($i=0;$i<30;$i++){
			 $numclass = $i<6?' top1':' top2';
			 if(strlen($topkey[$i])>0){
			echo '<li><span class="num'.$numclass.'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($topkey3[$i]).'">'.$topkey3[$i].'</a></li>'; 
			 }
		 } 
		 ?>
    </ul>
    <ul id="toplist4" style="display:none;">
     <?php 

		 $diykey = file_get_contents(ROOT_PATH.'/data/huoduan.diykey.txt');
		if(strpos($diykey,"\r\n")>-1){
		   $diylist = explode("\r\n",$diykey);
		}else{
			$diylist = explode("\n",$diykey);
		}
		
		shuffle($diylist);
		if(is_array($diylist)){
		  $count = count($diylist);
		  if($count>30){
			  $j = 30;
		  }else{
			  $j = $count;
		  }
		   for($i=0;$i<$j;$i++){
			   $numclass = $i<6?' top1':' top2';
			   if(strlen($diylist[$i])>0){
				echo '<li><span class="num'.$numclass.'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; }
			} 
	
		} 
		 ?>
    </ul>
  <div class="cl10"></div>
</div>

<?php }else{ 
//下面是在后台设置里面选择了“完全自定义热门词”后的内容
?>
<div class="hotsearch">
  <div class="hothead"><a class="current">热门搜索</a></div>
 
    <ul>
     <?php 

		$diykey = file_get_contents(ROOT_PATH.'/data/huoduan.diykey.txt');
		if(strpos($diykey,"\r\n")>-1){
		   $diylist = explode("\r\n",$diykey);
		}else{
			$diylist = explode("\n",$diykey);
		}
		
		shuffle($diylist);
		if(is_array($diylist)){
		  $count = count($diylist);
		  if($count>30){
			  $j = 30;
		  }else{
			  $j = $count;
		  }
		   for($i=0;$i<$j;$i++){
			   $numclass = $i<6?' top1':' top2';
				echo '<li><span class="num'.$numclass.'">'.($i+1).'</span><a target="_blank" href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	
		} 
		 ?>
    </ul>
  <div class="cl10"></div>
</div>


<?php } 
}
?>

<div style="margin:30px 0 10px 0; text-align:center;" align="center"><?php include(ROOT_PATH.'/data/huoduan.ads_home.php');?></div>

<?php
if(is_file(ROOT_PATH.'/data/huoduan.links.txt')){
  $links = file_get_contents(ROOT_PATH.'/data/huoduan.links.txt');
}
$links = trim($links,"\r\n");
$links = explode("\r\n",$links);
if(count($links)>0 && strlen($links[0])>3){

echo '<div class="links">友情链接：';
foreach($links as $k=>$v){
	if(strpos($v,'|')){
		$link = explode('|',$v);
		echo '<a href="'.$link[1].'" target="_blank" title="'.$link[0].'">'.$link[0].'</a>';
	}
}
echo '</div>';

}
?>

<div id="footer" style=" visibility:hidden"><?php echo $huoduan['foot']?></div>
<script charset="gbk" src="//www.baidu.com/js/opensug.js"></script>

</body>
</html>
