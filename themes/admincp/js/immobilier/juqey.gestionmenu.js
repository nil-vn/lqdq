$(document).ready(function(){
	/**
	* Sự kiện khi click vào button xóa hoắc reactive trong thanh right sidebar.
	**/
	$(".supprimerReactive").live('click',function(){
		var type = $(this).attr('type');
		var property_id = $(this).attr('rel');
		var strOk = "";
		var strLabel = "";
		if(type=='delete'){
			strOk = "Valider la suppression ";
			strLabel = "Supprimession de l'annonce "+public_property_id;
		}else{
			strOk = "Valider la réactivation";
			strLabel = "Réactivation de l'annonce "+public_property_id;
		}
		alertify.set({ labels: {
			ok		: strOk,
			cancel	: "Cancel"
		}});
		alertify.confirm("<b>"+strLabel+"</b><br />Commentaire<textarea style='width:100%' id='strComment'></textarea>", function (e, str) {
			if (e) {
				var str = $("#strComment").val();
				if(str == ''){
					alert('Merci d\'entrer un commentaire.');
					return false;
				}else{
					showloadPage();
					if(type=='delete'){
						$.post(webroot+'/gestionAbonnement/supprimerPost/id/'+public_property_id,{'comment':str,'property_id':public_property_id},function(res){
							hideLoadPage();
							alertify.set({ labels: {
								ok		: "Ok",
							}});
							if(res.code == 1){
								alertify.alert('<h5>Annonce <a href="'+webroot+'/?property_id='+public_property_id+'" target="_top">'+public_property_id+'</a> supprim&eacute;e avec succ&egrave;s.</h5>',function(){
									window.location.reload();
								});
							}else{
								alertify.alert('<h5 style="color:red">Une erreur est survenue (code:'+res.code+'), merci de r&eacute;essayer plus tard.</h5>');
							}
						});
					}else{
						$.post(webroot+'/gestionAbonnement/reactiver/id/'+public_property_id,{'comment':str,'property_id':public_property_id},function(res){
							hideLoadPage();
							alertify.set({ labels: {
								ok		: "Ok",
							}});
							if(res.code >= 1){
								alertify.alert('<h5>Annonce <a href="'+webroot+'/?property_id='+public_property_id+'" target="_top">'+public_property_id+'</a> r&eacute;activ&eacute;e avec succ&egrave;s.</h5>');
							}else{
								alertify.alert('<h5 style="color:red">Une erreur est survenue (code:'+res.code+'), merci de r&eacute;essayer plus tard.</h5>');
							}
						});
					}
				}
			} else {
				
			}
		});
		return false;
	});
	/* Sự kiện submit form PropertyForcageForm*/
	$("#PropertyForcageForm").submit(function(){
		if($(this).find('#passerelle').val() == ''){
			$(this).find('#passerelle').focus();
			var htmlError1 = '<b>Veuillez vérifier les champs suivants :</b><br />';
			htmlError1+= 'Merci de choisir une passerelle'+'<br />';
			alertify.set({ labels: {
				ok		: "Fermer",
			}});
			alertify.alert(htmlError1);
			return false;
		}
		if($(this).find('#commentaire').val() === ''){
			$(this).find('#commentaire').focus();
			var htmlError1 = '<b>Veuillez vérifier les champs suivants :</b><br />';
			htmlError1+= 'Merci d\'entrer un commentaire'+'<br />';
			alertify.set({ labels: {
				ok		: "Fermer",
			}});
			alertify.alert(htmlError1);
			return false;
		}
		showloadPage();
	});
});
function showloadPage()
{
	$("body").append('<div id="show_load_page"><img src="'+themeUrl+'/img/spinner-mini.gif" /></div>');
	var paddingTop = $(window).height()/2;
	var paddingLeft = $(window).width()/2;
	$("#show_load_page").css({'background':'#fff','position': 'fixed','width':'100%','height':'100%','z-index':'999999','top':0,'opacity':0.6,'padding-top':paddingTop,'padding-left':paddingLeft});
}
function hideLoadPage()
{
	$("#show_load_page").remove();
}