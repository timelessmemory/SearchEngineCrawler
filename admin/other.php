<?php 
include('config.php'); 
$tips = '';
include('../inc/function.php');
include('admincore.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('inc.php'); ?>
<script type="text/javascript" src="../js/jquery.min.js"></script>
</head>

<body>
<?php $nav = 'other';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./other.php?act=other&t=<?php echo time()?>" method="post">

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr>
    <td width="125" align="right" valign="middle" class="s_title">自定义热搜词：</td>
    <td valign="top">
<textarea name="diykey" cols="30" rows="8" style="width:350px; height:160px; float:left; display:inline-block;"><?php $diykey = file_get_contents('../data/huoduan.diykey.txt');echo $diykey;?></textarea> <div style="display:inline-block; width:440px; float:left; margin:10px 0 0 10px;"><span class="gray">★默认设置下首页和搜索页的“网友在搜”其实是一个自定义关键词功能，这里可以填写自定义的关键词，将在首页和搜索页面右侧随机显示，
一行一个关键词。<br />
★如果后台[设置]里选择了“完全自定义热门词”，首页和搜索页面侧栏将全部显示此处的热门词<br />
★建议在3000个关键词以内，太多了打开会慢<br />
★这里推荐一款<a href="http://www.huoduan.com/keywords-tool.html" target="_blank">免费关键词挖掘工具</a>，可以快速挖掘指定行业关键词</span><br />

</div>
      </td>
</tr>

<tr>
    <td width="125" align="right" valign="middle" class="s_title">屏蔽关键词：</td>
    <td valign="top">
<textarea name="killword" cols="30" rows="8" style="width:350px; height:160px; float:left; display:inline-block;"><?php $killword = file_get_contents('../data/huoduan.killword.txt');echo $killword;?></textarea> <div style="display:inline-block; float:left; margin:20px 0 0 10px;"><span class="gray">一行一个关键词，默认是包含屏蔽关键词就不显示<br />
如果要等于屏蔽关键词才不显示，请在屏蔽关键词前加上“|”;<br />
如果再前面加上“~”，那么直接返回404错误
</span><br />

</div>
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">屏蔽网址：</td>
    <td valign="top">
<textarea name="killurls" cols="30" rows="8" style="width:350px; height:160px; float:left; display:inline-block;"><?php $killurls = file_get_contents('../data/huoduan.killurls.txt');echo $killurls;?></textarea> <div style="display:inline-block; float:left; margin:20px 0 0 10px;"><span class="gray">一行一个网址，默认是包含屏蔽网址就不显示结果<br />
如果要等于屏蔽网址才不显示，请在屏蔽网址前加上"|"</span><br />

</div>
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">友情链接：</td>
    <td valign="top">
<textarea name="links" cols="30" rows="8" style="width:350px; height:160px; float:left; display:inline-block;"><?php $links = file_get_contents('../data/huoduan.links.txt');echo $links;?></textarea> <div style="display:inline-block; float:left; margin:20px 0 0 10px;"><span class="gray">一行一个友情链接<br /><br />
格式：火端网络|http://www.huoduan.com/<br /><br />
前面一定要加http://</span><br />

</div>
      </td>
</tr>

<tr>
<td colspan="10" align="center"><input name="edit" type="hidden" value="1" /><input id="configSave" type="submit"  value="     保 存     "></td>
</tr>
</table>


</form>

</div><!--main-->
<?php include('foot.php'); ?>
</body>
</html>
