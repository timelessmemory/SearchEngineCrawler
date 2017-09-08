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
<script type="text/javascript" src="js/jquery.dragsort-0.4.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body>
<?php $nav = 'setting';include('head.php'); ?>

<div id="hd_main">
  <div align="center"><?php echo $tips?></div>
 <form name="configform" id="configform" action="./setting.php?act=setting&t=<?php echo time()?>" method="post" onsubmit="return subck()">

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="tablecss">
<tr class="thead">
<td colspan="10" align="center">基本设置</td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">网站名称：</td>
    <td width="690" valign="middle"><input name="edit" id="edit" type="hidden" value="1" /><input type="text" name="huoduan[sitename]" value="<?php echo $huoduan['sitename']?>" size="50">
      <span class="gray tips">如：火端搜索</span></td>
</tr>

<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页标题：</td>
    <td valign="top"><input type="text" name="huoduan[title]" value="<?php echo $huoduan['title']?>" size="50">
      <span class="gray tips">显示在首页标题上</span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页关键字：</td>
    <td valign="top"><input type="text" name="huoduan[keywords]" value="<?php echo $huoduan['keywords']?>" size="50">
      <span class="gray tips">如：多个关键字请用英文状态下的逗号分开，建议在6个词以内</span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页描述：</td>
    <td valign="top"><textarea name="huoduan[description]" cols="80" rows="3"><?php echo $huoduan['description']?></textarea></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页顶部左边内容：</td>
    <td valign="top"><textarea name="huoduan[hometopleft]" cols="80" rows="3"><?php echo $huoduan['hometopleft']?></textarea></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页顶部右边内容：</td>
    <td valign="top"><textarea name="huoduan[hometopright]" cols="80" rows="3"><?php echo $huoduan['hometopright']?></textarea></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">网站目录：</td>
    <td width="690" valign="middle"><input type="text" name="huoduan[path]" id="huoduan_path" value="<?php echo $huoduan['path']?>" size="20">
      <span class="gray tips">根目录请填写 / ，子目录请填写如：/sub/</span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">PC版域名：</td>
    <td width="690" valign="middle"><input type="text" name="huoduan[pcdomain]" id="huoduan_pcdomain" value="<?php echo $huoduan['pcdomain']?>" size="20">
      <span class="gray tips">PC版域名，如 so.huoduan.com </span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">手机版域名：</td>
    <td width="690" valign="middle"><input type="text" name="huoduan[mobiledomain]" id="huoduan_mobiledomain" value="<?php echo $huoduan['mobiledomain']?>" size="20">
      <span class="gray tips">手机版域名，如 m.so.huoduan.com ，不开启手机版请留空</span></td>
</tr>
<tr style="display:none;">
    <td width="125" align="right" valign="middle" class="s_title">谷歌可访问域名</td>
    <td valign="top">
     <input type="text" name="huoduan[googleip]" value="<?php echo $huoduan['googleip']?>" size="20">
      <span class="gray tips">填写谷歌域名或者谷歌IP都可以，只要服务器能正常访问</span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">谷歌搜索CX参数：</td>
    <td valign="top">
     <input type="text" name="huoduan[cx]" value="<?php echo $huoduan['cx']?>" style="width: 750px;">
        <br>
      <span class="gray tips">请访问<a href="http://www.huoduan.com/google-cse-search.html" target="_blank">谷歌自定义搜索</a>获取参数，也可以留空。<span style="color: #F00"> 强烈推荐填写自己创建的</span></span>
      
      </td>
</tr>
    <tr>
        <td width="125" align="right" valign="middle" class="s_title">谷歌cse_tok参数：</td>
        <td valign="top">
            <input type="text" name="huoduan[cse_tok]" value="<?php echo $huoduan['cse_tok']?>" style="width: 750px;"><br>
            <span class="gray tips">请访问<a href="http://www.huoduan.com/google-cse-search.html" target="_blank">谷歌自定义搜索</a>获取参数，也可以留空，必须和上面的CX参数对应</span>

        </td>
    </tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">谷歌搜索语言：</td>
    <td valign="top">
     <input type="text" name="huoduan[lang]" value="<?php echo $huoduan['lang']?>" size="20">
      <span class="gray tips">留空默认会简体中文，其它语言如英文：“EN”，繁体：“zh-TW”</span>
      
      </td>
</tr>
<tr class="thead">
<td colspan="10" align="center">高级设置</td>
</tr>
<tr style="display:none;">
    <td width="125" align="right" valign="middle" class="s_title">搜索类型</td>
    <td valign="top">
      <label>
        <input type="radio" id="searchtype_baidu" name="huoduan[searchtype]" class="so_1" value="baidu" <?php echo $huoduan['searchtype']=='baidu'?' checked="checked"':''?> />
        百度全网搜索</label>
      <label>
        <input type="radio" id="searchtype_haosou" name="huoduan[searchtype]" class="so_1" value="haosou" <?php echo $huoduan['searchtype']=='haosou'?' checked="checked"':''?> />
        好搜全网搜索</label>
     
     
          <label>
            <input type="checkbox" name="huoduan[searchsiteopen]" value="1" id="searchsiteopen" <?php echo $huoduan['searchsiteopen']==1?' checked="checked"':''?> />
            只搜索某站点</label>
     
