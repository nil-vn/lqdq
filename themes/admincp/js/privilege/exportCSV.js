$(function () {
	$(".export_premium").click(function () {
		dd = $("#dd").val();
		df = $("#df").val();
		$(this).attr({
			'href': webroot+'/privileges/exportPremium?dd='+dd+'&df='+df,
		});
	});
});
$(function () {
	$(".export_privilege").click(function () {
		dd = $("#dd").val();
		df = $("#df").val();
		$(this).attr({
			'href': webroot+'/privileges/exportPrivilege?dd='+dd+'&df='+df,
		});
	});
});

$(function () {
	$(".export_privilege_avoir").click(function () {
		dd = $("#dd").val();
		df = $("#df").val();
		$(this).attr({
			'href': webroot+'/privileges/exportPrivilegeAvoir?dd='+dd+'&df='+df,
		});
	});
});