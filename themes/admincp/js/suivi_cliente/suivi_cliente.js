$(function () {
	$("#idmessage").change(function () {
		var id = $(this).val();
		$.ajax({
			type:'POST',
			url: '/back-office/suivi_clientele/showTemplate',
			data: {'id': id},
			beforeSend:function(){
			},
			success:function(data){
				$('#message').html(data);
			},
			error:function(){alert("Error");},
		});
	});
});