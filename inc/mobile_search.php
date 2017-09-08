<?php
if(isset($_GET['more'])){
	include(ROOT_PATH.'/inc/more.php');exit;
}
$pcurl = huoduansourl($q,$p,PCDOMAIN);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,user-scalable=no" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<title><?php echo $q?><?php if($p!=1){echo '第'.$p.'页';}?> - <?php echo $huoduan['sitename']?></title>
<meta name="keywords" content="<?php echo $q?>" />
<meta name="description" content="<?php echo $description?>" />
<link rel="canonical" href="<?php echo $pcurl?>" />
<link href="<?php echo SYSPATH?>images/mobile.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo SYSPATH?>js/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<div class="logo"><a href="<?php echo SYSPATH?>" title="<?php echo $huoduan['sitename']?>"><img src="<?php echo SYSPATH?>images/logo.png" alt="<?php echo $huoduan['sitename']?>" /></a></div>

      <div class="searchbox">
       <form action="<?php echo SYSPATH?>" method="<?php if(REWRITE=='1'){echo 'post';}else{echo 'get';}?>"><input align="middle" name="q" class="q" id="kw" value="<?php echo $q?>" maxlength="1000" autocomplete="off" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜索" type="submit" />
              </form>
      </div>

<div id="hd_main">
<div class="res">

