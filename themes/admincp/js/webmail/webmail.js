// webmail update
/*var msg = 'Etes-vous certain de vouloir modifier le type de bien, votre annonce sera modifiée en conséquence. <br />';
			msg+= 'Veuillez confirmer votre choix en cliquant sur le bouton OK.';
		
		alertify.set({ labels: {
			ok		: "OK",
			cancel	: "Cancel"
		}});
		alertify.confirm(msg, function (e) {
			if (e) {
				$("form#saveCategoryForm").submit();
			} else {
				return false;
			}
		});*/
function flagOn(name,date,mes) {
	var html= '<h3>'+name+' - le '+date+'</h3><br />'+mes;
	alertify.set({ labels: {
		ok		: "OK",
	}});
	alertify.alert(html, function (e) {
		if (e) {
			return false;
		} else {
			return false;
		}
	});
}

$(function () {
	$("#sendMail").click(function () {
		setTimeout(function(){ message('success','Success!!!',3000);location.reload();},500);
	});
});

$(function () {
	$(".update").click(function () {
		var ajaxLoad = '<div style="width:100%;text-align:center"><img src="/back-office/themes/admincp/img/webmail/ajaxload.gif" /></div>';
		
		$.ajax({
			type:'POST',
			url: '/back-office/webmail/updateAjax',
			beforeSend:function(){
				$("#message").html(ajaxLoad);
			},
			success:function(data){
				$("#message").html(data);
			},
			error:function(){$("#message").html("<center><h3>There is no data response. Please try again!!!</h3></center>");},
		});
	});
});
$(function () {
	$(".downloadAttachment").click(function () {
		$(this).attr({
			'href': webroot+'/webmail/download'+$(this).attr('value'),
		});
	});
});

function webmail_update() {
	$(document).ready(function() {
		$.ajax({
			type:'POST',
			url: '/back-office/webmail/updateAjax',
			beforeSend:function(){
			},
			success:function(data){
				$("#message").html(data);
			},
			error:function() {
				$("#message").html("<h3>There is no data response. Please try again!!!</h3>");
			},
		});
	});
}

// webmail delete
function webmail_delete(id,action){
		if (action=='delete') {
			var html= '<h3>Confirmation de suppression</h3><br />Veuillez confirmer la suppression de ce message';
			alertify.set({ labels: {
				ok		: "Supprimer",
				cancel  : "Annuler",
			} ,
			buttonFocus: "cancel"
			});
			alertify.confirm(html, function (e) {
				if (e) {
					$.ajax({
					type: "POST",
					url: '/back-office/webmail/delete',
					data : {"id" : id},
					beforeSend:function(){
					},
					success:function(data){
						javascript:parent.jQuery.fancybox.close();
						webmail_update();
					},
					error:function(){alert("An error occurs");},
					});				
				} else {
					return false;
				}
			});
		}
}
// webmail delete all
function webmail_deleteAll() {
	if (isCheck()==0) {
		var html= '<h3>Suppression impossible</h3><br />Vous devez sélectionner au moins un message.';
		alertify.set({ labels: {
			ok		: "OK",
		}});
		alertify.alert(html, function (e) {
			if (e) {
				return false;
			} else {
				return false;
			}
		});
		return false;
	}
	var html= '<h3>Confirmation de suppression</h3><br />Veuillez confirmer la suppression des '+isCheck()+' messages sélectionnés.';
	alertify.set({ labels: {
					ok		: "Supprimer",
					cancel  : "Annuler",
				} ,
					buttonFocus: "cancel"
				});
	var strData = "";
	alertify.confirm(html, function (e) {
		if (e) {
			$(function () {
				$(".MyMessagesPage-mmfpCheckboxMessage").find(":checkbox").each(function () {
					if (this.checked == true) {
						strData = strData + $(this).attr('value')+",";
					}
				});
				$.ajax({
					type: "POST",
					url: '/back-office/webmail/deleteAll',
					data : {"id" : strData},
					beforeSend:function(){
					},
					success:function(data){
						webmail_update();
					},
					error:function(){},
				});
			});
		} else {
			return false;
		}
	});
}
function isCheck() {
	var dem = 0;
	$(".MyMessagesPage-mmfpCheckboxMessage").find(":checkbox").each(function () {
		if (this.checked == true) {
			dem = dem + 1;
		}
	});
	return dem;
}
//
// mark as processed
function webmail_markAsProcessed(id) {
	var html= '<h3>Veuillez saisir les informations à enregistrer sur ce message</h3>';
	alertify.set({ labels: {
		cancel  : "Cancel",
		ok		: "OK",
	}});
	alertify.prompt(html, function (e,str) {
		if (e) {
			$.ajax({
			type: "POST",
			url: '/back-office/webmail/markProcessed',
			data : {"id" : id,"comment" : str},
			beforeSend:function(){
			},
			success:function(data){
				javascript:parent.jQuery.fancybox.close();
				webmail_update();
			},
			error:function(){alert("An error occurs");},
			});
		} else {
			return false;
		}
	});
}
// webmail close
function webmail_markAsTraite(id) {
	var html= '<h3>Veuillez saisir les informations à enregistrer sur ce message</h3>';
	alertify.set({ labels: {
		cancel  : "Annuler",
		ok		: "Marquer comme traité",
	},
	buttonFocus: "cancel"});
	alertify.confirm(html, function (e) {
		if (e) {
			$.ajax({
			type: "POST",
			url: '/back-office/webmail/markTraite',
			data : {"id" : id},
			beforeSend:function(){
			},
			success:function(data){
				javascript:parent.jQuery.fancybox.close();
				webmail_update();
			},
			error:function(){alert("An error occurs");},
			});
		} else {
			return false;
		}
	});
}

// reponse mail

// show message list
$(function () {
	$("#categorie").change(function () {
		$.ajax({
			type:'POST',
			url: '/back-office/suivi_clientele/showMessageList',
			data: {'id': $(this).val()},
			beforeSend:function(){
			},
			success:function(data){
				$('#messagebox').html(data);
			},
			error:function(){alert("Error");},
		});
	});
});

// show template

//
//Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//
// 
$(function () {
	$("#nouvelle_fiche_acquereur").click(function () {
		var id=$(this).attr('value');
		$.ajax({
			type:'POST',
			url: '/back-office/webmail/nouvelleFicheAcquereur',
			data: {'id': id},
			beforeSend:function(){
			},
			success:function(data){
				//$("#trigger").click();
				return true;
			},
			error:function(){},
		});
	});
});


// fancy box
$(document).ready(function() {
	$(".various").fancybox({
		maxWidth: 1067,
		maxHeight: 550,
		fitToView: false,
		width: '100%',
		height: '100%',
		autoSize: false,
		closeClick: false,
		openEffect: 'none',
		closeEffect: 'none',
		beforeLoad: function() {
			var id = $(this.element).attr('value');
			this.title = "Message ref "+id;
			this.href = webroot+"/webmail/message/"+id;
		},
		afterClose: function() {
			webmail_update();
		}
	});
});
$(document).ready(function() {
	$(".validate").fancybox({
		maxWidth: 800,
		maxHeight: 800,
		fitToView: false,
		width: '250px',
		height: '70px',
		autoSize: false,
		closeClick: false,
		openEffect: 'none',
		closeEffect: 'none'
	});
});
$(document).ready(function() {
	$(".imageviewer").fancybox({
		fitToView: true,
		width: '1366px',
		height: '768px',
		autoSize: false,
		closeClick: false,
		openEffect: 'none',
		closeEffect: 'none'
	});
});