&nbsp;<span id="searchsite"<?php echo $huoduan['searchsiteopen']!=1?' style="display:none;"':''?>><input type="text" name="huoduan[searchsite]" value="<?php echo $huoduan['searchsite']?>" size="14">
        
      <span class="gray tips">只在搜索该域名下的结果</span></span>
      
      </td>
</tr>

<tr>
    <td width="125" align="right" valign="middle" class="s_title">伪静态：</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[rewrite]" id="rebtn_1" value="1" <?php echo $huoduan['rewrite']==1?' checked="checked"':''?> />
        开启</label>
   
      <label>
        <input type="radio" name="huoduan[rewrite]" id="rebtn_2" value="0" <?php echo $huoduan['rewrite']==0?' checked="checked"':''?> />
        关闭</label>  <span class="gray">(必须要服务器支持才行，<a href="http://www.huoduan.com/so-rewrite.html" target="_blank">具体规则和设置方法请看这里</a>)</span>
      
      </td>
</tr>
<tr class="rebox"<?php echo $huoduan['rewrite']==0?' style="display:none;"':''?>>
    <td width="125" align="right" valign="middle" class="s_title">搜索页URL规则：</td>
    <td width="690" valign="middle"><input type="text" name="huoduan[urlrule1]" value="<?php echo $huoduan['urlrule1']?>" size="25">
      <span class="gray tips"> 如 <span class="blue">k/{q}</span> 或者 <span class="blue">{q}.html</span> ，{q}代表搜索词，{qe}代表Base64转码后的搜索词，不得有特殊字符</span></td>
</tr>
<tr class="rebox"<?php echo $huoduan['rewrite']==0?' style="display:none;"':''?>>
    <td width="125" align="right" valign="middle" class="s_title">搜索页URL翻页规则：</td>
    <td width="690" valign="middle"><input type="text" name="huoduan[urlrule2]" value="<?php echo $huoduan['urlrule2']?>" size="25">
      <span class="gray tips"> 如 <span class="blue">k/{q}/{p}</span> 或者 <span class="blue">{q}_{p}.html</span> ，{q}代表搜索词，{p}代表页码，前面不需要 / </span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">相关搜索：</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[xg_open]" value="1" <?php echo $huoduan['xg_open']==1?' checked="checked"':''?> />
        开启</label>
   
      <label>
        <input type="radio" name="huoduan[xg_open]" value="0" <?php echo $huoduan['xg_open']==0?' checked="checked"':''?> />
        关闭</label>  <span class="gray">(关闭可加快搜索速度，开启用户体验更好，也利于收录)</span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">百度作为备用搜索</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[baidu_bak]" value="1" <?php echo $huoduan['baidu_bak']==1?' checked="checked"':''?> />
        是　</label><label>
        <input type="radio" name="huoduan[baidu_bak]" value="0" <?php echo $huoduan['baidu_bak']==0?' checked="checked"':''?> />
        否</label>  <span class="gray">(当Google搜索不到结果时，是否启用百度作为备用搜索)</span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">搜索结果前数字</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[listnum]" value="1" <?php echo $huoduan['listnum']==1?' checked="checked"':''?> />
        显示</label>
   
      <label>
        <input type="radio" name="huoduan[listnum]" value="0" <?php echo $huoduan['listnum']==0?' checked="checked"':''?> />
        关闭</label>  <span class="gray">(搜索结果标题前的①、②、③数字是否显示)</span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">打开链接方式：</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[link_open]" value="1" <?php echo $huoduan['link_open']==1?' checked="checked"':''?> />
        iFrame框架打开</label>
        
        <input type="radio" name="huoduan[link_open]" value="2" <?php echo $huoduan['link_open']==2?' checked="checked"':''?> />
        转跳方式打开</label>
   
      <label>
        <input type="radio" name="huoduan[link_open]" value="0" <?php echo $huoduan['link_open']==0?' checked="checked"':''?> />
        直接打开</label> 
      
      </td>
</tr>