<?php
if($listcount>1 && $kill!=1){
  include(ROOT_PATH.'/data/huoduan.ads.php');
   if($list['count']>0){
	 $countstr = '约'.strrev(implode(',', str_split(strrev($list['count']), 3))).'个'; 
  }
  echo '<div id="resinfo">为您找到"<h1>'.$q.'</h1>"相关结果'.$countstr.'</div>';
  echo '<div id="result">';
  include(ROOT_PATH.'/inc/plus.php');
  for($i=0;$i<$listcount;$i++){
	$ii = $i;
	$ni = $i;
	if($listcount==10){
		$sort = explode(',',$huoduan['sort']);
		$ni = $sort[$i]-1;
	}
    if(($ii+1)==$ads['mobile_search']){
		include(ROOT_PATH.'/data/huoduan.mobile_ads_search.php');
	}
	$sourl = $list['data'][$ni]['link'];
	if(strpos($list['data'][$ni]['link'],'/')){
	   $blink = explode('/',$list['data'][$ni]['link']);
	   $blink = $blink[2];
	   if(strpos($blink,'baidu.com')){
           $blink = $list['data'][$ni]['link'];
       }
	}else{
		 $blink = $list['data'][$ni]['blink'];
	}
    $blink  = strip_tags($blink);
	include(ROOT_PATH.'/inc/seturl.php');
	
	$gourl = qencode($list['data'][$ni]['link']);
		$gotitle = qencode(strip_tags($list['data'][$ni]['title']));
		$gokey = qencode($q);
	 if($huoduan['link_open']==0){
		 $sourl = $list['data'][$ni]['link'];
	 }else{
		 $sourl = SYSPATH.'?a=url&k='.substr(a($gourl.$gotitle.$gokey),0,8).'&u='.$gourl.'&t='.$gotitle.'&s='.$gokey;
	 }

	
	if(is_array($plusnum)){
	   foreach($plusnum as $k=>$v){
			if($pluscontent[$k]!='' && ($ii+1)==$v && ($plususer[$k]==3 || $plususer[$k]==1)){
				echo $pluscontent[$k];
			}
		}
	}
	$yurl = $list['data'][$ni]['blink'];
	  $kurl=0;
	   if(is_file(ROOT_PATH.'/data/huoduan.killurls.txt')){
		  $killurls = file_get_contents(ROOT_PATH.'/data/huoduan.killurls.txt');
		  if(strpos($killurls,"\r\n")>-1){
			$killurls = trim($killurls,"\r\n");
			$killurlslist = explode("\r\n",$killurls);
		  }else{
			   $killurls = trim($killurls,"\n");
			   $killurlslist = explode("\n",$killurls);
		  }
		 
		  foreach($killurlslist as $k=>$v){
		
			  if(substr($v,0,1)=='|'){
				  $v = ltrim($v,'|');
				  if(clear_url($yurl) == clear_url($v)){
					  $kurl=1;
					  break;
				  }
			  }else if(strlen($v)>2){
				  if(strpos(clear_url($yurl),clear_url($v))>-1 || clear_url($yurl) == clear_url($v)){
					  $kurl=1;
					  break;
				  }
			  }
		  }
	   }
	   
	   $list['data'][$ni]['des'] = strip_tags($list['data'][$ni]['des'],'<em> <b>');
	   $noref= strpos($list['data'][$ni]['link'],'.baidu.com')?' noreferrer':'';
	  if($kurl!=1 && strlen($list['data'][$ni]['title'])>0){
	      if(strstr($blink,'baidu.com/link?')){
              $blink='';
          }
	?>
<div class="g"><h2><?php if($huoduan['listnum']==1){?><span class="nums"><?php echo $listnum[$ii]?></span> <?php }?><a href="<?php echo $sourl?>" target="_blank" class="s" rel="nofollow<?php echo $noref;?>"><?php echo $list['data'][$ni]['title']?></a></h2><div class="std"><?php echo $list['data'][$ni]['des']?></div><span class="a"><?php echo $blink?></span></div>    
    <?php	
	  }
  }
  echo '</div>';
}else{
	if($kill==1){
		echo '<div id="result"><div style="padding:30px 10px; text-align:center; color:#F00; font-size:16px;">该关键词已被屏蔽，请更换关键词搜索</div></div>';
	}else{
	    echo '<div id="result"><div style="padding:30px 10px; text-align:center; color:#F00; font-size:16px;">对不起，没有找到相关内容！请更换关键词搜索，或刷新本页重试。</div></div>';
	}
}
$nq = $q;
if($kill!=1){
?>
<div id="moredata"></div>
 <div id="morebtn" style="height:30px; border:1px solid #CCC; background-color:#EDEAEA; text-align:center; line-height:30px; cursor:pointer; overflow:hidden;" onclick="moreData()">点击加载下一页↓</div>
<div class="cl10"></div>
<?php include(ROOT_PATH.'/data/huoduan.mobile_ads_search1.php'); ?>
<div class="cl5"></div>
<input name="pagenum" id="pagenum" type="hidden" value="<?php echo $p+1?>" />
<script type="text/javascript">

function moreData(){ 
      var pagenum = parseInt($("#pagenum").val());
	    $("#morebtn").html('加载中...');
		$.get("<?php echo SYSPATH.''?>", { q: '<?php echo $nq?>', p: pagenum,more:'1'},
		 function(data){

		   if(data.indexOf('NONO_NO_NONO')>0){
			  $("#pagenum").val('');
		   }else{
			   if($("#imgload").val()=='b'){
			      data = data.replace(/n\./g,'n1.');
			   }
			  $("#moredata").append(data);
		      $("#pagenum").val(pagenum+1); 
		   }
		   $("#morebtn").html('点击加载下一页↓');
		 });
}
/*
//把这段注释取消掉即可实现拉到底部自动加载
var totalheight = 0; 
function loadData(){ 
    totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()); 
    if ($(document).height() <= totalheight && $("#pagenum").val()!='' && $("#pagenum").val()<3){ 
		moreData();
    } 
} 

$(window).scroll( function() { 
	loadData();
});*/
</script>
<?php }?>
</div><!--result-->
   <div class="cl10"></div>
    <div class="searchbox">
       <form action="<?php echo SYSPATH?>" method="get"><input align="middle" name="q" class="q" id="kw" baiduSug="1" value="<?php echo $q?>" maxlength="100" autocomplete="off" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜索" type="submit" />
              </form>
      </div>
<div class="cl10"></div>
   <?php
    if($huoduan['xg_open']==1 && $kill!=1){
	   if(is_array($list['xgdata'])){
		   $xgdata = $list['xgdata'];
	   }else{
		  $xgdata = huoduan_get_baidu_xg($q,$huoduan['cachetime']); 
	   }
	   if(is_array($xgdata)){
		   echo '<div class="xglist"><h4>相关搜索</h4><ul>';
		   foreach($xgdata as $v){
			    if(strlen($v)<100){
			   echo '<li><a href="'.huoduansourl($v).'">'.$v.'</a></li>';
				}
				if($k==8){break;}
		   }
		   echo '</ul><div class="cl"></div></div>';
	   }
   }
   ?>
</div><!--res-->

</div><!--main-->

<div id="footer"><p><a href="<?php echo $pcurl?>">电脑版</a></p><?php echo $huoduan['foot']?></div>
<script charset="gbk" src="//www.baidu.com/js/opensug.js"></script>
</body>
</html>