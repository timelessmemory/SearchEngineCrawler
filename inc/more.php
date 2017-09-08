<?php
if($listcount>1){
      
	  for($i=0;$i<$listcount;$i++){
		$blink = explode('/',$list['data'][$i]['link']);
          if(strpos($blink,'baidu.com')){
              $blink = $list['data'][$ni]['blink'];
          }
	  $list['data'][$ni]['link'] = $list['data'][$i]['link'];
      include(ROOT_PATH.'/inc/seturl.php');
	  $list['data'][$i]['link'] = $list['data'][$ni]['link'];
	   $yurl = $list['data'][$i]['blink'];
	  $sourl = $list['data'][$i]['link'];
	  
	  $gourl = qencode($list['data'][$i]['link']);
	  $gotitle = qencode(strip_tags($list['data'][$i]['title']));
	  $gokey = qencode($q);
	 if($huoduan['link_open']==0){
		 $sourl = $list['data'][$i]['link'];
	 }else{
		 $sourl = SYSPATH.'?a=url&k='.substr(a($gourl.$gotitle.$gokey),0,8).'&u='.$gourl.'&t='.$gotitle.'&s='.$gokey;
	 }
	 
	  
      $list['data'][$ni]['des'] = strip_tags($list['data'][$ni]['des'],'<em> <b>');
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
	   if($kurl!=1){
	  ?>
  <div class="g"><h2><?php if($huoduan['listnum']==1){?><span class="nums"><?php echo $listnum[$ii]?></span> <?php }?><a href="<?php echo $sourl?>" target="_blank" class="s" rel="nofollow"><?php echo $list['data'][$i]['title']?></a></h2><div class="std"><?php echo $list['data'][$i]['des']?></div><span class="a"><?php echo $blink[2]?></span></div>    
	  <?php	
       }
	}

}else{
	echo '[NONO_NO_NONO]';
}
?>