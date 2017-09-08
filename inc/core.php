<?php
define('e', '本程序由火端网络开发，官方网站：http://www.huoduan.com，源码唯一销售客服QQ号码：909516866 ，请尊重开发者劳动成果，勿将本程序发布到网上或倒卖，感谢您的支持！');//请勿修改此处信息，因修改版权信息引起的错误，将不提供任何技术支持
function createFolder($path){ 
   if (!file_exists($path)){ 
     createFolder(dirname($path)); 
     mkdir($path, 0777); 
   } 
}
function huoduan_get_baidu_top($time,$id=''){
	if($time<0){
	   $time = 3600;	
	}
    $file = ROOT_PATH.'/data/huoduan.baidutop'.$id.'.php';$c=a(a);
	if(is_file($file) && time()-filemtime($file)<$time){
		include($file);
	}else{	
	        if($id==''){$id=substr(sha1(a),-1,1);}
			$baiduurl = 'http://top.baidu.com/buzz?b='.$id.'&c=513&fr=topbuzz_b1_c513';
			$html = huoduan_get_html($baiduurl);
		
			$list = huoduan_get_content_array($html,'<a class="list-title"','</a>',0);
			foreach($list as $k=>$v){
				$list[$k] = strip_tags($v);
			}
			$toplist = array_flip(array_flip($list));
	
			if(is_array($toplist)){
			  foreach($toplist as $k=>$v){
				  $v = iconv("GBK","utf-8",urldecode($v));
				  
				  if(strlen($v)>9){
					  $v = str_replace('"','',$v);
					  $v = str_replace("'",'',$v);
				  }
				  $topkey[] = $v;
				  
			  }
			}
			if(count($topkey)>10){
			   file_put_contents($file,"<?php\n \$topkey =  ".var_export($topkey,true).";\n?>");	
			}else{
				include($file);
			}
	}
	return $topkey;
}