<tr>
    <td width="125" align="right" valign="middle" class="s_title">搜索结果缓存时间：</td>
    <td valign="top">
      <select name="huoduan[cachetime]">
        <option value="-1"<?php echo $huoduan['cachetime']=='-1'?' selected="selected"':''?>>不缓存</option>
        <option value="3600"<?php echo $huoduan['cachetime']=='3600'?' selected="selected"':''?>>1小时</option>
        <option value="10800"<?php echo $huoduan['cachetime']=='10800'?' selected="selected"':''?>>3小时</option>
        <option value="21600"<?php echo $huoduan['cachetime']=='21600'?' selected="selected"':''?>>6小时</option>
        <option value="43200"<?php echo $huoduan['cachetime']=='43200'?' selected="selected"':''?>>12小时</option>
        <option value="86400"<?php echo $huoduan['cachetime']=='86400'?' selected="selected"':''?>>1天</option>
        <option value="259200"<?php echo $huoduan['cachetime']=='259200'?' selected="selected"':''?>>3天</option>
        <option value="604800"<?php echo $huoduan['cachetime']=='604800'?' selected="selected"':''?>>7天</option>
        <option value="2592000"<?php echo $huoduan['cachetime']=='2592000'?' selected="selected"':''?>>一个月</option>
        <option value="0"<?php echo $huoduan['cachetime']=='0'?' selected="selected"':''?>>永久</option>
      </select>  
      <span class="gray">(搜索结果缓存有效时间，建议大于12小时)</span>
      
      </td>
</tr>

<tr>
    <td width="125" align="right" valign="middle" class="s_title">搜索结果排序：</td>
    <td valign="top"><input name="huoduan[sort]" id="sort" type="hidden" value="" />
      <ul class="sxlist" id="sxlist">
      <?php
	     $sort = explode(',',$huoduan['sort']);
		 foreach($sort as $k=>$v){
			 echo '<li>'.$v.'</li>';
		 }
	  ?></ul>
      <span class="gray">(拖拽调整搜索结果排序，以便与其它买家网站有区别)</span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">首页热门词是否显示：</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[close_hotlist]" value="0" <?php echo $huoduan['close_hotlist']==0?' checked="checked"':''?> />
        显示</label>
   
      <label>
        <input type="radio" name="huoduan[close_hotlist]" value="1" <?php echo $huoduan['close_hotlist']==1?' checked="checked"':''?> />
        关闭</label>  <span class="gray"></span>
      
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">热门搜索词：</td>
    <td valign="top">
      <label>
        <input type="radio" name="huoduan[hotkeytype]" value="1" id="hotkeytype_1"<?php echo $huoduan['hotkeytype']==1?' checked="checked"':''?> />
        自动获取百度排行榜</label>
   
      <label>
        <input type="radio" name="huoduan[hotkeytype]" value="2" id="hotkeytype_2"<?php echo $huoduan['hotkeytype']==2?' checked="checked"':''?> />
        完全自定义热门词</label>（将会把首页和搜索页面的热门词都换成自定义关键词，在<a href="./other.php" target="_self">[其它]</a>管理自定义热词） </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">实时热门搜索缓存：</td>
    <td valign="top">
      <select name="huoduan[hotcachetime]">
        <option value="1800"<?php echo $huoduan['hotcachetime']=='1800'?' selected="selected"':''?>>30分钟</option>
        <option value="3600"<?php echo $huoduan['hotcachetime']=='3600'?' selected="selected"':''?>>1小时</option>
        <option value="7200"<?php echo $huoduan['hotcachetime']=='7200'?' selected="selected"':''?>>2小时</option>
        <option value="14400"<?php echo $huoduan['hotcachetime']=='14400'?' selected="selected"':''?>>4小时</option>
       
      </select>  
      <span class="gray">(百度实时热点搜索排行榜缓存时间，建议在1小时左右)</span>
      
      </td>
</tr>


<tr>
    <td width="125" align="right" valign="middle" class="s_title">底部信息：</td>
    <td valign="top"><textarea name="huoduan[foot]" cols="80" rows="5"><?php $huoduan['foot'] = str_replace("\\'","'",$huoduan['foot']);echo htmlspecialchars($huoduan['foot'])?></textarea>
      </td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">登录账号：</td>
    <td valign="top"><input type="text" name="huoduan[admin_name]" value="<?php echo $huoduan['admin_name']?>" size="30">
      <span class="gray tips"></span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">登录密码：</td>
    <td valign="top"><input type="text" name="huoduan[admin_pass]" value="" size="30">
      <span class="gray tips">不修改请留空</span></td>
</tr>
<tr>
    <td width="125" align="right" valign="middle" class="s_title">禁止某些IP访问：</td>
    <td valign="top">多个IP请用“|”分开，如111.111.111.111|222.222.222.222<div class="cl5"></div><textarea name="huoduan[ip]" cols="80" rows="3"><?php echo $huoduan['ip']?></textarea>
      </td>
</tr>
<tr>
<td colspan="10" align="center"><input id="configSave" type="submit" onclick="return getsort()" value="     保 存     "></td>
</tr>
</table>


</form>
<script type="text/javascript">
			$(".sxlist:first").dragsort();
		</script>
</div><!--main-->
<?php include('foot.php'); ?>
</body>
</html>
