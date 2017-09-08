<?php 
include('config.php'); 
include('../data/huoduan.ads.php'); 
$tips = '';
include('admincore.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('inc.php'); ?>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.dragsort-0.4.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body>
<?php $nav = 'ads';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./ads.php?act=ads&t=<?php echo time()?>" method="post">
<input name="edit" id="edit" type="hidden" value="0" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="10" align="center">广告管理</td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">首页热搜下面广告：</td>
    <td valign="top"><div class="cl5"></div><textarea name="myads[ads_home]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.ads_home.php');echo htmlspecialchars($code);?></textarea></td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">搜索侧栏广告1：</td>
    <td valign="top">侧栏广告宽度是300PX<div class="cl5"></div><textarea name="myads[ads_sidebar]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.ads_sidebar.php');echo htmlspecialchars($code);?></textarea></td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">搜索侧栏广告2：</td>
    <td valign="top">侧栏广告宽度是300PX<div class="cl5"></div><textarea name="myads[ads_sidebar1]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.ads_sidebar1.php');echo htmlspecialchars($code);?></textarea></td>
</tr>
<tr>
    <td width="150" align="right" valign="middle" class="s_title">搜索结果中间广告：</td>
    <td valign="top">在第<select name="ads[search]">
      <?php for($i=1;$i<11;$i++){ 
	       if($i==$ads['search']){
			   echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		   }else{
			   echo '<option value="'.$i.'">'.$i.'</option>';
		   }
      
       }?>
    </select>
    条搜索结果上面放广告<div class="cl5"></div><textarea name="myads[ads_search]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.ads_search.php');echo htmlspecialchars($code);?></textarea></td>
</tr>

<tr>
    <td width="150" align="right" valign="middle" class="s_title">搜索翻页下面广告：</td>
    <td valign="top"><div class="cl5"></div><textarea name="myads[ads_search1]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.ads_search1.php');echo htmlspecialchars($code);?></textarea></td>
</tr>

<tr>
    <td width="150" align="right" valign="middle" class="s_title">打开网址Iframe<br />
页面广告：</td>
    <td valign="top">只能放漂浮类广告，如右下角、对联广告。<div class="cl5"></div>
<textarea name="myads[ads_iframe]" cols="80" rows="12"><?php $code = file_get_contents('../data/huoduan.ads_iframe.php');echo htmlspecialchars($code);?></textarea></td>
</tr>

<tr>
    <td width="150" align="right" valign="middle" class="s_title" style="color:#F00">手机版结果中间广告：</td>
    <td valign="top">在第<select name="ads[mobile_search]">
      <?php for($i=1;$i<11;$i++){ 
	       if($i==$ads['mobile_search']){
			   echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		   }else{
			   echo '<option value="'.$i.'">'.$i.'</option>';
		   }
      
       }?>
    </select>
    条搜索结果上面放广告<div class="cl5"></div><textarea name="myads[mobile_ads_search]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.mobile_ads_search.php');echo htmlspecialchars($code);?></textarea></td>
</tr>

<tr>
    <td width="150" align="right" valign="middle" class="s_title" style="color:#F00">手机版结果底部广告：</td>
    <td valign="top"><div class="cl5"></div><textarea name="myads[mobile_ads_search1]" cols="80" rows="10"><?php $code = file_get_contents('../data/huoduan.mobile_ads_search1.php');echo htmlspecialchars($code);?></textarea></td>
</tr>
<tr>
<td colspan="10" align="center"><input id="configSave" type="submit" value="     保 存     "></td>
</tr>
</table>


</form>

</div><!--main-->
<?php include('foot.php'); ?>
</body>
</html>