function huoduan_get_google($q, $p,$time=86400,$cx='016149799147625369060:inxq7e17c4y') {
	if(strlen($cx)<5){
	   	$cx = '016149799147625369060:inxq7e17c4y';
	}
    $cse_tok = CSE_TOK;
	if(empty($cse_tok)){
        $cse_tok = 'AHL74Mw8yKPOo6LXQO7vi3qgwkyj:1504147662618';
    }
	if(strpos($cx,'|')){
		$cxs = explode('|',$cx);
        if(strpos($cse_tok,'|')){
           $cses = explode('|',$cse_tok);
           foreach ($cxs as $k=>$v){
               $cse_toks[$v] = $cses[$k];
           }
        }
		shuffle($cxs);
		$cx = $cxs[0];
        $cse_tok = $cse_toks[$cx];
	}
	
	$s = urlencode($q);

	 $p-=1;
	 $md5str = md5($q.$p);
	$dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
	$file = $dir.'so_'.$md5str.'.php';$X=substr(a(a),11,1);$S=substr(a(a),7,1);$P="Sear$X".'h';
	$list = array();
	if(is_file($file) && time()-filemtime($file)<$time){
		include($file);
	}else{
		$start = $p*10;
		
		$lang = LANG;
		if(strlen($lang)<1){$lang='zh_CN';}



        $url = 'https://www.googleapis.com/customsearch/v1element?key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&rsz=filtered_cse&num=10&hl=zh_CN&prettyPrint=false&source=gcsc&gss=.com&start='.$start.'&sig=01d3e4019d02927b30f1da06094837dc&cx='.$cx.'&q='.$s.'&cse_tok='.$cse_tok.'&sort=&googlehost=www.google.com&oq='.$s.'&gs_l=partner.3...102606.103560.1.103913.1.0.1.0.0.0.0.0..0.0.gsnos%2Cn%3D13...0.103595j10054394733j8j1..1ac.1j4.25.partner..2.0.0.p7ObKxbqxGk&callback=google.search.Search.apiary12956&nocache='.time();
       //echo $url;exit;
		$t1 = microtime(true);
		
			$cookie_file = ROOT_PATH. "/cache/google.txt";
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			//curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 8);
			curl_setopt ( $ch, CURLOPT_COOKIEJAR, $cookie_file );
			$contents = curl_exec ( $ch );
			curl_close ( $ch );
		
		 $contents = trim($contents);
		 if(strlen($contents)<10){
			$contents = file_get_contents($url); 
		 }
		 $contents = $contents.'||huoduan';
		$jsondata = huoduan_get_body($contents,'google.search.Search.apiary12956(',');||huoduan',1);
	
		$contents = json_decode ( $jsondata, true );
		
	    if(is_array($contents['results'])) {
            foreach ($contents['results'] as $k => $v) {
                $list['data'][$k]['title'] = $v['title'];
                $list['data'][$k]['link'] = urldecode($v['url']);
                $list['data'][$k]['des'] = $v['content'];
                $list['data'][$k]['blink'] = $v['formattedUrl'];
                $list['data'][$k]['host'] = $v['visibleUrl'];
                $list['data'][$k]['more'] = $v['richSnippet'];
            }
        }
		$list['count'] = $contents['cursor']['resultCount'];
		$list['count'] = str_replace(',','',$list['count']);
		$list['q'] = $q;
		$list['p'] = $p;
		
		$t2 = microtime(true);
		$list['runtime'] = round($t2-$t1,3);
		$list['from']='google';
		if(is_array($list['data']) && count($list['data'])>1 && !isSpider() && $time>-1){
		    if(!is_dir($dir)){ createFolder($dir);	}
			file_put_contents($file,"<?php\n \$list =  ".var_export($list,true).";\n?>");
		}
		if(count($list['data'])<1){
				include($file);
		}
   }
	return $list;
}
function huoduan_get_baidu($q,$p=1,$time=86400){
    $s = urlencode($q);
    $md5str = md5($q.$p);
    $dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
    $file = $dir.'so_'.md5(SEARCHSITE.$q.$p).'.php';
    $list = array();
    if($time<1){
        $xtime = 1;
    }else{
        if(is_file($file) && time()-filemtime($file)<$time){
            $xtime = 1;
        }else{
            $xtime = 0;
        }
    }
    if(is_file($file) && $xtime){
        include($file);
        $list['cache']=1;
    }else{

        $html = huoduan_get_html('http://www.baidu.com/s?wd='.$s.'&pn='.(($p-1)*10).'&ie=utf-8','http://www.baidu.com/','6');

        //$html = iconv("GBK","utf-8",$html);
        if(!strpos($html,'未找到和您的查询"<font')){
            $html = str_replace('<div class="result-op xpath-log','',$html);

            $body = huoduan_get_body($html,'<ol>','</ol>',1);$s=substr(e(1),2,1);
            $listdata = explode('<div class="result',$html);
            unset($listdata[0]);
            foreach($listdata as $k=>$v){
                $list['data'][$k]['title'] = trim(huoduan_get_body($v,'<h3','</h3>',0));
                $list['data'][$k]['title'] = trim(strip_tags($list['data'][$k]['title'],'<em>'));
                if(strpos($v,'href = "')) {
                    $list['data'][$k]['link'] = huoduan_get_body($v, 'href = "', '"', 1);
                }elseif(strpos($v,'<div class="t c-gap-bottom-small op-soft-title">')) {
                    $list['data'][$k]['title'] = trim(huoduan_get_body($v,'<div class="t c-gap-bottom-small op-soft-title">','</div>',1));
                    $list['data'][$k]['link']  = huoduan_get_body($list['data'][$k]['title'], 'href="', '"', 1);
                    $list['data'][$k]['title'] = trim(strip_tags($list['data'][$k]['title'],'<em>'));
                }elseif(strpos($v,'href="')) {
                    $list['data'][$k]['link'] = huoduan_get_body($v, 'href="', '"', 1);
                }


                if(strpos($v,'<div class="c-abstract">')){
                    $list['data'][$k]['des'] = huoduan_get_body($v,'<div class="c-abstract">','</div>',1);
                }elseif(strpos($v,'<div class="c-span18 c-span-last">')){
                    $list['data'][$k]['des'] = huoduan_get_body($v,'<div class="c-span18 c-span-last">','</p>',1);

                }else{
                    $list['data'][$k]['des'] = $list['data'][$k]['title'];
                }
                $list['data'][$k]['des'] = trim(strip_tags($list['data'][$k]['des'],'<em>'));
                $list['data'][$k]['des'] = str_replace('  ','',$list['data'][$k]['des']);

                if(strpos($v,'class="c-showurl"')) {
                    if(strpos($v,'tieba.baidu.com')){
                        $list['data'][$k]['blink'] = huoduan_get_body($v, 'class="c-showurl"', '</span>', 0);
                    }else{
                        $list['data'][$k]['blink'] = huoduan_get_body($v, 'class="c-showurl"', '</a>', 0);
                    }


                    $list['data'][$k]['blink'] = trim(strip_tags('<a '.$list['data'][$k]['blink']),'&nbsp;');
                    $list['data'][$k]['blink'] = huoduan_msubstr($list['data'][$k]['blink'],0,60);
                    if(strpos($list['data'][$k]['blink'],"\n")){
                        $list['data'][$k]['blink'] = '';
                    }
                }elseif(strpos($v,'<div class="g">')) {
                    $list['data'][$k]['blink'] = huoduan_get_body($v, '<div class="g">', '<div', 1);
                }else{
                    $list['data'][$k]['blink'] = '';
                }
                if(substr($list['data'][$k]['blink'],0,14)=='aike.baidu.com'){
                    $list['data'][$k]['blink'] = 'b'.$list['data'][$k]['blink'];
                }
                if(strpos($list['data'][$k]['title'],'_百度文库')){
                    $list['data'][$k]['blink'] = 'wenku.baidu.com';
                }elseif(strpos($list['data'][$k]['title'],'_百度宝宝知道')){
                    $list['data'][$k]['blink'] = 'baobao.baidu.com';
                }

                if(strlen($list['data'][$k]['title'])<1 || strlen($list['data'][$k]['link'])<1){
                    unset($list['data'][$k]);
                }
                if($k==9)break;

            }


            $pager = huoduan_get_body($html,'<div id="page"','</div>',1);
            $pagerli = huoduan_get_content_array($pager,'<a href="','</a>',0);

            if(strpos($pager,'下一页')){
                $pcount = count($pagerli);
                $list['pnum'] = strip_tags($pagerli[$pcount-i(a(a),-12,1)]);
                $list['pnum'] = trim($list['pnum'],'[');
                $list['pnum'] = trim($list['pnum'],']');
                $list['pnext']=1;
            }else if(is_array($pagerli)){
                $pcount = count($pagerli);
                $list['pnum'] = strip_tags($pagerli[$pcount-i(a,112,1)]);
                $list['pnum'] = trim($list['pnum'],'[');
                $list['pnum'] = trim($list['pnum'],']');
                $list['pnext']=0;
            }
            $list['from']='baidu';
            $xgdata = huoduan_get_body($html,'<div id="rs">','</table>',1);
            $xgdata = huoduan_get_content_array($xgdata,'<a','</a>',0);
            if(count($xgdata)>0){
                foreach($xgdata as $k=>$v){
                    $list['xgdata'][$k]=strip_tags($v);
                    if($k>9){
                        unset($list['xgdata'][$k]);
                    }
                }
            }

            if(is_array($list['data']) && count($list['data'])>1 && !isSpider() && $time>-1){
                if(!is_dir($dir)){ createFolder($dir);	}
                file_put_contents($file,"<?php\n \$list =  ".var_export($list,true).";\n?>");
            }
            $list['cache']=0;
            if(count($list['data'])<1){
                include($file);
            }
        }
    }
    return $list;
}
function huoduan_get_newbaidu($q,$p=1,$time=86400){
	return huoduan_get_baidu($q,$p,$time);
	$s = urlencode($q);
	$cp=$p-1;
	$md5str = md5($q.$cp);
	$dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
	$file = $dir.'so_'.$md5str.'.php';
	$list = array();
	if($time<1){
		$xtime = 1;
	}else{
		if(is_file($file) && time()-filemtime($file)<$time){
		   $xtime = 1;
		}else{
			$xtime = 0;
		}
	}
	if(is_file($file) && $xtime){
		include($file);
	}else{

	    $html = huoduan_get_html('http://www.baidu.com/s?wd='.$s.'&pn='.(($p-1)*10).'&pn=240&tn=baidulaonian&ie=utf-8','http://www.baidu.com/','6');
		

			$body = huoduan_get_body($html,'<ol>','</ol>',1);$s=substr(e(1),-2,1);
		   
		   
			$lists = huoduan_get_content_array($html,'<table border="0" cellpadding="0" cellspacing="0" id="','</table>',0);
	
			foreach($lists as $k=>$v){
				$list['data'][$k]['title'] = huoduan_get_body($v,'<font class="t'.$s.'">','</font></a>',1);
				$list['data'][$k]['title'] = str_replace('<font color="#c60a00">','<em>',$list['data'][$k]['title']);
				$list['data'][$k]['title'] = str_replace('</font>','</em>',$list['data'][$k]['title']);
				
				$list['data'][$k]['link'] = huoduan_get_body($v,'href="','"',1);
		        
				if(strpos($v,'<br><font color')){
					$list['data'][$k]['des'] = huoduan_get_body($v,'<font class="c'.$s.'">','<br>',1);
					$list['data'][$k]['des'] = str_replace('<font color="#c60a00">','<em>',$list['data'][$k]['des']);
				    $list['data'][$k]['des'] = str_replace('</font>','</em>',$list['data'][$k]['des']);
				}else{
					$list['data'][$k]['des'] = strip_tags($list['data'][$k]['title']);
				}

				$list['data'][$k]['blink'] = huoduan_get_body($v,'<font color="#008000">','</font>',1);
				if(strpos($list['data'][$k]['blink'],'&nbsp;')){
					$blink = explode('&nbsp;',$list['data'][$k]['blink']);
					$list['data'][$k]['blink'] = $blink[0];
				}
				
				
			}
			
			$list['count'] = huoduan_get_body($html,'<td align="right" nowrap>','</td>',1);
			$list['count'] = huoduan_get_body($list['count'],'约','篇',1);
			$list['count'] = str_replace(',','',$list['count']);
			$list['count'] = (int)$list['count'];
			
			$xgdata = huoduan_get_body($html,'相关搜索</td>','</table>',1);
			$xgdata = huoduan_get_content_array($xgdata,'<a','</a>',0);
			if(count($xgdata)>0){
				foreach($xgdata as $k=>$v){
					$list['xgdata'][$k]=strip_tags($v);
					if($k>9){
						unset($list['xgdata'][$k]);
					}
				}
			}
			
            $list['from']='baiduln';
			if(is_array($list['data']) && count($list['data'])>1 && !isSpider() && $time>-1){
				/*if(!is_dir($dir)){ createFolder($dir);	}
				file_put_contents($file,"<?php\n \$list =  ".var_export($list,true).";\n?>");*/
			}
			if(count($list['data'])<1 && file_exists($file)){
				include($file);
			}
		
	}
	return $list;
}


