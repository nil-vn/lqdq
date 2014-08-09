(function($) {
    $.QueryString = (function(a) {
        if (a == "") return {};
        var b = {};
        for (var i = 0; i < a.length; ++i)
        {
            var p=a[i].split('=');
            if (p.length != 2) continue;
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'))
})(jQuery);
function ajaxUpdate() {
	var ajaxLoad = '<div style="width:100%;text-align:center"><img src="/back-office/themes/admincp/img/webmail/ajaxload.gif" /></div>';
	$.ajax({
		type:'POST',
		url: window.location.pathname + window.location.search,
		data: {'isAjaxUpdate':true},
		beforeSend:function(){
			$("#table_content").css("opacity","0.5");
			$("#table_content").css("-moz-transition","all 0.2s ease-out");
			$("#table_content").css("-webkit-transition","all 0.2s ease-out");
			$("#table_content").css("-o-transition","all 0.2s ease-out");
			$("#table_content").css("-ms-transition","all 0.2s ease-out");
			$("#table_content").css("transition","all 0.2s ease-out");
			//$("#table_content").html(ajaxLoad);
		},
		success:function(data){
			$("#table_content").css("opacity","1");
			$("#table_content").css("-moz-transition","all 0.2s ease-out");
			$("#table_content").css("-webkit-transition","all 0.2s ease-out");
			$("#table_content").css("-o-transition","all 0.2s ease-out");
			$("#table_content").css("-ms-transition","all 0.2s ease-out");
			$("#table_content").css("transition","all 0.2s ease-out");
			$('#table_content').html(data);
		},
		error:function(){
			$("#table_content").css("opacity","1");
			$("#table_content").css("-moz-transition","all 0.2s ease-out");
			$("#table_content").css("-webkit-transition","all 0.2s ease-out");
			$("#table_content").css("-o-transition","all 0.2s ease-out");
			$("#table_content").css("-ms-transition","all 0.2s ease-out");
			$("#table_content").css("transition","all 0.2s ease-out");
			//$("#table_content").html("<center><h3>There is no data response. Please try again!!!</h3></center>");
		},
	});
}
$(function () {
	$("#ajaxUpdate").click(function () {
		ajaxUpdate();
	});
});
//
 $(document).ready(function() {
        $(".privilege_vendu_immo_actualiser").click(function() {
            var idanon = $("#pro_ve_im_ac").val();
            if (confirm('Attention ! Vous êtes sur le point de modifier la facture déjà enregistrée.\nVeuillez confirmer l\'actualisation des données de facturation.')) {
                window.location.replace(webroot + "/privileges/privilege_vendu_immo/" + idanon);
            }
            return false;
        });
    });