<?php 
include('config.php'); 
include('admincore.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('inc.php'); ?>
</head>

<body>
<?php $nav = 'cache';include('head.php'); ?>

<div id="hd_main">

  <!-- <div class="btnlist"><a<?php echo $_GET['c']=='0'?' class="this"':''?> href="./cache.php?act=cache&c=0">清除全部缓存</a><a<?php echo $_GET['c']==1?' class="this"':''?> href="./cache.php?act=cache&c=1">清除1天前缓存</a><a<?php echo $_GET['c']==3?' class="this"':''?> href="./cache.php?act=cache&c=3">清除3天前缓存</a><a<?php echo $_GET['c']==7?' class="this"':''?> href="./cache.php?act=cache&c=7">清除7天前缓存</a></div>-->
  <div class="cl10"></div>
 
   <div style="margin:20px; line-height:200%; text-align:left; color:#090; font-size:14px;">
★ 2.1版开始已启用自动分配缓存子目录功能，根据搜索词MD5值“平均”分配到不同的目录下，避免了早期大量文件缓存在一个目录下的问题。新的缓存机制即使缓存几千万的关键词数据也不会存在打开缓存目录卡死的问题。<br /><br />

★ 2.1版开始已不支持后台一键删除缓存文件，需要登录FTP或者服务器删除缓存文件。<br />
<br />
★ 缓存是为了加速访问，删掉缓存不会影响之前的收录，只是会再去抓取数据。空间不够用的话，定期手动删掉部分缓存可以节省空间占用。<br />
<br />
★ 缓存目录是 /cache/
      <?php

/*if(isset($_GET['c']) && isset($_GET['act']) && $_GET['act']=='cache') {
	$c = $_GET['c'];
	switch($c){
		case '0':
		 $user = new huoduan_del();  
         $user->delFileUnderDir('../cache/');
		break;
		case '1':
		 $user = new huoduan_del();  
         $user->delFileUnderDir('../cache/',86400);
		break;
		case '3':
		 $user = new huoduan_del();  
         $user->delFileUnderDir('../cache/',259200);
		break;
		case '7':
		 $user = new huoduan_del();  
         $user->delFileUnderDir('../cache/',604800);
		break;
	}
}*/
  
	  ?>
   </div>
</div><!--main-->

<?php include('foot.php'); ?>

</body>
</html>
