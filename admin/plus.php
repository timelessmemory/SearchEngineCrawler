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
<?php $nav = 'plus';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./plus.php?act=plus&t=<?php echo time()?>" method="post">
<input name="edit" id="edit" type="hidden" value="1" />
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="2" align="center">扩展管理[<a href="http://www.huoduan.com/so-plus.html" target="_blank">帮助</a>]</td>
</tr>
<tr style="color:#999;">
    <td colspan="2" valign="top" style="padding-left:20px;">说明：扩展功能可以指定搜索哪些关键词，显示指定的内容，可以在搜索结果上方显示，也可以在右侧显示<p>①、选择“<span style="color:blue">等于</span>”或者“<span style="color:blue">包含</span>”时，支持多个关键词匹配，比如想搜索关键词包含“<span style="color:red">源码</span>”或者“<span style="color:red">建站</span>”都显示火端网络网站，可以用“|”分开，比如填写“<span style="color:red">源码|建站</span>”。</p>
    <p>
    ②、代码里可以用“<span style="color:red">{q}</span>”代表当前搜索关键词。
    </p>
    </td>
</tr>
<?php
foreach($plus['type'] as $k=>$v){
?>
<tr>
    <td width="75%" valign="top" style="padding-left:20px;"><select name="plus[user][]">
     <option value="1"<?php echo $plus['user'][$k]==1?' selected="selected"':''?>>全部访客</option>
     <option value="2"<?php echo $plus['user'][$k]==2?' selected="selected"':''?><?php echo !isset($plus['user'][$k])?' selected="selected"':''?>>电脑访客</option>
     <option value="3"<?php echo $plus['user'][$k]==3?' selected="selected"':''?>>手机访客</option>
    </select>当搜索关键词<select name="plus[type][]">
     <option value="1"<?php echo $plus['type'][$k]==1?' selected="selected"':''?>>等于</option>
     <option value="2"<?php echo $plus['type'][$k]==2?' selected="selected"':''?>>包含</option>
     <option value="3"<?php echo $plus['type'][$k]==3?' selected="selected"':''?>>正则</option>
    </select> <input name="plus[key][]" type="text" value="<?php echo $plus['key'][$k]?>" size="20" />
     在第<select name="plus[num][]">
     
     <?php for($i=1;$i<11;$i++){ 
	       if($i==$plus['num'][$k]){
			   echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
		   }else{
			   echo '<option value="'.$i.'">'.$i.'</option>';
		   }
      
       }?>
    </select>条搜索结果前显示以下内容
    <div class="cl5"></div><textarea name="plus[value][]" cols="75" rows="5"><?php echo htmlspecialchars($plus['value'][$k])?></textarea></td>
    <td valign="top" style="padding-left:10px;">右侧显示以下内容<div class="cl5"></div><textarea name="plus[value1][]" cols="30" rows="5"><?php echo htmlspecialchars($plus['value1'][$k])?></textarea></td>
</tr>

<?php
}
?>
<tr>
    <td valign="top" style="padding-left:20px;"><select name="plus[user][]">
     <option value="1">全部访客</option>
     <option value="2">电脑访客</option>
     <option value="3">手机访客</option>
    </select>当搜索关键词<select name="plus[type][]">
     <option value="1">等于</option>
     <option value="2">包含</option>
     <option value="3">正则</option>
    </select> <input name="plus[key][]" type="text" value="" size="20" />
    在第<select name="plus[num][]">
     
     <?php for($i=1;$i<11;$i++){ 
	        echo '<option value="'.$i.'">'.$i.'</option>';
      
       }?>
    </select>条搜索结果前显示以下内容
    <div class="cl5"></div><textarea name="plus[value][]" cols="75" rows="5"></textarea></td>
    <td valign="top" style="padding-left:10px;">右侧显示以下内容<div class="cl5"></div><textarea name="plus[value1][]" cols="30" rows="5"></textarea></td>
</tr>
<tr id="fbox">
<td colspan="11" align="left" style="padding-left:20px;"><input name="edit" type="hidden" value="1" /><input id="configSave" type="submit" value="     保 存     ">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="add" type="button" value="    新增加一条     "> (删除一条请清空该条的搜索词后保存)</td>
</tr>
</table>


</form>

</div><!--main-->
<script type="text/javascript">
$(function(){
	$("#add").click(function(){
		$("#fbox").before('<tr><td valign="top" style="padding-left:20px;"><select name="plus[user][]"><option value="1">全部访客</option><option value="2">电脑访客</option><option value="3">手机访客</option></select>当搜索关键词<select name="plus[type][]"><option value="1">等于</option><option value="2">包含</option></select> <input name="plus[key][]" type="text" value="" size="20" />在第<select name="plus[num][]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>    </select>条搜索结果前显示以下内容<div class="cl5"></div><textarea name="plus[value][]" cols="75" rows="5"></textarea></td> <td valign="top" style="padding-left:10px;">右侧显示以下内容<div class="cl5"></div><textarea name="plus[value1][]" cols="30" rows="5"></textarea></td></tr>');
	});
	
});
</script>

<?php include('foot.php'); ?>
</body>
</html>
