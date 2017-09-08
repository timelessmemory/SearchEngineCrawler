<?php 
include('config.php'); 
include('../data/huoduan.config.php'); 
$tips = '';
include('admincore.php');
$myurl = 'http://'.$_SERVER['HTTP_HOST'].$huoduan['path'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('inc.php'); ?>
</head>

<body>
<?php $nav = 'code';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./ads.php?act=ads&t=<?php echo time()?>" method="post">
<input name="edit" type="hidden" value="1" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="10" align="center">代码引用</td>
</tr>

<tr>
    <td width="184" align="right" valign="middle" class="s_title">搜索框引用代码：</td>
    <td width="753" valign="top"><textarea name="myads[ads_sidebar]" cols="80" rows="3"><iframe src="<?php echo $myurl?>?a=code&type=search" frameborder="0" scrolling="no" width="500" height="34"></iframe></textarea><div class="cl5"></div>代码演示效果：<div class="cl5"></div><iframe src="<?php echo $myurl?>?a=code&type=search" frameborder="0" scrolling="no" width="500" height="34"></iframe></td>
</tr>
<tr>
    <td width="184" align="right" valign="middle" class="s_title">实时热门搜索排行代码：</td>
    <td valign="top"><textarea name="myads[ads_sidebar]" cols="80" rows="3"><iframe src="<?php echo $myurl?>?a=code&type=top" frameborder="0" scrolling="no" width="300" height="300"></iframe></textarea><div class="cl5"></div>代码演示效果：<div class="cl5"></div><iframe src="<?php echo $myurl?>?a=code&type=top" frameborder="0" scrolling="no" width="300" height="300"></iframe></td>
</tr>
<tr>
    <td width="184" align="right" valign="middle" class="s_title">其它代码：</td>
    <td valign="top"><span class="green">如果要把搜索集成到其他网站，通过以下接口可以实现搜索：</span><br /><br />

utf8编码的页面URL接口： <?php echo $myurl?>?q=<span class="red">{$q}</span> <br /><br />

gb2312编码的页面URL接口： <?php echo $myurl?>?q=<span class="red">{$q}</span>&cr=gb2312 <br />
<br />
gbk编码的页面URL接口： <?php echo $myurl?>?q=<span class="red">{$q}</span>&cr=gbk <br />
<br />
<span class="gray">接口URL中的<span class="red">{$q}</span>代码搜索词 </span></td>
</tr>


</table>


</form>

</div><!--main-->
<?php include('foot.php'); ?>
</body>
</html>
