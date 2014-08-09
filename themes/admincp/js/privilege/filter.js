$(document).ready(function(){
	$(".filter").find(":input[type='text']").each(function () {
		var name = $(this).attr("name");
		$("input[name='"+name+"']").val($.QueryString[name]);
	});
	$(".filter").find("select").each(function () {
		var name = $(this).attr("name");
		$("option[value='"+$.QueryString[name]+"']").attr('selected','selected');
	});
	$(".filter").find(":input[type='checkbox']").each(function () {
		var name = $(this).attr("name");
		if ($.QueryString[name]) {
			$("input[name='"+name+"']").attr('checked','checked');
		}
	});
	
	var start = window.location.href.lastIndexOf("/")+1;
	var len;
	var value;
	if (window.location.href.indexOf("?")>0) {
		len = window.location.href.indexOf("?")-start;
		value = window.location.href.substr(start,len);
	} else {
		value = window.location.href.substr(start);
	}	 
	if (value=='privilege_avoir' || value=='privilege') {
		value='premium';
	}
	if (value=='privileges'||value=='') {
		value='privilege_maj';
	}
	$("option[value='"+value+"']").attr('selected','selected');
});