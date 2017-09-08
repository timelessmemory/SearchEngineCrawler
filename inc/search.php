<?php
if(!defined("a")) exit("Error 001");
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */

$ip = get_ip();
if(strpos($ip,'121.42.0.')>-1){//判断是不是阿里云绿网监控IP，屏蔽掉
	header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
	exit;
}
$listnum = array('①','②','③','④','⑤','⑥','⑦','⑧','⑨','⑩');
$myurl = myurl();
if(isset($_GET['q'])){
	$q = hd_clearStr($_GET['q']);	
}else if(isset($_POST['q'])){
	$q = hd_clearStr($_POST['q']);
}
$kill = 0;
if(strlen($q)<1){
	header("location: ".SYSPATH);
	exit;
}
if(isset($_GET['cr']) && strlen($_GET['cr'])>1){
	$q = iconv($_GET['cr'],"utf-8",$q);
	$gourl = huoduansourl($q);
	header("HTTP/1.1 301 Moved Permanently");
    header("location: $gourl");
    exit;
}
$ref = $_SERVER['HTTP_REFERER'];
if(strpos($ref,'m.baidu.com') && strpos($q,'%')>-1){
	$q = urldecode(urldecode($q));
	$gourl = huoduansourl($q);
    header("location: $gourl");
    exit;
}
if(isset($_GET['re']) || isset($_POST['re'])){
	$q = htmlspecialchars_decode($q);
	$gourl = huoduansourl($q);
	header("HTTP/1.1 301 Moved Permanently");
    header("location: $gourl");
    exit;
}
if(isset($_GET['p'])){
	$p=$_GET['p'];
	if($p>50){
	   $p=50;	
	}
	if(REWRITE==1 && strpos(URLRULE2,'{qe}')>-1  && strpos($myurl,'q=')<1 &&  strpos($myurl,'more=1')<1){
		$q = qdecode($q);
        $q = htmlspecialchars($q);
	}
}else{
	$p=1;
	if(REWRITE==1 && strpos(URLRULE1,'{qe}')>-1  && strpos($myurl,'q=')<1 &&  strpos($myurl,'more=1')<1){
		$q = qdecode($q);
        $q = htmlspecialchars($q);
	}
}

$killword = file_get_contents(ROOT_PATH.'/data/huoduan.killword.txt');
  if(strpos($killword,"\r\n")>-1){
	$killword = trim($killword,"\r\n");
	$killwordlist = explode("\r\n",$killword);
  }else{
	   $killword = trim($killword,"\n");
	   $killwordlist = explode("\n",$killword);
  }

  foreach($killwordlist as $k=>$v){
	  $b404 = 0;
	  if(substr($v,0,1)=='~'){
		 $v = ltrim($v,'~'); 
		 $b404 = 1;
	  }
	  if(substr($v,0,1)=='|'){
		  $v = ltrim($v,'|');
		  if(strtolower($q) == strtolower($v)){
			  $listcount=0;
			  $kill=1;
			  $list['count']=0;$list['pnum']=0;
			  if($b404==1){back404();}
			  break;
		  }
	  }else if(strlen($v)>2){
		  if(strpos(strtolower($q),strtolower($v))>-1 || strtolower($q) == strtolower($v)){
			  $listcount=0;
			  $kill=1;
			  $list['count']=0;$list['pnum']=0;
			  if($b404==1){back404();}
			  break;
		  }
	  }
  }
  
$s = urlencode($q);

	$list = huoduan_get_google($q,$p,$huoduan['cachetime'],CX);
	$listcount = count($list['data']);

	if($huoduan['baidu_bak']==1){
		//谷歌没有找到结果后，回去抓取百度的，要取消请删除下面代码
		if($listcount<2){
			$list = huoduan_get_baidu($q,$p,$huoduan['cachetime']);
			$listcount = count($list['data']);
			if($listcount<2){
				$list = huoduan_get_haosou($q,$p,$huoduan['cachetime']);
				$listcount = count($list['data']);
			}
		}
		//备用抓取结束
	}
	
