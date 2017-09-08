<?php 
include('../data/huoduan.config.php');
$Shortcut = "[InternetShortcut] 
URL=http://".$_SERVER['HTTP_HOST'].$huoduan['path']."
IDList= 
[{000214A0-0000-0000-C000-000000000046}] 
Prop3=19,2 
"; 
header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=".$huoduan['sitename'].".url;"); 
echo $Shortcut; 
?> 