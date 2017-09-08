<?php if(!defined("a")) exit("Error 001");?>
<div id="header">
  <div class="con">
      <h1 class="logo png"><a href="./">火端搜索</a></h1>
      <div class="huoduan_info"><a href="http://doc.huoduan.com/search/221048" target="_blank">使用帮助</a> &nbsp;<a href="../" target="_blank">网站首页</a>，欢迎您，<?php echo $huoduan['admin_name']?>，&nbsp;<a href="./login.php?act=logout">退出</a></div>
      <ul class="huoduan_nav">
         <li><a href="./"<?php echo $nav=='home'?' class="this"':''?>>首页</a></li>
         <li><a href="./setting.php"<?php echo $nav=='setting'?' class="this"':''?>>设置</a></li>
         <li><a href="./ads.php"<?php echo $nav=='ads'?' class="this"':''?>>广告</a></li>
         <li><a href="./plus.php"<?php echo $nav=='plus'?' class="this"':''?>>扩展</a></li>
         <li><a href="./seturl.php"<?php echo $nav=='seturl'?' class="this"':''?>>劫持</a></li>
         <li><a href="./other.php"<?php echo $nav=='other'?' class="this"':''?>>其它</a></li>
         <li><a href="./code.php"<?php echo $nav=='code'?' class="this"':''?>>代码</a></li>
         <li><a href="./sitemap.php"<?php echo $nav=='sitemap'?' class="this"':''?>>地图</a></li>
         <li><a href="./cache.php"<?php echo $nav=='cache'?' class="this"':''?>>缓存</a></li>
     
      </ul>
  </div>
</div><!--header-->
