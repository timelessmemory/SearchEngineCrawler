<?php 
include('config.php'); 
include('../data/huoduan.config.php'); 
$tips = '';
include('admincore.php');
include('../inc/function.php');
$host = $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('inc.php'); ?>
</head>

<body>
<?php $nav = 'sitemap';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="10" align="center">网站地图</td>
</tr>

<tr>
    <td colspan="2" align="left" valign="middle" class="s_title" style="line-height:180%">　　网站地图是2.X版新增的功能，网站地图功能主要是为了方便搜索引擎蜘蛛爬找收录。火端搜索程序跟普通网站不一样，火端搜索程序只需要关键词就可创建页面，关键词是无限的，也就是说可以创建无限个页面。我们可以创建一些热门的或者我们需要某个行业的关键词。<br />
如何创建网站地图，请点击<a href="http://www.huoduan.com/search-sitemap.html" target="_blank">这里查看详情</a>。<br />
　　网站地图引蜘蛛页面网址：<a href="<?php echo sitemaphomeurl()?>" target="_blank"><?php echo sitemaphomeurl()?></a> （该网址可以放在网站底部，或者友情链接里，用于引蜘蛛）
</td>
</tr>
<tr class="thead">
<td colspan="10" align="left">以下网站地图链接用于提交到各大搜索引擎站长平台，平台链接：<a href="http://zhanzhang.baidu.com/" target="_blank">百度站长平台</a> <a href="http://zhanzhang.haosou.com/" target="_blank">好搜站长平台</a> <a href="http://zhanzhang.sogou.com/" target="_blank">搜狗站长平台</a> </td>
</tr>
<tr>
    <td colspan="2" align="left" valign="middle" style="line-height:180%">.xml格式的网站地图，标准的XML网站地图输出<br />
<?php
	 $dirname = '../data/sitemap/';
	 $r = dir_list($dirname); 
     
     echo ' <textarea  cols="80" rows="10">';
	 foreach($r as $k=>$v){

		 $fname = basename(iconv('GB2312','UTF-8',$v));
		 $fname = str_replace('.txt','',$fname);
		 $fname = str_replace('.TXT','',$fname);
		 
		 echo 'http://'.$host.SYSPATH.'?a=sitemap&key='.urlencode($fname).'&type=.xml'."\r\n";
	 }
   echo '</textarea>';
	 ?>
   
</td>
</tr>

<tr>
    <td colspan="2" align="left" valign="middle" style="line-height:180%">.txt格式的网站地图，输出方式为一行一个网址<br />
<?php
	 echo ' <textarea  cols="80" rows="10">';
	 foreach($r as $k=>$v){

		 $fname = basename(iconv('GB2312','UTF-8',$v));
		 $fname = str_replace('.txt','',$fname);
		 $fname = str_replace('.TXT','',$fname);
		 
		 echo 'http://'.$host.SYSPATH.'?a=sitemap&key='.urlencode($fname).'&type=.txt'."\r\n";
	 }
   echo '</textarea>';
	 ?>
   
</td>
</tr>

</table>


</div><!--main-->
<?php include('foot.php'); ?>
</body>
</html>