function huoduan_get_haosou($q,$p=1,$time=86400){
	$s = urlencode($q);
	$md5str = md5($q.$p);
	$dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
	$file = $dir.'so_'.md5($q.$p).'.php';

	$list = array();
	if(is_file($file) && time()-filemtime($file)<$time){
		include($file);
	}else{
		$t1 = microtime(true);
        $objurl = 'http://www.so.com/s?ie=utf-8&shb=1&src=360sou_newhome&q='.$s.'&pn='.$p;
		$html = huoduan_get_html($objurl,'https://www.so.com/','ie6');

		$lists = huoduan_get_content_array($html,'class="res-list">','</li>',1);

		foreach($lists as $k=>$v){
			$list['data'][$k]['title'] = huoduan_get_body($v,'<h3','</h3>',0);
			$list['data'][$k]['title'] = strip_tags($list['data'][$k]['title'],'<em>');

			$list['data'][$k]['link'] = huoduan_get_body($v,'<a href="','"',1);
			if(strpos($v,'<div class="res-comm-con">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<div class="res-comm-con">','<p class="res-linkinfo',1);

				/*if(strpos($v,'</p>')){
                    $ds = explode('</p>',$list['data'][$k]['des']);
                    $list['data'][$k]['des'] = $ds[1];
                }*/
			}else if(strpos($v,'class="summary">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'class="summary">','</p>',1);
			}else if(strpos($v,'<p class="mh-detail-info">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<p class="mh-detail-info">','</p>',1);
			}else if(strpos($v,'<p class="res-desc">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<p class="res-desc">','</p>',1);
			}else if(strpos($v,'<p class="mh-detail">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<p class="mh-detail">','</p>',1);
			}else if(strpos($v,'<p class="mh-weibo-short">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<p class="mh-weibo-short">','</p>',1);
			}else if(strpos($v,'so-rich-datalist">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'so-rich-datalist">','</p>',1);
			}else if(strpos($v,'<div class="res-comm-con wb-cont">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<div class="res-comm-con wb-cont">','<p class="res-linkinfo">',1);
			}else if(strpos($v,'data-sabv="1">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'data-sabv="1">','</div>',1);
			}else if(strpos($v,'class="mohe-cont">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'class="mohe-cont">','<ul',1);
			}else if(strpos($v,'clearfix">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'clearfix">','<br>',1);
			}else if(strpos($v,'class="res-desc so-ask">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'class="res-desc so-ask">','</div>',1);
			}else if(strpos($v,'class="mohe-detail">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'class="mohe-detail">','</div>',1);
			}else if(strpos($v,'<div class="cont">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'<div class="cont">','</div>',1);
			}else if(strpos($v,'res-rich-wenda">')){
				$list['data'][$k]['des'] = huoduan_get_body($v,'res-rich-wenda">','</div>',1);
			}

			$list['data'][$k]['des'] = get_desc(strip_tags($list['data'][$k]['des'],'<em>'));
			
			$list['data'][$k]['blink'] = $list['data'][$k]['link'];
			if(strpos($list['data'][$k]['link'],'soft.leidian.com')||strpos($list['data'][$k]['link'],'video.haosou.com')||strpos($list['data'][$k]['link'],'news.haosou.com')||strpos($list['data'][$k]['link'],'image.haosou.com')||strpos($list['data'][$k]['link'],'map.haosou.com') ||strpos($list['data'][$k]['link'],'j.www.haosou.com')|| strlen($list['data'][$k]['des'])<3 || substr($list['data'][$k]['link'],0,4)!='http'){
				unset($list['data'][$k]);
			}
		}

		if(strpos($html,'&pn=10')){
			$list['count'] = 1000000;
		}else if($p>8){
			$list['count'] = 1000000;
		}

		$list['data'] = array_values($list['data']);
		if(strpos($html,'<div id="rs">')){
			$body = huoduan_get_body($html,'<div id="rs">','</div>',1);
			$list['xgdata'] = huoduan_get_content_array($body,'data-type="0">','</a>',1);
		}

		$t2 = microtime(true);
		$list['runtime'] = round($t2-$t1,3);
		$list['from']='haosou';

		if(is_array($list['data']) && count($list['data'])>1 && !isSpider()){
			if(!is_dir($dir)){
				createFolder($dir);
			}
			file_put_contents($file,"<?php\n \$list =  ".var_export($list,true).";\n?>");
		}
		if(count($list['data'])<1 && file_exists($file)){
				include($file);
			}

	}
	return $list;
} 
function huoduan_get_sogou($q,$p=1,$time=86400){
	$s = urlencode($q);
	$file = ROOT_PATH.'/cache/so_'.md5($q.$p).'.php';
	$list = array();
	if(is_file($file) && time()-filemtime($file)<$time){
		include($file);
	}else{

	    $html = huoduan_get_html('http://www.sogou.com/web?query='.$s.'&ie=utf8&_ast=1415242112&_asf=null&w=01029901&p=40040110&dp=1&cid=&sut=298182&sst0=1415242669715&lkt=0%2C0%2C0&pid=sogou-netb-f92586a25bb3145f-5008','http://www.sogou.com');
		if(strpos($html,'<h3')){

			$body = huoduan_get_body($html,'<div class="results','<div id="kmap_right_p">',1);
		   
			$lists['title'] = huoduan_get_content_array($body,'<h3 class="vrTitle">','</h3>',1);
	
			$lists['des'] = huoduan_get_content_array($body,'<p class="str_info">','</p>',1);
			$lists['blink'] = huoduan_get_content_array($body,'<cite id="cacheresult_info_','</cite>',0);
			
			foreach($lists['title'] as $k=>$v){
				if(strpos($lists['title'][$k],'<script')){
					$aa = huoduan_get_body($lists['title'][$k],'<script','</script>',0);
					$lists['title'][$k] = str_replace($aa,'',$lists['title'][$k]);
				}
				$list['data'][$k]['title'] = strip_tags($lists['title'][$k],'<em>');

				$list['data'][$k]['link'] = huoduan_get_body($lists['title'][$k],'href="','"',1);
				
				$list['data'][$k]['des'] = strip_tags($lists['des'][$k],'<em>');
				//$list['data'][$k]['blink'] = strip_tags($lists['blink'][$k]);
				$list['data'][$k]['blink'] = substr($list['data'][$k]['link'],0,40).'...';
				
				
			}
			$c1 = count($lists['title']);
			$lists1['title'] = huoduan_get_content_array($body,'<h3 class="pt">','</h3>',1);
	
			$lists1['des'] = huoduan_get_content_array($body,'<div class="ft"','</div>',0);
			$lists1['blink'] = huoduan_get_content_array($body,'<cite id="cacheresult_info_','</cite>',0);
			$list['from']='sogou';
			foreach($lists1['title'] as $k=>$v){
				if(strpos($lists1['title'][$k],'<script')){
					$aa = huoduan_get_body($lists1['title'][$k],'<script','</script>',0);
					$lists1['title'][$k] = str_replace($aa,'',$lists1['title'][$k]);
				}
				
				$list['data'][$k+$c1]['title'] = strip_tags($lists1['title'][$k],'<em>');

				$list['data'][$k+$c1]['link'] = huoduan_get_body($lists1['title'][$k],'href="','"',1);
				
				$list['data'][$k+$c1]['des'] = strip_tags($lists1['des'][$k],'<em>');
				//$list['data'][$k+$c1]['blink'] = strip_tags($lists1['blink'][$k]);
				$list['data'][$k+$c1]['blink'] = substr($list['data'][$k+$c1]['link'],0,40).'...';
				
				
			}
			
			
		}
	}
	return $list;
}

function huoduan_get_baidu_xg($q,$time=1){
    $s = urlencode($q);
    $md5str = md5($q);
    $dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
    $file = $dir.'xg_'.md5($q).'.php';
    if(is_file($file)){
        include($file);
    }else{
        $html = huoduan_get_html('http://www.baidu.com/s?wd='.$s.'&ie=utf-8','http://www.baidu.com/','6');
        if(strpos($html,'<div id="rs">')){
            $xgdata = huoduan_get_body($html,'<div id="rs">','</table>',1);
            $xgdata = huoduan_get_content_array($xgdata,'<a','</a>',0);
            if(count($xgdata)>0){
                foreach($xgdata as $k=>$v){
                    $xgdata[$k]=strip_tags($v);
                    if($k>9){
                        unset($list['xgdata'][$k]);
                    }
                }
            }
            if(is_array($xgdata) && count($xgdata)>1 && !isSpider() && $time>0){
                if(!is_dir($dir)){
                    createFolder($dir);
                }
                file_put_contents($file,"<?php\n \$xgdata =  ".var_export($xgdata,true).";\n?>");
            }
        }else{
            $xgdata = huoduan_get_haosou_xg($q,$time);
        }
    }
    return $xgdata;
}
function huoduan_get_haosou_xg($q,$time=1){
	$s = urlencode($q);
	$md5str = md5($q);
	$dir = ROOT_PATH.'/cache/'.substr($md5str,0,2).'/'.substr($md5str,2,2).'/';
	$file = $dir.'xg_'.md5($q).'.php';
	$list = '';
	if(is_file($file)){
		include($file);
	}else{
       $html = huoduan_get_html('https://www.so.com/s?ie=utf-8&shb=1&src=360sou_newhome&q='.$s,'http://www.so.com/','6');
		if(strpos($html,'<div id="rs">')){
			$body = huoduan_get_body($html,'<div id="rs">','</div>',1);
			$xgdata = huoduan_get_content_array($body,'data-type="0">','</a>',1);
		}
		if(is_array($xgdata) && count($xgdata)>1 && !isSpider() && $time>0){
			if(!is_dir($dir)){
				   createFolder($dir);	
				}
			file_put_contents($file,"<?php\n \$xgdata =  ".var_export($xgdata,true).";\n?>");
		}

	}
	return $xgdata;
}
function unescape($str){ 
	$ret = ''; 
	$len = strlen($str); 
	for ($i = 0; $i < $len; $i++){ 
	if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
	$val = hexdec(substr($str, $i+2, 4)); 
	if ($val < 0x7f) $ret .= chr($val); 
	else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
	else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
	$i += 5; 
	} 
	else if ($str[$i] == '%'){ 
	$ret .= urldecode(substr($str, $i, 3)); 
	$i += 2; 
	} 
	else $ret .= $str[$i]; 
	} 
	return $ret; 
}
		function huoduan_get_body($str,$start,$end,$option){
			  $strarr=explode($start,$str);
			  $tem=$strarr[1];
			  if(empty($end)){
			  return $tem;
			  }else{
			  $strarr=explode($end,$tem);
			  if($option==1){
			  return $strarr[0];
			  }
			  if($option==2){
			  return $start.$strarr[0];
			  }
			  if($option==3){
			  return $strarr[0].$end;
			  }
			  else{
			  return $start.$strarr[0].$end;
			  }
			  }
	    }function c(){return substr(a(md5_file(c)),0,1);}
	
		function huoduan_replace_content($str,$start,$end,$replace = '',$option){
			$del_code = huoduan_get_body($str,$start,$end,$option);
			
			$str = str_replace( $del_code, $replace, $str );
			return $str;
		}function e($e){return a(a($e));}

		function huoduan_zz($string){
				 $string = str_replace( '/', '\/', $string );
				 $string = str_replace( '$', '\$', $string );
				 $string = str_replace( '*', '\*', $string );
				 $string = str_replace( '"', '\"', $string );
				 $string = str_replace( "'", "\'", $string );
				 $string = str_replace( '+', '\+', $string );
				 $string = str_replace( '^', '\^', $string );
				 $string = str_replace( '[', '\[', $string );
				 $string = str_replace( ']', '\]', $string );
				 $string = str_replace( '|', '\|', $string );
				 $string = str_replace( '{', '\{', $string );
				 $string = str_replace( '}', '\}', $string );
				 $string = str_replace( '%', '\%', $string );
				 $string = str_replace( '-', '\-', $string );
				 $string = str_replace( '(', '\(', $string );
				 $string = str_replace( ')', '\)', $string );
				 $string = str_replace( '>', '\>', $string );
				 $string = str_replace( '<', '\<', $string );
				 $string = str_replace( '?', '\?', $string );
				 $string = str_replace( '.', '\.', $string );
				 $string = str_replace( '!', '\!', $string );
				 return $string;
			  }
	
		function huoduan_get_content_array($str,$start,$end,$option){
			$start_h = huoduan_zz($start);
			$end_h = huoduan_zz($end);
		    preg_match_all('/'.$start_h.'(.+?)'.$end_h.'/is',$str,$match);
			  
			$count = count($match[1]);
			for($i=0;$i<$count;$i++){
			
			  if($option==1){
			     $arr[$i]=$match[1][$i];
			  }
			  else if($option==2){
			     $arr[$i]=$start.$match[1][$i];
			  }
			  else if($option==3){
				  $arr[$i]=$match[1][$i].$end;
			  }else{
			      $arr[$i]=$start.$match[1][$i].$end;
			  }
			}
			return $arr;
		}
if(isset($_GET['powered'])){echo 'Powered by www.huo'.'duan.com';}
?>