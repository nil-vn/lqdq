// webmail update

$(document).ready(function() {
    $(".fancybox").fancybox({
        fitToView: true,
        width: '1366px',
        height: '768px',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
});

$(document).ready(function() {
    $(".createEmail").fancybox({
        maxWidth: 1067,
        maxHeight: 550,
        fitToView: false,
        width: '300px',
        height: '355px',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            this.href = webroot + "/configCronEmail/create/";
        },
//        afterClose: function() {
//            window.location.reload();
//        },

    });

});

$(document).ready(function() {
    $(".updateEmail").fancybox({
        maxWidth: 1067,
        maxHeight: 550,
        fitToView: false,
        width: '300px',
        height: '355px',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        arrows: false,
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            //this.title = "Message ref "+id;
            this.href = webroot + "/configCronEmail/update/" + id;
        },
        afterClose: function() {
            window.location.reload();
        }


    });

});

$(document).ready(function() {
    $(".deleteEmail").live('click', function() {
        var id = $(this).attr('id');
        var parent = $(this).parent();
        $.ajax({
            type: "POST",
            url: '/back-office/configCronEmail/delete/' + id,
            data: $('#abc').serialize(),
            success: function(data)
            {

                parent.slideUp('slow', function() {
                    $(this).parent().remove();
                });
            }
        });
        return false;
    });
});
/*Delete 1 record in WpErrors table by Ajax*/
$(document).ready(function() {
    $(".deleteError").live('click', function() {
        var id = $(this).attr('id');
        var parent = $(this).parent();
        $.ajax({
            type: "POST",
            url: '/back-office/wpErrors/delete/' + id,
            data: $('#delError').serialize(),
            success: function(data)
            {

                parent.slideUp('slow', function() {
                    $(this).parent().remove();
                });
            }
        });
        return false;
    });
});

/* Consulter l'historique des offres */
$(document).ready(function() {
    $(".consulterhistorique").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '1290',
        height: '550px',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/consulterlHistoriDesOffres/index/" + id;
        },
//        afterClose: function() {
//            window.location.reload();
//        },
    });
});

/* Consulter l'historique des factures */
$(document).ready(function() {
    $(".consulterhistofactures").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '1290',
        height: '550px',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/abonnementPremiumHistoriquePaiement/consulterhistofac/" + id;
        },
    });
});

/* Désactiver à la demande du client */
$(document).ready(function() {
    $(".desactiverdemanduclient").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '730',
        height: '500',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/desactiverDemandeDuClient/desactiverdemanduclient/" + id;
        },
    });
});
/* Détail contrat privilège */
$(document).ready(function() {
    $(".detailcontratprivilege").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '1290',
        height: '550',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/module/detailContratPrivilege?id=" + id;
        },
    });
});
/* Mettre en veille */
$(document).ready(function() {
    $(".mettreenveille").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '730',
        height: '500',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/MettreEnVeille/mettreenveille/" + id;
        },
    });
});
/* Bien Vendu */
$(document).ready(function() {
    $(".bienvendu").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '755',
        height: '550',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/bienVendu/bienvendu/" + id;
        },
    });
});
/* Création contrat privilège & envoi par mail */
$(document).ready(function() {
    $(".Creationcontratprivilegemail").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '1290',
        height: '550',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/creationcontratprivilegemail/creationcprivileevmail/" + id;
        },
    });
});
/* Envoi mail contentieux */
$(document).ready(function() {
    $(".envoimailcontentieux").fancybox({
        maxWidth: 1290,
        maxHeight: 550,
        fitToView: false,
        width: '1290',
        height: '550',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/envoimailcontentieux/envoimail/" +id;
        },
    });
});

/* Premium Resilier Module */
$(document).ready(function() {
    $(".PremiumResilier").fancybox({
        maxWidth: 750,
        maxHeight: 550,
        fitToView: false,
        width: '750',
        height: '550',
        closeClick: false,
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        type: 'ajax',
        beforeLoad: function() {
            var id = $(this.element).attr('id');
            this.href = webroot + "/module/premiumResilier/" + id;
        },
    });
});