if(is_array($list)){
	$description = $q.'相关信息，'.strip_tags($list['data'][1]['title']).strip_tags($list['data'][2]['des']);
	$description = strip_tags($description);
	$description = str_replace('"','',$description);
}
if($huoduan['xg_open']==1){
	   if(is_array($list['xgdata'])){
		   $xgdata = $list['xgdata'];
	   }else{
		  $xgdata = huoduan_get_baidu_xg($q,$huoduan['cachetime']); 
	   }
}
if($host==strtolower(MOBILEDOMAIN)){
   	include(ROOT_PATH.'/inc/mobile_search.php');
	exit;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $q?><?php if($p!=1){echo '_第'.$p.'页';}?> - <?php echo $huoduan['sitename']?></title>
<meta name="keywords" content="<?php echo $q?>" />
<meta name="description" content="<?php echo $description?>" />
<script type="text/javascript" src="<?php echo SYSPATH?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SYSPATH?>js/main.js"></script>
<?php 
if(MOBILEDOMAIN!=''){
	$mobileurl = huoduansourl($q,$p,MOBILEDOMAIN);
	echo '<meta name="mobile-agent" content="format=html5;url='.$mobileurl.'">
<meta name="mobile-agent" content="format=xhtml;url='.$mobileurl.'">
<meta name="mobile-agent" content="format=wml; url='.$mobileurl.'">';
	$ref = $_SERVER['HTTP_REFERER'];
	if($host!=MOBILEDOMAIN && !refdn($ref,MOBILEDOMAIN)){
?>
<script type="text/javascript">gotomurl('<?php echo $mobileurl?>');</script>
<?php
	} 
}
?>
<link href="<?php echo SYSPATH?>images/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo SYSPATH?>favicon.ico">
<link rel="canonical" href="<?php echo huoduansourl($q,$p)?>" />
<link rel="alternate" media="only screen and(max-width: 640px)" href="<?php echo $mobileurl?>">
<?php 
if(MOBILEDOMAIN!=''){
	$mobileurl = 'http://'.MOBILEDOMAIN.SYSPATH;
	$ref = $_SERVER['HTTP_REFERER'];
	if($host!=MOBILEDOMAIN && !refdn($ref,MOBILEDOMAIN)){
?><script type="text/javascript">gotomurl('<?php echo $mobileurl?>');</script>
<?php
	} 
}
?>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo SYSPATH?>js/DDPNG.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.png');
</script><![endif]-->
</head>

<body>
<div id="header">
  <div class="con">
      <div class="logo png"><a href="<?php echo SYSPATH?>"><?php echo $huoduan['sitename']?></a></div>
      <div class="searchbox">
       <form action="<?php echo SYSPATH?>" method="<?php if(REWRITE=='1'){echo 'post';}else{echo 'get';}?>"><input align="middle" name="q" class="q" id="kw" value="<?php echo $q?>" maxlength="100" size="50" autocomplete="off" baiduSug="1" x-webkit-speech /><?php if(REWRITE=='1'){?><input name="re" type="hidden" value="1" /><?php }?><input id="btn" class="btn" align="middle" value="搜索一下" type="submit" />
              </form>
      </div>
      <a href="<?php echo SYSPATH?>inc/desktop.php" class="desktop" target="_blank">添加搜索到桌面，搜索更便捷！</a>
  </div>
</div><!--header-->

<div id="hd_main">
<div id="res" class="res">
 <?php
 
if($listcount>1 && $kill!=1){
	
  include(ROOT_PATH.'/data/huoduan.ads.php');
  if($list['count']>0){
	 $countstr = '约'.strrev(implode(',', str_split(strrev($list['count']), 3))).'个'; 
  }
  echo '<div id="resinfo">'.$huoduan['sitename'].'为您找到"<h1>'.$q.'</h1>"相关结果'.$countstr.'</div>';
  echo '<div id="result">';
   include(ROOT_PATH.'/inc/plus.php');
  for($i=0;$i<$listcount;$i++){
	$ii = $i;
	$ni = $i;
	if($listcount==10){
		$sort = explode(',',$huoduan['sort']);
		$ni = $sort[$i]-1;
	}
    if(is_array($plusnum)){
			foreach($plusnum as $k=>$v){
				if($pluscontent[$k]!='' && ($ii+1)==$v && ($plususer[$k]==2 || $plususer[$k]==1)){
					echo $pluscontent[$k];
				}
			}
		}
	if(($ii+1)==$ads['search']){
		include(ROOT_PATH.'/data/huoduan.ads_search.php');
	}
	$yurl = strip_tags($list['data'][$ni]['blink']);
	$blink = trim($list['data'][$ni]['blink']);
	include(ROOT_PATH.'/inc/seturl.php');
	
    $gourl = qencode($list['data'][$ni]['link']);
	$gotitle = qencode(strip_tags($list['data'][$ni]['title']));
	$gokey = qencode($q);
	$sourl = SYSPATH.'?a=url&k='.substr(a($gourl.$gotitle.$gokey),0,8).'&u='.$gourl.'&t='.$gotitle.'&s='.$gokey;
	 if($huoduan['link_open']==0){
		 $sourl = $list['data'][$ni]['link'];
	 }
	
	
	$blink = trim($list['data'][$ni]['blink']);
	$blink  = strip_tags($blink);
	if(strpos($blink,'&nbsp;')){
	   $blink = explode('&nbsp;',$blink);
	   $blink = $blink[0];
	}
	if(substr($blink,0,8)=='https://'){
		$blink ='huoduan|'.$blink ;
		$blink = str_replace('huoduan|https://','',$blink);
	}
	if(substr($blink,0,7)=='http://'){
		$blink ='huoduan|'.$blink ;
		$blink = str_replace('huoduan|http://','',$blink);
	}
	$blink = huoduan_msubstr($blink,0,50,true);
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


?>
 

<div class="cl"></div>
 <div id="sopage"><?php 
 if(isset($list['count']) && $list['count']>10 && $kill!=1){
	 $pagecount = ceil($list['count']/10);
	 if($pagecount>11){$pagecount=11;}
	   if($pagecount>10){
		  if($p<8){
		    $ii=1;
		    $jj=11;
		  }else{
			$ii= $p-5;
			$jj = $p+5;
			
			if($jj>$pagecount){
				$jj=$pagecount;
			}
			if($jj-$ii<10){
				$ii = $jj-10;
			}
		  }
	  }else{
		  $ii=1;
		  $jj=$pagecount;
	  }
	   if($pagecount>0){
		   if($p>1){
				echo '<a class="n" href="'.huoduansourl($q,$p-1).'" title="上一页">上一页</a>'; 
		   }
		   for($i=$ii;$i<$jj;$i++){
			   if($i==$p){
				   echo '<a class="this" href="'.huoduansourl($q,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }else{
				   echo '<a href="'.huoduansourl($q,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }  
			}
			if($p<($jj-1)){
				echo '<a class="n" href="'.huoduansourl($q,$p+1).'" title="下一页">下一页</a>'; 
			}
			
	   }
	 
 }else{
 
   if($list['pnum']>0 && $list['pnum']<11){
	   $ii=1;
	   $jj=$list['pnum']+1;
	   
   }else if($list['pnum']>10){
	  
	  $jj=$list['pnum']+1; 
	  $ii=$jj-10;
   }
   if($list['pnum']>0){
	   if($p>1){
			echo '<a class="n" href="'.huoduansourl($q,$p-1).'" title="上一页">上一页</a>'; 
		   }
	   for($i=$ii;$i<$jj;$i++){
		   
			   if($i==$p){
				   echo '<a class="this" href="'.huoduansourl($q,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }else{
				   echo '<a href="'.huoduansourl($q,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }  
		}
		if($list['pnext']==1){
			echo '<a class="n" href="'.huoduansourl($q,$p+1).'" title="下一页">下一页</a>'; 
		}
		
   }
}
   ?></div>
   
   <div class="cl10"></div>
   <?php include(ROOT_PATH.'/data/huoduan.ads_search1.php'); ?>

   <?php
   if($huoduan['xg_open']==1 && $kill!=1){
	   
	   if(is_array($xgdata)){
		   echo '<div class="xglist"><h4>相关搜索</h4><ul>';
		   foreach($xgdata as $k => $v){
			    if(strlen($v)<100){
			   echo '<li><a href="'.huoduansourl($v).'">'.$v.'</a></li>';
				}
				if($k==8){break;}
		   }
		   echo '</ul><div class="cl10"></div></div>';
	   }
   }

   ?>
</div><!--res-->


<div id="sidebar">
<?php 
if(is_array($plusnum)){
foreach($plusnum as $k=>$v){
			if($plussidebar[$k]!=''){
				echo $plussidebar[$k];
			}
		}
}
include(ROOT_PATH.'/data/huoduan.ads_sidebar.php'); ?>
<?php
if($huoduan['close_hotlist']!=1){ ?>
<div class="rankbox">
<div class="title"><?php echo $huoduan['hotkeytype']==1?'今日实时热搜':'热门搜索'?></div>
<ul class="ranklist">
<?php 
   if($huoduan['hotkeytype']==1){ 
     $topkey = huoduan_get_baidu_top($huoduan['hotcachetime']);
     for($i=0;$i<10;$i++){
	?>
        <li><span class="num<?php echo $i<3?' top'.($i+1):''?>"><?php echo $i+1?></span><a href="<?php echo huoduansourl($topkey[$i])?>"><?php echo $topkey[$i]?></a></li>
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
			
				echo '<li><span class="num'.($i<3?' top'.($i+1):'').'">'.($i+1).'</span><a href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	
		}  
   }
	 ?>

</ul>
</div><!--rankbox-->
<?php
} ?>
<?php include(ROOT_PATH.'/data/huoduan.ads_sidebar1.php'); ?>
<div class="cl10"></div>

<div class="rankbox">
<div class="title">网友在搜</div>
<ul class="ranklist">
<?php 
     if($huoduan['hotkeytype']==1){ 
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
		
				echo '<li><span class="arrow"></span><a href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	
		} 
	 }else{
		   for($i=10;$i<20;$i++){
		
				echo '<li><span class="arrow"></span><a href="'.huoduansourl($diylist[$i]).'">'.$diylist[$i].'</a></li>'; 
			} 
	 }
		
  
?>

</ul>
</div><!--rankbox-->

</div><!--sidebar-->


</div><!--main-->


<div id="footer"><?php echo $huoduan['foot']?></div>
<script charset="gbk" src="//www.baidu.com/js/opensug.js"></script>
<!--<?php echo $list['from']?>-->
</body>
</html>
