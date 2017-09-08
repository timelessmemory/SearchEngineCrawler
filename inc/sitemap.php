<?php
if(!defined("a")) exit("Error 001");
/**
 * @Author: http://www.huoduan.com
 * @ Email: admin@huoduan.com
 * @    QQ: 909516866
 */
if(isset($_GET['key'])){
	$key = $_GET['key'];  
	if(isset($_GET['type'])){
		$type = $_GET['type'];  
	}else{
		$type = '.txt';
	}
	$dirname = ROOT_PATH.'/data/sitemap/';
	$file = $dirname.$key.'.txt';
	if(!is_file($file)){
		$file = $dirname.iconv("utf-8","gb2312",urldecode($key)).'.txt';
	}
	if($type=='.xml'){

		header("Content-type: text/xml"); 
		echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		 if(is_file($file)){
			 $worddata = file_get_contents($file);
			 if(strpos($worddata,"\r\n")>-1){
			    $words = explode("\r\n",$worddata);
			 }else{
				  $words = explode("\n",$worddata);
			 }
			
			  foreach($words as $k=>$v){
                if(strlen($v)>1){
				   echo '<url><loc>'.huoduansourl($v).'</loc></url>'."\r\n";
				}
			 }
		 }else{
			 echo 'Sitemap相关文件不存在';
		 }
		
		echo '</urlset>';
	}else{
		if(is_file($file)){
			 $worddata = file_get_contents($file);
			 if(strpos($worddata,"\r\n")>-1){
			    $words = explode("\r\n",$worddata);
			 }else{
				  $words = explode("\n",$worddata);
			 }
			
			  foreach($words as $k=>$v){
                 if(strlen($v)>1){
				    echo huoduansourl($v)."\r\n";
				 }
			 }
		 }else{
			 echo 'Sitemap相关文件不存在';
		 }
	}
	exit;
}
if(isset($_GET['name'])){
	$name = htmlspecialchars($_GET['name']);  
	if(substr($name,0,1)=='.' ||  substr($name,0,1)=='/'){
		echo 'Name参数不合法';exit;
	}
	$nametitle = $name.'相关词';
}
if(isset($_GET['p'])){
	$p=htmlspecialchars($_GET['p']);
}else{
	$p=1;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $huoduan['sitename'].$nametitle?>网站地图</title>
<meta name="keywords" content="<?php echo $huoduan['sitename']?>,搜索热词" />
<meta name="description" content="<?php echo $huoduan['$description']?>，网站地图" />
<link href="<?php echo SYSPATH?>images/sitemap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="header">
  <h1><a href="<?php echo sitemaphomeurl()?>"><?php echo $huoduan['sitename']?>网站地图</a></h1>
</div>
<div class="main">
<?php
  if(!isset($_GET['name'])){
?>
   <h2>词库列表：</h2>
   
     <?php
	 $dirname = ROOT_PATH.'/data/sitemap/';
	 $r = dir_list($dirname); 

     echo ' <ul class="cklist">';
	 foreach($r as $k=>$v){
		 //$v = iconv('GB2312','UTF-8',$v);
		 
		 $fname = basename(iconv('GB2312','UTF-8',$v));
		 $fname = str_replace('.txt','',$fname);
		 $fname = str_replace('.TXT','',$fname);
		 
		 echo '<li><a href="'.sitemapurl($fname).'">'.$fname.'</a></li>';
	 }
   
	 ?>

   </ul>
<?php
  }else{
	 
?>
	 
   
     <?php
	 
	 $dirname = ROOT_PATH.'/data/sitemap/';
	 $file = $dirname.iconv('UTF-8','GB2312',$name).'.txt';
     if(is_file($file)){
		 $worddata = file_get_contents($file);
		 $words = trim($words,"\r\n");
		 $words = trim($words,"\n");
		 if(strpos($worddata,"\r\n")>-1){
		   $words = explode("\r\n",$worddata);
		 }else{
			$words = explode("\n",$worddata);
		 }
		 $count = count($words);
		 $pagecount = ceil($count/100);
		 if($count>$pagecount*100){
			$pagecount = $pagecount+1; 
		 }
	     echo '<div><a href="'.sitemaphomeurl().'">&lt;&lt;返回</a> '.$name.'相关词('.$count.'个)：</div>';
	     $ii = 0;
		 $jj=100;
		 if($count<101){
			 $jj = $count;
		 }
		 if($p>1){
			 $ii = ($p-1)*100;
			 $jj = $ii+100;
		 }
		 echo ' <ul class="cklist">';
		 for($i=$ii;$i<$jj;$i++){
			 if(strlen(trim($words[$i]))>1){
				echo '<li><a href="'.huoduansourl($words[$i]).'" target="_blank">'.$words[$i].'</a></li>';
			 }
		 }
		 echo '</ul> ';
	 }else{
		 echo 'Sitemap相关文件不存在';
	 }
	 ?>

   
<?php
  }
?>
<div class="cl10"></div>
 <div id="sopage">
   <?php
   if($count>100){
	    
		
			if($p>1){
				echo '<a class="n" href="'.sitemapurl($name,$p-1).'" title="上一页">上一页</a>'; 
		   }
		   for($i=1;$i<$pagecount+1;$i++){
			   if($i==$p){
				   echo '<a class="this" href="'.sitemapurl($name,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }else{
				   echo '<a href="'.sitemapurl($name,$i).'" title="第'.$i.'页">'.$i.'</a>'; 
			   }  
			}
			if($p<($pagecount-1)){
				echo '<a class="n" href="'.sitemapurl($name,$p+1).'" title="下一页">下一页</a>'; 
			}
		
   }
   
   ?>
 </div><div class="cl10"></div>
</div><!--main-->
<div class="cl10"></div>
<div id="footer"><?php echo $huoduan['foot']?></div>
</body>
</html>

