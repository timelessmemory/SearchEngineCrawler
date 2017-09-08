<?php 
include('config.php'); 
include('../data/huoduan.plus.php'); 
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
</head>

<body>
<?php $nav = 'seturl';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./seturl.php?act=seturl&t=<?php echo time()?>" method="post">
<input name="edit" id="edit" type="hidden" value="1" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td align="center">劫持URL管理</td>
</tr>
<tr style="color:#999;">
    <td valign="top" style="padding-left:20px;">说明：劫持URL功能可以将搜索结果里的网站URL替换成其它的URL<p>★、可以在新URL里包含“<span style="color:blue">{en_url}</span>”或者“<span style="color:blue">{url}</span>”代替原来的URL，"<span style="color:blue">{en_url}</span>"为urlencode()转码后的原URL，"<span style="color:blue">{url}</span>"为原URL</p>
    
    </td>
</tr>
<?php
if(is_file('../data/huoduan.seturl.php')){
	include('../data/huoduan.seturl.php');
	if(is_array($seturl)){
foreach($seturl['type'] as $k=>$v){
?>
<tr>
    <td valign="top" style="padding-left:20px;">
        
      当搜索结果URL <select name="seturl[type][]">
      <option value="1"<?php echo $seturl['type'][$k]==1?' selected="selected"':''?>>等于</option>
      <option value="2"<?php echo $seturl['type'][$k]==2?' selected="selected"':''?>>包含</option>
      
      </select> <input name="seturl[oldurl][]" type="text" value="<?php echo $seturl['oldurl'][$k]?>" size="45" />
      则替换成 <input name="seturl[newurl][]" type="text" value="<?php echo $seturl['newurl'][$k]?>" size="45" />
    </td>
    </tr>

<?php
}
	}
}
?>
<tr>
    <td valign="top" style="padding-left:20px;">当搜索结果URL <select name="seturl[type][]">
      <option value="1">等于</option>
      <option value="2">包含</option>
      
      </select> <input name="seturl[oldurl][]" type="text" value="" size="45" />
      则替换成 <input name="seturl[newurl][]" type="text" value="" size="45" />
    </td>
    </tr>
<tr id="fbox">
<td colspan="10" align="left" style="padding-left:20px;"><input id="configSave" type="submit" value="     保 存     ">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="add" type="button" value="    新增加一条     "> (删除一条请清空该条的URL后保存)</td>
</tr>
</table>


</form>

</div><!--main-->
<script type="text/javascript">
$(function(){
	$("#add").click(function(){
		$("#fbox").before('<tr><td valign="top" style="padding-left:20px">当搜索结果URL <select name="seturl[type][]"><option value="1">等于</option><option value="2">包含</option></select> <input name="seturl[oldurl][]" type="text" value="" size="45"> 则替换成 <input name="seturl[newurl][]" type="text" value="" size="45"></td></tr>');
	});
	
});
</script>

<?php include('foot.php'); ?>
</body>
</html>
