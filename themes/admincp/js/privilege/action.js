/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
// privilege mandats

// premium

// privilege
$(function() {
    $(".privilege_annuler").click(function() {
        var id = $(this).attr('value');
        var html = '<h3>Souhaitez-vous annuler la facture Privilège référence ' + id + ' ?</h3>';
        alertify.set({labels: {
                cancel: "Fermer",
                ok: "Annuler la facture"},
            buttonFocus: "cancel"
        });
        alertify.prompt(html, function(e, str) {
            if (e) {
                $.ajax({
                    type: "POST",
                    url: webroot + '/privileges/privilege_annuler',
                    data: {'id': id, 'info': str},
                    beforeSend: function() {
                    },
                    success: function(data) {
                        //message('success','Success',1000);
                        ajaxUpdate();
                    },
                    error: function() {
                        //message('error','Failed',1000);
                    }
                });
            } else {
                return false;
            }
        });
    });
});

$(function() {
    $(".privilege_create_avoir").click(function() {
        var id = $(this).attr('value');
        var html = '<h3>Veuillez indiquer, ci-dessous, le montant de l\'avoir sur facture n°' + id + '.</h3><br/>';
        html = html + 'Montant de l\'Avoir (Ex: 154,25)';
        alertify.set({labels: {
                cancel: "Cancel",
                ok: "OK"},
            buttonFocus: "ok"
        });
        alertify.prompt(html, function(e, str) {
            if (e) {
                $.ajax({
                    type: "POST",
                    url: webroot + '/privileges/privilege_create_avoir',
                    data: {'id': id, 'amount': str},
                    beforeSend: function() {
                    },
                    success: function(data) {
                        if (data !== "") {
                            message('error', 'Attention, le montant de l\'avoir ne peut pas ĂŞtre supĂŠrieur Ă  <font color="green">' + data + '</font> âŹ', 5000);
                        } else {
                            //message('success','Success',1000);
                        }
                        ajaxUpdate();
                    },
                    error: function() {
                        //message('error','Failed',1000);
                    }
                });
            } else {
                return false;
            }
        });
    });
});
function avoir($msg, id) {
    alertify.set({labels: {
            cancel: "Cancel",
            ok: "OK"},
        buttonFocus: "ok"
    });
    alertify.prompt(html, function(e, str) {
        if (e) {
            $.ajax({
                type: "POST",
                url: webroot + '/privileges/privilege_create_avoir',
                data: {'id': id, 'amount': str},
                beforeSend: function() {
                },
                success: function(data) {
                    //message('success','Success',1000);
                    ajaxUpdate();
                },
                error: function() {
                    //message('error','Failed',1000);
                }
            });
        } else {
            return false;
        }
    });
}
// privilege avoir

