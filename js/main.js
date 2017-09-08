try{
  window.onerror = function(){return true;}
}
catch(err){}
function is_mobile() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = false;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = true;
            break;
        }
    }
    return flag;
}
function gotomurl(url) {
	if(is_mobile()){
		window.location.href=url;
	}
}

$(document).ready(function(){
  if(screen.width<1000){
	  $("#res").css("marginLeft","0px");
	 
  }else if(screen.width<1100){
	  $("#sidebar").css("marginLeft","5px");
  }else if(screen.width>1100){
	  $("#hd_main").css("min-width","1100px");
	   $("#header").css("min-width","1100px");
  }

});