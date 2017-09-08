<?php
if(isset($_GET['type'])){
	$type = $_GET['type'];
}else{
   exit;	
}
if($type=='search'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Code</title>
<style>
/* reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{padding:0;margin:0;}
th{text-align:left;}
h1,h2,h3,h4,h5,h6{font-weight:400;font-size:100%;} 
input,textarea,select,button,option{font-family:inherit;font-size:inherit;font-weight:inherit;}

/* global */
body{font-size:12px; font-family:"Microsoft Yahei",Arial, Helvetica, sans-serif;color:#4D4D4D;background:#F1F3F5;}
a{color:#2464B2;text-decoration:none;}
a:hover{text-decoration:underline;}

img{border:0;}

.searchbox{ width:500px; height:34px; margin:0px;}
.searchbox .q{ display:inline-block; background:#FFF; width:404px; height:32px; font-size:16px; color:#CCC; margin:0px; padding:0 10px 0 10px; border:none; float:left; line-height:32px; border:1px solid #CFC7C8; border-right:0px;}
.searchbox .btn{ width:75px; height:34px;line-height:34px; border:none; background-color:#FC8C1D; cursor:pointer; float:right; display:inline-block; color:#FFF; text-align:center; font-size:14px;}
.searchbox .btn:hover{ background:#FC9F38;}
</style>
<script type="text/javascript">
function subck(){
	var q = document.getElementById("kw").value;
	if(q=='' || q=='请输入关键字搜索网页'){return false;}else{return true;}
}
</script>
</head>
<body>
<div class="searchbox">
       <form action="<?php echo SYSPATH?>" method="get" target="_blank" onsubmit="return subck();"><input align="middle" name="q" class="q" id="kw" value="请输入关键字搜索网页" onfocus="javascript:if(this.value=='请输入关键字搜索网页'){this.value='';this.style.color='#333';this.style.borderColor='#FC8105';}" onblur="javascript:if(this.value==''){this.value='请输入关键字搜索网页';this.style.color='#CCC';this.style.borderColor='#CFC7C8';}" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜 索" type="submit" />
              </form>
      </div>
<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
</body>
</html>
<?php
}else if($type=='top' || $type=='my'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Code</title>
<style>
/* reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{padding:0;margin:0;}
th{text-align:left;}
h1,h2,h3,h4,h5,h6{font-weight:400;font-size:100%;} 
input,textarea,select,button,option{font-family:inherit;font-size:inherit;font-weight:inherit;}

/* global */
body{font-size:12px; font-family:"Microsoft Yahei",Arial, Helvetica, sans-serif;color:#4D4D4D;background:#FFF;}
a{color:#2464B2;text-decoration:none;}
a:hover{text-decoration:underline;}
ol,ul,li{list-style:none;}
.rankbox{ padding:0px 10px 8px 10px; border:1px solid #E4E4E4; height:290px; overflow:hidden;}
.rankbox .title{ height:30px; line-height:30px; font-size:14px; font-weight:bold; color:#F30; overflow:hidden; border-bottom:1px dashed #CCCCCC}
.ranklist{ padding:0px; margin:5px; overflow:hidden;  display:inline-block;}
.ranklist li{height:20px; margin:5px 5px 0px 0px; clear:both; overflow:hidden;}
.ranklist li .num{ display:inline-block; float:left; width:16px; height:16px; margin-top:2px; background-color:#609; line-height:16px; text-align:center; color:#FFF; font-size:12px;-moz-border-radius: 3px;-webkit-border-radius: 3px; border-radius:3px;}
.ranklist li .arrow{ display:inline-block; float:left; width:10px; height:16px; margin-top:2px; background:url(a.gif) no-repeat center center; line-height:16px; text-align:center; }
.ranklist li .top1{ background-color:#F90;}
.ranklist li .top2{ background-color:#8CA6DC;}
.ranklist li a{ font-size:14px; display:inline-block; float:left; height:20px; margin-left:5px;padding:0 5px;}
.ranklist li a:hover{ background-color:#F2F1EE; text-decoration:none; padding:0 5px;}
</style>
</head>
<body>

<div class="rankbox">
<div class="title"><?php echo $type=='top'?'今日实时热搜':'热门搜索'?></div>
<ul class="ranklist">
<?php 
if($type=='top'){
     $topkey = huoduan_get_baidu_top($huoduan['hotcachetime']);
     for($i=0;$i<10;$i++){
	?>
        <li><span class="num<?php echo $i<3?' top1':' top2'?>"><?php echo $i+1?></span><a target="_blank" href="<?php echo huoduansourl($topkey[$i])?>"><?php echo $topkey[$i]?></a></li>
        <?php
		 
	 } 
}else{
	   $diykey = file_get_contents(ROOT_PATH.'/data/huoduan.diykey.txt');
		if(strpos($diykey,"\r\n")>-1){
		   $diylist = explode("\r\n",$diykey);
		}else{
			$diylist = explode("\n",$diykey);
		}
		shuffle($diylist);
		if(is_array($diylist)){
		  $count = count($diylist);
		  if($count>10){
			  $j = 10;
		  }else{
			  $j = $count;
		  }
		   for($i=0;$i<$j;$i++){
		        $topn = $i<3?' top1':' top2';
				echo '<li><span class="num'.$topn.'">'.($i+1).'</span><a href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	
		} 
}
	 ?>

</ul>
</div><!--rankbox-->
</html>


<?php
}
?>
<!-- powered by huoduan.com -->