// annonce controle
$(function() {
	$(".annonce_controle_delete").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du traitement ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('annonce_controle_delete', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// annonce controle horsligne
$(function() {
	$(".annonce_controle_horsligne_active").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous activer l\'annonce BTK' + id + ' en découverte ?</h3><br/>';
		var btnOK = 'Activer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('annonce_controle_horsligne_active', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".annonce_controle_horsligne_delete").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('annonce_controle_horsligne_delete', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// acquereur blacklist
$(function() {
	$(".acquereurs_blacklist_blacklist").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = 'Voulez-vous blacklister définitivement ce client ?';
		var btnOK = 'OK';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('acquereurs_blacklist_blacklist', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".acquereurs_blacklist_whitelist").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = 'Voulez-vous whitelister (autoriser) ce client ?';
		var btnOK = 'OK';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('acquereurs_blacklist_whitelist', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// annonce blacklist
$(function() {
	$(".annonces_blacklist_blacklist").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = 'Voulez-vous blacklister définitivement ce client ?';
		var btnOK = 'OK';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('annonces_blacklist_blacklist', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".annonces_blacklist_whitelist").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = 'Voulez-vous whitelister (autoriser) ce client ?';
		var btnOK = 'OK';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('annonces_blacklist_whitelist', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// decouverte controle
$(function() {
	$(".decouvertes_controle_marquer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous marquer l\'annonce BTK' + id + ' comme injoignable ?</h3><br/>';
		var btnOK = 'Marquer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('decouvertes_controle_marquer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".decouvertes_controle_actualiser").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous actualiser et supprimer l\'annonce BTK' + id + ' ?</h3><br/>';
		var btnOK = 'Actualiser';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('decouvertes_controle_actualiser', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".decouvertes_controle_supprime").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('decouvertes_controle_supprime', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// decouverte sans acquereur
$(function() {
	$(".decouvertes_sansacquereur_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('decouvertes_sansacquereur_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// decouverte liste

// premium controle
$(function() {
	$(".premium_controle_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('premium_controle_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".premium_controle_rappel").click(function() {
		var id = $(this).attr('value');
		var period = $("#fr"+id+" .period").attr('value');
		var delay = $("#fr"+id+" .delay").attr('value');
		var params = {'id': id,'period':period,'delay':delay};
		var msg = '<h3>Voulez-vous rappel l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Rappel';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('premium_controle_rappel', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// premium 6 mois 
$(function() {
	$(".premium_6mois_marquer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous marquer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Marquer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('premium_6mois_marquer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".premium_6mois_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('premium_6mois_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// privilege priseenmain verifier 
$(function() {
	$(".privilege_priseenmain_verifier_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_priseenmain_verifier_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// privilege controle
$(function() {
    $("#etape").change(function() {
        var etape = $(this).attr("value");
        var id = $(this).attr("postPropertyId");
		var params = {'id': id, 'etape': etape};
        var msg = '<h3>Veuillez confirmer votre action.</h3><br/>';
		var btnOK = 'Confirmer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_etape', msg, btnCancel, btnOK, btnFocus, params);
    });
});
$(function() {
	$(".privilege_controle_basculer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous basculer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Basculer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_basculer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_controle_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_controle_rappel").click(function() {
		var id = $(this).attr('value');
		var period = $("#fr" + id + " .period").attr('value');
		var delay = $("#fr" + id + " .delay").attr('value');
		var params = {'id': id, 'delay': delay, 'period': period};
		var msg = '<h3>Voulez-vous rappel l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Rappel';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_rappel', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// controle descriptif
$(function() {
	$(".controle_descriptif_actualiser").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous actualiser l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('controle_descriptif_actualiser', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// privilege desactiver

$(function() {
	$(".privilege_desactiver_rappel").click(function() {
		var id = $(this).attr('value');
		var period = $("#fr" + id + " .period").attr('value');
		var delay = $("#fr" + id + " .delay").attr('value');
		var params = {'id': id, 'delay': delay, 'period': period};
		var msg = '<h3>Voulez-vous rappel l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Rappel';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_desactiver_rappel', msg, btnCancel, btnOK, btnFocus, params);
	});
});

$(function() {
	$(".privilege_desactiver_vendu").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous Basculer en vendu l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Basculer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_desactiver_vendu', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_desactiver_venduimmo").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous Basculer en vendu par immo l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Basculer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_desactiver_venduimmo', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_desactiver_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_desactiver_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// privilege vendu
// privilege vendu immo
// privilege maj
$(function() {
	$(".privilege_maj_marquer_injoignable").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous marquer l\'annonce BTK' + id + ' comme injoignable ?</h3><br/>';
		var btnOK = 'Marquer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_maj_marquer_injoignable', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_maj_supprime").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_maj_supprime', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// privilege priseenmain
$(function() {
	$(".privilege_priseenmain_marquer_injoignable").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous marquer l\'annonce BTK' + id + ' comme injoignable ?</h3><br/>';
		var btnOK = 'Marquer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_priseenmain_marquer_injoignable', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_priseenmain_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous actualiser et supprimer l\'annonce BTK' + id + ' ?</h3><br/>';
		var btnOK = 'Actualiser';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_priseenmain_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});

// privilege reveil
$(function() {
	$(".privilege_reveil_mark_injoignable").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous marquer l\'annonce BTK' + id + ' comme injoignable ?</h3><br/>';
		var btnOK = 'Marquer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_reveil_mark_injoignable', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".privilege_reveil_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous actualiser et supprimer l\'annonce BTK' + id + ' ?</h3><br/>';
		var btnOK = 'Actualiser';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_reveil_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
// privilege contrat op
// location attente
$(function() {
	$(".location_attente_activer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Activer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('location_attente_activer', msg, btnCancel, btnOK, btnFocus, params);
	});
});
$(function() {
	$(".location_attente_supprimer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous supprimer l\'annonce BTK' + id + ' du tableau ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('location_attente_supprimer', msg, btnCancel, btnOK, btnFocus, params);
	});
});

$(function() {
	$(".privilege_controle_creer").click(function() {
		var id = $(this).attr('value');
		var params = {'id': id};
		var msg = '<h3>Voulez-vous basculer l\'annonce BTK' + id + ' en vendu par immobilier.fr ?</h3><br/>';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_creer', msg, btnCancel, btnOK, btnFocus, params);
	});
});

$(function() {
	$(".submit_vendu").click(function() {
		var id = $(this).attr('ref');
		var action = $(".action_vendu_" + id + ' option:selected').val();
		var delai = $('#delai').val();
		var periode = $('#periode').val();
		var params = {'id': id, 'action': action, 'delai': delai, 'periode': periode};
		var msg = '';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_action', msg, btnCancel, btnOK, btnFocus, params);
	});
});

$(function() {
	$(".privilege_controle_rappeler").click(function() {
		var id = $(this).attr('ref');
		var num_vendu = $(".num_vendu_" + id + ' option:selected').val();
		var day_vendu = $(".day_vendu_" + id + ' option:selected').val();
		var params = {'id': id, 'num_vendu': num_vendu,'day_vendu' : day_vendu};
		var msg = '';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		actionConfirm('privilege_controle_rappeler', msg, btnCancel, btnOK, btnFocus, params);
	});
});

$(function() {
	$(".acquereurs_rappel_rappeler").click(function() {
		var id = $(this).attr('value');
		var time = $("#delai").val();
		var msg = 'Souhaitez vous rappeler ce client dans '+ $("#delai").val() + ' jours?';
		var btnOK = 'Supprimer';
		var btnCancel = 'Fermer';
		var btnFocus = 'cancel';
		alertify.set({labels: {
                cancel: btnCancel,
                ok: btnOK},
            buttonFocus: btnFocus
        });
        alertify.confirm(msg, function(e) {	
            if (e) {
				var comm = prompt('Merci de saisir votre commentaire pour indiquer ce client comme rappeler ?');
				if(comm  != null){
					var params = {'id': id,'time':time,'comm':comm};
					$.ajax({
						type: 'POST',
						url: webroot + '/privileges/acquereurs_rappel_rappeler',
						data: params,
						beforeSend: function() {
						},
						success: function(data) {
							ajaxUpdate();
							message('success','Success',1000);
						},
						error: function() {
							message('error','Error',1000);
						}
					});
				}
			} else {
                return false;
            }
		});
	});
});

$(function() {
	$(".acquereurs_rappel_supprimer").click(function() {
		var comm = prompt('Merci de saisir votre commentaire pour indiquer ce client comme vérifié ?');
		if(comm  != null){
			var id = $(this).attr('value');
			var period = $("#fr" + id + " .period").attr('value');
			var delay = $("#fr" + id + " .delay").attr('value');
			var params = {'id': id, 'delay': delay, 'period': period,'comm':comm};
			var msg = '';
			var btnOK = 'Rappel';
			var btnCancel = 'Fermer';
			var btnFocus = 'cancel';
			$.ajax({
				type: 'POST',
				url: webroot + '/privileges/acquereurs_rappel_supprimer',
				data: params,
				beforeSend: function() {
				},
				success: function(data) {
					ajaxUpdate();
					message('success','Success',1000);
				},
				error: function() {
					message('error','Error',1000);
				}
			});
		}
		
	});
});
// action
function actionConfirm(action, msg, btnCancel, btnOK, btnFocus, params) {
		if(msg == ''){
			$.ajax({
				type: 'POST',
				url: webroot + '/privileges/' + action,
				data: params,
				beforeSend: function() {
				},
				success: function(data) {
					//message('success','Success',1000);
					ajaxUpdate();
					message('success','Success',1000);
				},
				error: function() {
					//message('error','Failed',1000);
					message('error','Error',1000);
				}
			});
			return false;
		} 
		alertify.set({labels: {
                cancel: btnCancel,
                ok: btnOK},
            buttonFocus: btnFocus
        });
        alertify.confirm(msg, function(e) {
            if (e) {
                $.ajax({
                    type: 'POST',
                    url: webroot + '/privileges/' + action,
                    data: params,
                    beforeSend: function() {
                    },
                    success: function(data) {
                        //message('success','Success',1000);
                        ajaxUpdate();
						message('success','Success',1000);
                    },
                    error: function() {
                        //message('error','Failed',1000);
						message('error','Error',1000);
                    }
                });
            } else {
                return false;
            }
        });

}
// update
function ajaxUpdate() {
    var ajaxLoad = '<div style="width:100%;text-align:center"><img src="/back-office/themes/admincp/img/webmail/ajaxload.gif" /></div>';
    $.ajax({
        type: 'POST',
        url: window.location.pathname + window.location.search,
        data: {'isAjaxUpdate': true},
        beforeSend: function() {
            $("#table_content").css("opacity", "0.5");
            $("#table_content").css("-moz-transition", "all 0.2s ease-out");
            $("#table_content").css("-webkit-transition", "all 0.2s ease-out");
            $("#table_content").css("-o-transition", "all 0.2s ease-out");
            $("#table_content").css("-ms-transition", "all 0.2s ease-out");
            $("#table_content").css("transition", "all 0.2s ease-out");
            //$("#table_content").html(ajaxLoad);
        },
        success: function(data) {
            $("#table_content").css("opacity", "1");
            $("#table_content").css("-moz-transition", "all 0.2s ease-out");
            $("#table_content").css("-webkit-transition", "all 0.2s ease-out");
            $("#table_content").css("-o-transition", "all 0.2s ease-out");
            $("#table_content").css("-ms-transition", "all 0.2s ease-out");
            $("#table_content").css("transition", "all 0.2s ease-out");
            $('#table_content').html(data);
        },
        error: function() {
            $("#table_content").css("opacity", "1");
            $("#table_content").css("-moz-transition", "all 0.2s ease-out");
            $("#table_content").css("-webkit-transition", "all 0.2s ease-out");
            $("#table_content").css("-o-transition", "all 0.2s ease-out");
            $("#table_content").css("-ms-transition", "all 0.2s ease-out");
            $("#table_content").css("transition", "all 0.2s ease-out");
            //$("#table_content").html("<center><h3>There is no data response. Please try again!!!</h3></center>");
        }
    });
}