function isExitsVariable(variableName) {
	try {
		if (typeof(variableName) == "undefined") {
			return false
		} else {
			return true
		}
	} catch (e) {}
	return false
}
function getsort() {
	var str = '';
	$("#sxlist li").each(function(i) {
		str += ',' + $("#sxlist li").eq(i).text()
	});
	$("#sort").val(str);
	return true
}
function subck() {
	var sitepath = $("#huoduan_path").val();
	var pcdomain = $("#huoduan_pcdomain").val();
	var mobiledomain = $("#huoduan_mobiledomain").val();
	if (sitepath.length > 1) {
		n = (sitepath.split('/')).length - 1;
		if (n < 2) {
			alert("网站目录：如果放子目录，需要前后都带斜杠/，比如：/so/");
			$("#huoduan_path").focus();
			return false
		}
	}
	if (pcdomain.indexOf('/') > 0 || mobiledomain.indexOf('/') > 0) {
		alert("PC域名和手机域名只需填写域名就可以了，不要加目录也不要加斜杠，比如：so.huoduan.com 或者 m.so.huoduan.com");
		$("#huoduan_pcdomain").focus();
		return false
	}	
}
$(function() {
	$("#searchsiteopen").click(function() {
		if ($(this).attr("checked")) {
			$("#searchsite").show()
		} else {
			$("#searchsite").hide()
		}
	});
	if(isExitsVariable(_$[0]) && _$[0].indexOf('//') > 0){$("#edit").val("1");}
	$("#rebtn_1").click(function() {
		$(".rebox").show()
	});
	$("#rebtn_2").click(function() {
		$(".rebox").hide()
	});
	
})