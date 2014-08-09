$(document).ready(function(){
	if($("#WpListCustomer_customer_tel_link").length == 1){
		var numTel = $("#WpListCustomer_customer_tel_link").attr('rel');
		if(numTel.length ==10){
			var url = "https://www.google.fr/search?q=%22"+str_split_phone(numTel,2,'+')+"%22+OR+%22"+str_split_phone(numTel,2,'-')+"%22+OR+%22"+numTel+"%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";
			$("#WpListCustomer_customer_tel_link").attr('href',url);
		}
	}
	if($("#WpListCustomer_customer_phone_link").length == 1){
		var numPhone = $("#WpListCustomer_customer_phone_link").attr('rel');
		if(numPhone.length ==10){
			var url = "https://www.google.fr/search?q=%22"+str_split_phone(numPhone,2,'+')+"%22+OR+%22"+str_split_phone(numPhone,2,'-')+"%22+OR+%22"+numPhone+"%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";
			$("#WpListCustomer_customer_phone_link").attr('href',url);
		}
	}

	// $(".update_aquereurs_form").fancybox({
		// width:"550px",
		// afterLoad:function(){
			
		// }
	// });
	$(".table-list-comment").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
	$(".acq-write_comment").live('click',function(){
		var _this = $(this);
		var comment = $(this).parent().find(".ip-content textarea").val();
		$.ajax({
			type: 'POST',
			url:webroot+ '/common/aquereurAddComment',
			data:{'comment':comment,'acqId':_this.attr('rel'),'type':1},
			beforeSend:function(){
				if(comment == ''){
					_this.parent().find(".ip-content textarea").focus();
					error('Merci d\'entrer un commentaire');
					return false;
				}
				_this.attr('disabled','disabled');
				html = '<tr><td>'+date(dateType)+'</td><td>'+comment+' <br /> Edité par <strong>'+userName+'<strong></td></tr>';
				_this.parent().find(".table-list-comment table tbody").prepend(html);
				var count = parseInt(_this.parent().find(".table-list-comment table thead .countComment").html());
				_this.parent().find(".table-list-comment table thead .countComment").html(count+1);
				_this.parent().find(".table-list-comment").getNiceScroll().resize();
				message('log','Ajouter un commentaire succès',3000);
			},
			success:function(res){
				_this.removeAttr('disabled');
				_this.parent().find(".ip-content textarea").val('');
				if(res.error){
					errorNot();
				}
			}
		});
	});
	
	/*update Acq*/
	$(".btn-ProposerBlacklist").live('click',function(){
		if($(this).hasClass('show-s')){
			$("#ProposerBlacklistForm").hide();
			$("#proposer_blacklist_field").val(0);
			$(this).removeClass('show-s');
		}else{
			$(this).addClass('show-s');
			$("#ProposerBlacklistForm").show();
			$("html").getNiceScroll().resize();
			$("#proposer_blacklist_field").val(1);
			$("#ProposerBlacklistForm .btn-hide-form").focus();
		}
	});
	$("#ProposerBlacklistForm .btn-hide-form").live('click',function(){
		$(this).parent().parent().hide();
		$("#proposer_blacklist_field").val(0);
		$(".btn-ProposerBlacklist").removeClass('show-s');
	});
	
	$(".btn-return-site").click(function(){
		window.parent.jQuery.fancybox.close();
		return false;
	});
	$(".btn-click-update").live('click',function(){
		$("#proposer_blacklist_field").val(0);
	});
	$(".btn-click-blacklist").live('click',function(){
		$("#proposer_blacklist_field").val(1);
	});
	$(".btn-click-blacklist").live('click',function(){
		update_acquer();
	});
	$(".btn-click-Supprimer").live('click',function(){
		$("#proposer_blacklist_field").val(2);
	});
	$(".btn-click-update").live('click',function(){
		update_acquer();
	});
	$(".btn-click-Supprimer").live('click',function(){
		update_acquer();
	});
	$(".btn-click-Attente").live('click',function(){
		$("#proposer_blacklist_field").val(3);
	});
	$(".btn-click-Attente").live('click',function(){
		update_acquer();
	});
	$(".btn-click-Envoyer").live('click',function(){
		$("#proposer_blacklist_field").val(4);
	});
	
	$(".btn-Blacklister").live('click',function(){
		$("#proposer_blacklist_field").val(1);
	});
	$(".btn-Blacklister").live('click',function(){
		update_acquer();
	});

	$(".btn-click-Envoyer").live('click',function(){
		var _form = $("#update_acquereursForm");
		var _id = _form.attr('ref');
		if(checkError(_form)){
			$.ajax({
				type:'POST',
				url: webroot +'/module/updateAquereurs/id/'+_id,
				data: _form.serialize(),
				success: function(res){
					if($(window.parent.document).find("#acquereursForm").length == 0){
						if(res.property == window.parent.jQuery("#countAllListCustomer").attr('rel')){
							var count = parseInt(window.parent.jQuery("#countAllListCustomer").html());
							window.parent.jQuery("#countAllListCustomer").html(count+1);
						}
					}
					var CountAcqNew = parseInt(window.parent.jQuery(".menuCountAcqNew").text());
					window.parent.jQuery(".menuCountAcqNew").html(CountAcqNew-1);
					window.location.href = webroot+'/module/voirAcq?id=' + res.nextId;
				}
			});
		}
		return false;
	});
	
	$(".btn-Supprimer-Acq").live('click',function(){
		var _this =$(this);
		var id=_this.attr('rel');
		var type = _this.data('type');
		var comment = $(this).parent().find(".ip-content textarea").val();
		var pre = type==2 ? "Suppression Acq: " : "Annulation suppression Acq: ";
		if(comment == ''){
			_this.parent().find(".ip-content textarea").focus();
			error('Merci d\'entrer un commentaire');
			return false;
		}
		showloadPage();
		_this.attr('disabled','disabled');
		$.post(webroot+'/module/ajaxRemoveAcq',{'id':id,'type':type,'comment':pre+comment},function(res){
			window.location.reload();
		});
	});
	
	/*acq add form*/
	var checka = $(".acq-credit-check")[0];
	$(checka).change(function(){
		alertify.set({ labels : { ok: "Fermer"} });
		alertify.alert("Merci de compléter la fiche crédit");
	});
	$(".acquereursForm").submit(function(){
		var _form = $(this);
		$.ajax({
			type:'POST',
			url:_form.attr('action'),
			data:_form.serialize(),
			beforeSend:function(){
				_form.find("input,select").removeClass('error');
				var htmlError = '<b>Veuillez vérifier les champs suivants :</b><br />';
				
				if($("#WpListCustomer_provenance").val()==''){
					_form.find("#WpListCustomer_provenance").addClass('error');
					_form.find("#WpListCustomer_provenance").focus();
					error('Merci de sélectionner la provenance de ce client acquéreur.');
					return false;
				}
				if($("#WpListCustomer_type").val()==''){
					_form.find("#WpListCustomer_type").addClass('error');
					_form.find("#WpListCustomer_type").focus();
					error('Merci de sélectionner un type de client acquéreur.');
					return false;
				}
				if($("#WpListCustomer_customer_last_name").val()==''){
					_form.find("#WpListCustomer_customer_last_name").addClass('error');
					_form.find("#WpListCustomer_customer_last_name").focus();
					error('<b>Nom</b> : veuillez saisir une valeur dans ce champ.');
					return false;
				}
				if($("#WpListCustomer_customer_first_name").val()==''){
					_form.find("#WpListCustomer_customer_first_name").addClass('error');
					_form.find("#WpListCustomer_customer_first_name").focus();
					error('<b>Prénom</b> : veuillez saisir une valeur dans ce champ.');
					return false;
				}
				if($("#WpListCustomer_customer_tel").val()=='' && $("#WpListCustomer_customer_phone").val()=='' && $("#WpListCustomer_customer_email").val()==''){
					_form.find("#WpListCustomer_customer_tel").focus();
					error('Merci de saisir au moins un numéro de téléphone ou un e-mail dans les cadres prévus à cet effet.');
					return false;
				}
				if($("#WpListCustomer_customer_email").val() != ''){
					if(!validateEmail($("#WpListCustomer_customer_email").val())){
						_form.find("#WpListCustomer_customer_email").addClass('error');
						_form.find("#WpListCustomer_customer_email").focus();
						error('<b>Email</b> : veuillez saisir une adresse email correcte.');
						return false;
					}
				}
				if($("#WpListCustomer_customer_gender").val()==''){
					_form.find("#WpListCustomer_customer_gender").addClass('error');
					_form.find("#WpListCustomer_customer_gender").focus();
					error('Merci de sélectionner un type de client acquéreur.');
					return false;
				}
				var check = $(".acq-credit-check")[0];
				if($(check).is(':checked')){
					if ($("#WpListCustomer_NatureProjet").val()=="")
					{
						_form.find("#WpListCustomer_NatureProjet").addClass('error');
						error('Merci de saisir la nature du projet dans le cadre prévu à cet effet.');
						_form.find("#WpListCustomer_NatureProjet").focus();
						return false;
					}
					if (_form.find("#WpListCustomer_cp").val()=="")
					{
						_form.find("#WpListCustomer_cp").addClass('error');
						error('Merci de saisir le code postal du client dans le cadre prévu à cet effet.');
						_form.find("#WpListCustomer_cp").focus();
						return false;
					}
					if (_form.find("#acq_villes").val()=="")
					{
						_form.find("#acq_villes").addClass('error');
						error('Merci de sélectionner la ville du client dans le cadre prévu à cet effet');
						_form.find("#acq_villes").focus();
						return false;
					}
					if (_form.find("#WpListCustomer_credit_some").val()=="")
					{
						_form.find("#WpListCustomer_credit_some").addClass('error');
						error('Merci de saisir la somme dans le cadre prévu à cet effet.');
						_form.find("#WpListCustomer_credit_some").focus();
						return false;
					}
				}
				showloadPage();
				_form.find('button[type="submit"]').attr('disabled',true);
				
			},
			success:function(res){
				hideLoadPage();
				alertify.set({ labels : { ok: "Fermer"} });
				alertify.alert(res.msg,function(e){
					if (e) {
						if($(window.parent.document).find("#acquereursForm").length == 0){
							window.parent.jQuery.fancybox.close();
							if(res.property == window.parent.jQuery("#countAllListCustomer").attr('rel')){
								var count = parseInt(window.parent.jQuery("#countAllListCustomer").html());
								window.parent.jQuery("#countAllListCustomer").html(count+1);
							}
						}else{
							window.location.reload();
						}
					}
				});
				_form.find('button[type="submit"]').removeAttr('disabled');
			}
		});
		return false;
	});
	
	
	$("#btn-return-url-acq").click(function(){
		history.back(1);
		return false;
	});
	
	$("#acquereursForm .acq-credit-check").change(function(){
		if($(this).val() == 1){
			$("#credit_acq").show();
		}else{
			$("#credit_acq").hide();
		}
	});
	$(".vallies_acq").keyup(function(){
		var code = $(this).val();
		$.ajax({
			type:'POST',
			url:webroot+'/common/getVilles',
			data:{'code':code},
			beforeSend:function(){
				$("#loading-villes-acq").show();
			},
			success:function(res){
				$("#loading-villes-acq").hide();
				if(!res.error){
					$("#user_villes .user_villes_value").remove();
					objLength = Object.keys(res.data).length;
					if(objLength == 0){
						$("#acq_villes").attr('disabled',true);
					}else{
						$("#acq_villes").removeAttr('disabled');
						$.each(res.data,function(x,y){
							var insert = $("#acq_villes #acq_villes_title");
							$('<option class="acq_villes_value" value="'+x+'_'+y+'">'+y+' ('+x+')</option>').insertAfter($(insert));
						});
					}
				}else{
					errorNot();
				}
			}
		});
	});
	/* Validate Phone Acq*/
	$(".btn-validate-phone-acq").live('click',function(){
		var _this = $(this);
		var isValidate = _this.attr('rel');
		var phone = _this.attr('phone');
		var varType = _this.attr('valtype');
		$.ajax({
			type:'POST',
			url:webroot+'/common/validatePhone',
			data:{'phone':phone,'isValidate':isValidate,'varType':varType},
			beforeSend:function(){
				if(isValidate == 99){
					_this.parent().find('span.label').html('A VERIFIER');
					_this.parent().find('span.time').remove();
					_this.parent().find('span.label').removeClass('label-success').addClass('label-important');
					var buttonHtml = '<button valtype="'+varType+'" type="button" phone="'+phone+'" rel="1" class="btn btn-small btn-success btn-validate-phone-acq">VALIDE</button>';
						buttonHtml+= '<button valtype="'+varType+'" type="button" phone="'+phone+'" rel="0" class="btn btn-small btn-danger btn-validate-phone-acq">INCORRECTE</button>';
					$(buttonHtml).insertAfter(_this);
					_this.remove();
				}else{
					var label = _this.parent().find('span.label');
					if(isValidate ==1){
						_this.parent().find('span.label').html('OK');
						_this.parent().find('span.label').removeClass('label-important').addClass('label-success');
					}else{
						_this.parent().find('span.label').html('BAD');
						_this.parent().find('span.label').removeClass('label-success').addClass('label-important');
					}
					var buttonHtml = '<button valtype="'+varType+'" type="button" phone="'+phone+'" rel="99" class="btn btn-small btn-danger btn-validate-phone-acq">MODIFIER</button>';
						buttonHtml+= '<span class="time">'+date('m/d/Y H:i:s A')+'</span>';
					_this.parent().find('button').remove();
					$(buttonHtml).insertAfter(label);
				}
			},
			success:function(res){
				if(res.error){
					errorNot();
				}
			}
		});
		return false;
	});
	
	/*When change selected ACQ detect double*/
	$("#btn-Doublon_detecte_acq").click(function(){
		var id = $("#Doublon_detecte_acq").val();
		var url = webroot+'/?property_id='+id;
		window.open(url,'_blank');
	});
	$(".acq-attente-filter").change(function(){
		var id = $(this).val();
		var url = webroot+'module/voirAcq?id='+id+'&attente=1';
		window.location.href = url;
	});
});
function update_acquer(){
	var _form = $("#update_acquereursForm");
	if(checkError(_form)){
		$.ajax({
			type:'POST',
			url:_form.attr('action'),
			data:_form.serialize(),
			success:function(res){
				hideLoadPage();
				if($(window.parent.document).find("#acquereursForm").length == 0){
					if(res.property == window.parent.jQuery("#countAllListCustomer").attr('rel')){
						var count = parseInt(window.parent.jQuery("#countAllListCustomer").html());
						window.parent.jQuery("#countAllListCustomer").html(count+1);
					}
				}
				var CountAcqNew = parseInt(window.parent.jQuery(".menuCountAcqNew").text());
				window.parent.jQuery(".menuCountAcqNew").html(CountAcqNew-1);
				window.location.href = webroot + '/module/voirAcq?id='+ res.nextId;
				_form.find('button[type="submit"]').removeAttr('disabled');
			}
		});
	}
	return false;
}
function checkError(_form){
	var Error = true;
	_form.find("input,select").removeClass('error');
	var htmlError = '<b>Veuillez vérifier les champs suivants :</b><br />';
	
	if($("#WpListCustomer_provenance").val()==''){
		_form.find("#WpListCustomer_provenance").addClass('error');
		_form.find("#WpListCustomer_provenance").focus();
		error('Merci de sélectionner la provenance de ce client acquéreur.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_type").val()==''){
		_form.find("#WpListCustomer_type").addClass('error');
		_form.find("#WpListCustomer_type").focus();
		error('Merci de sélectionner un type de client acquéreur.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_customer_last_name").val().trim()==''){
		_form.find("#WpListCustomer_customer_last_name").addClass('error');
		_form.find("#WpListCustomer_customer_last_name").focus();
		error('<b>Nom</b> : veuillez saisir une valeur dans ce champ.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_customer_first_name").val().trim()==''){
		_form.find("#WpListCustomer_customer_first_name").addClass('error');
		_form.find("#WpListCustomer_customer_first_name").focus();
		error('<b>Prénom</b> : veuillez saisir une valeur dans ce champ.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_customer_tel").val()=='' && $("#WpListCustomer_customer_phone").val()=='' && $("#WpListCustomer_customer_email").val()==''){
		_form.find("#WpListCustomer_customer_tel").focus();
		error('Merci de saisir au moins un numéro de téléphone ou un e-mail dans les cadres prévus à cet effet.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_customer_email").val() != ''){
		if(!validateEmail($("#WpListCustomer_customer_email").val())){
			_form.find("#WpListCustomer_customer_email").addClass('error');
			_form.find("#WpListCustomer_customer_email").focus();
			error('<b>Email</b> : veuillez saisir une adresse email correcte.');
			Error = false;
			return false;
		}
	} else {
		_form.find("#WpListCustomer_customer_email").addClass('error');
		_form.find("#WpListCustomer_customer_email").focus();
		error('<b>Email</b> : veuillez saisir une adresse email correcte.');
		Error = false;
		return false;
	}
	if($("#WpListCustomer_customer_gender").val()==''){
		_form.find("#WpListCustomer_customer_gender").addClass('error');
		_form.find("#WpListCustomer_customer_gender").focus();
		error('Merci de sélectionner un type de client acquéreur.');
		Error = false;
		return false;
	}
	if($("#update_acquereursForm").find("#WpListCustomer_internal_message").val() == ''){
		$("#update_acquereursForm").find("#WpListCustomer_internal_message").focus();
		error("Merci d'entrer un commentaire");
		Error = false;
		return false;
	}
	var check = $(".acq-credit-check")[0];
	if($(check).is(':checked')){
		if ($("#WpListCustomer_NatureProjet").val()=="")
		{
			_form.find("#WpListCustomer_NatureProjet").addClass('error');
			error('Merci de saisir la nature du projet dans le cadre prévu à cet effet.');
			_form.find("#WpListCustomer_NatureProjet").focus();
			Error = false;
			return false;
		}
		if (_form.find("#WpListCustomer_cp").val()=="")
		{
			_form.find("#WpListCustomer_cp").addClass('error');
			error('Merci de saisir le code postal du client dans le cadre prévu à cet effet.');
			_form.find("#WpListCustomer_cp").focus();
			Error = false;
			return false;
		}
		if (_form.find("#acq_villes").val()=="")
		{
			_form.find("#acq_villes").addClass('error');
			error('Merci de sélectionner la ville du client dans le cadre prévu à cet effet');
			_form.find("#acq_villes").focus();
			Error = false;
			return false;
		}
		if (_form.find("#WpListCustomer_credit_some").val()=="")
		{
			_form.find("#WpListCustomer_credit_some").addClass('error');
			error('Merci de saisir la somme dans le cadre prévu à cet effet.');
			_form.find("#WpListCustomer_credit_some").focus();
			Error = false;
			return false;
		}
	}
	return Error;
}