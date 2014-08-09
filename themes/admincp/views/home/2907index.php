<ul class="breadcrumb" id="breadcrumb">

    <li><strong>immobilierdev.com </strong> - <span class="badge badge-inverse">BTK<?php echo $model->id; ?></span></li>
    <li><span class="badge badge-success"><strong>Annonce de <?php echo $model->type_property == 1 ? 'vente' : 'location'; ?></strong></span></li>
    <li><span class="badge badge-important"><?php echo $model->getPaymentLabel(); ?> <strong style="color:#ddd"><?php echo $model->getStatus(false); ?></strong></span></li>
</ul>
<div class="row">
    <div class="span12">
        <div class="nonboxy-widget">
            <div class="widget-head">
                <h5>Annonce(s) doublon(s) tel ou mail<?php // echo $model->user->user_email;            ?></h5>
            </div>
            <div id="loadSame" style="width:100%;text-align: center;"><img src="/back-office/themes/admincp/img/spinner-mini.gif"> chargement Annonce(s) doublon(s) tel ou mail <img src="/back-office/themes/admincp/img/spinner-mini.gif"></div>
            <iframe id="iframeSame" style="border:0px #ccc solid;width:100%;height:0;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-collapse: separate;" frameborder="0" src="<?php echo PIUrl::createUrl('/home/getPropertySameUser/', array('user_id' => $model->user->ID, 'property_id' => $model->id)); ?>"></iframe>
        </div>
    </div>
    <script>
        /*Dùng để load các property cùng 1 user*/

        $('#iframeSame').load(function() {
            $("#loadSame").hide();
            $(this).height($(this).contents().height());
            $(this).width($(this).contents().width());
        });

    </script>
    <div class="span4 firstSpan4">
        <div class="nonboxy-widget">
            <div class="widget-content">
                <div class="widget-box">
                    <div class="box-tab">
                        <div class="tabbable">
                            <!-- Only required for left/right tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab"><span class="color-icons email_open_image_co"></span>Contact référence <?php echo $model->user->ID; ?></a></li>
                            </ul>
                            <div class="tab-content" style="overflow:hidden!important;">
                                <?php $userMetas = $model->user->metas; ?>
                                <div class="tab-pane active" id="tab1">
                                    <?php
                                    $this->renderPartial('tab_user_profile', array(
                                        'model' => $model,
                                        'villesUser' => $villesUser,
                                        'validateEmail' => $validateEmail,
                                        'validateFixe' => $validateFixe,
                                        'validatePortable' => $validatePortable,
                                        'userMetas' => $userMetas
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="widget-content tab-content">
                                <div class="widget-box">
                                    <?php $this->renderPartial('box_member_info', array('model' => $model)); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="span4">
        <div class="nonboxy-widget">
            <div class="widget-content">
                <div class="widget-box">
                    <div class="box-tab">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li><a href="#tab2" data-toggle="tab"><span class="color-icons application_detail_co"></span>Détail de l'annonce</a></li>
                            </ul>
                            <div class="tab-content">
                                <?php $userMetas = $model->user->metas; ?>
                                <div class="tab-pane" id="tab2">
                                    <?php
                                    $this->renderPartial('tab_detail_property', array(
                                        'model' => $model,
                                        'qualites' => $qualites,
                                        'arrField' => $arrField,
                                        'arrFieldName' => $arrFieldName,
                                        'categories' => $categories,
                                        'myCategory' => $myCategory,
                                        'subCategories' => $subCategories,
                                        'arrCategory' => $arrCategory,
                                        'arrLesoption' => $arrLesoption,
                                        'userMetas' => $userMetas
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="nonboxy-widget">
            <div class="widget-content">
                <div class="widget-box">
                    <div class="well" id="homeSearchPropertyAndProfile">
                        <form class="" method="GET" action="<?php echo PIUrl::createUrl('/'); ?>">
                            <fieldset>
                                <div class="control-group immobilier-admin-search">
                                    <div class="controls">
                                        <div class="input-append">
                                            <input title="Recherche ref ex:btk192762" name="property_id" value="BTK<?php echo $model->id; ?>" type="text" size="16" id="appendedInputButtons" class="input-xlarge text-tip">
                                            <button type="submit" class="btn margin-fix"><span class="color-icons find_co"></span> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <form class="" method="GET" action="<?php echo PIUrl::createUrl('/'); ?>" target="_blank">
                            <fieldset>
                                <div class="control-group immobilier-admin-search">
                                    <div class="controls">
                                        <div class="input-append">
                                            <input title="Recherche pro" name="pro" type="text" size="16" id="appendedInputButtons" class="input-xlarge text-tip" placeholder="Recherche reference pro">
                                            <button type="submit" class="btn margin-fix"><span class="color-icons find_co"></span> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <form id="searchByProfileFrom" class="" method="GET" action="<?php echo PIUrl::createUrl('/home/search'); ?>" target="_blank">
                            <fieldset>
                                <div class="control-group immobilier-admin-search">
                                    <div class="controls">
                                        <div class="input-prepend input-append">
                                            <input title="Recherche nom, tel, mail (RQ%)" name="profile" type="text" size="16" id="appendedInputButtons" class="input-xlarge text-tip" placeholder="Recherche nom, tel, mail (RQ%)">
                                            <span class="add-on">
                                                <input name="like" title="%RQ%" type="checkbox" value="1" class="text-tip">
                                            </span>
                                            <button type="submit" class="btn margin-fix">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <ul class="tick_icn immobilier-ul" style="margin-top:10px">
                        <li><a class="acquereursForm-modal-decauverte" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/module/decouverteFiche'); ?>">Validation annonce découverte (Pige)</a> </li>
                        <li><a target="_blank" href="<?php echo $this->baseHost . '/property-detail/?action=detail&property_id=' . $model->id; ?>">Voir annonce sur le site</a> </li>
                        <li><a target="_blank" href="<?php echo $this->baseHost . '/i-buy/'; ?>">Creer Alertes SL</a> </li>
                    </ul>
                </div>
            </div>

            <div class="widget-head">
                <h5><span class="color-icons chart_pie_co"></span> Chiffres clés</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <ul class="immobilier-ul" style="margin-top:10px;">
                        <li>Annonce affichée <strong id="sidebarCountSearch">...</strong> fois dans les résultats de recherche</li>
                        <li><strong id="sidebarCountViewDetail">...</strong> affichage du détail annonce</li>
                        <li><strong id="sidebarCountContact">...</strong> affichage page de contact annonceur</li>
                        <li><strong id="sidebarCountEnvoye">...</strong> acquéreur envoyé</li>
                        <li><strong id="sidebarCountAttente">...</strong> acquéreur en attente d'envoi</li>
                        <?php if ($model->type_property == 1 && $model->payment_id == 2): ?><!--type_a = type_property va type_m = payment_id-->
                            <li><strong id="sidebarCountAttente"></strong><a href="<?php echo Yii::app()->createUrl('/courrier?laref=' . $model->id); ?>">Voir Courrier(s)</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="widget-head">
                <h5>
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('/module/listeAnnonces'); ?>" title="Annonces Arlette" target="_blank" style="color:blue; text-decoration:underline">Annonces Arlette</a>&nbsp;&nbsp;&nbsp;
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('/module/listeAnnonces2'); ?>" title="Annonces Juliette" target="_blank" style="color:blue; text-decoration:underline">Annonces Juliette</a>&nbsp;&nbsp;&nbsp;
                    <a target="_blank" href="<?php echo Yii::app()->createUrl('/module/listeAnnonces3'); ?>" title="Annonces Jeje" target="_blank" style="color:blue; text-decoration:underline">Annonces Jeje</a>
                </h5>
            </div>

            <div class="widget-head">
                <h5><span class="color-icons photo_co"></span> Photos - <a target="_blank" href="<?php echo PIUrl::createUrl('/module/setEditPhotos', array('id' => $model->id)); ?>">Ajouter/Modifier les photos</a></h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <div class="row-fluid">
                        <?php if (!empty($model->photos)): ?>
                            <ul class="thumbnails thumbnails-admin">
                                <?php foreach ($model->photos as $photo): ?>
                                    <li class="span3">
                                        <a href="<?php echo $photo->getPhoto(); ?>" class="thumbnail fancybox-img">
                                            <img data-src="holder.js/80x80" alt="260x180" style="width: 260px; height: 180px;" src="<?php echo $photo->getPhoto(100, 100); ?>">
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            Aucune photo enregistrée sur cette annonce
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($model->type_property == 1): ?>
                <div class="widget-head">
                    <h5><span class="color-icons bookmark_folder_co"></span> Gestion des offres promotionnelles</h5>
                </div>
                <div class="widget-content">
                    <div class="widget-box">
                        <ul class="immobilier-ul" style="margin-top:10px;">
                            <?php
                            //Abonnement aux offres bien présent
                            if (DemarchageAnnonce::model()->Ouvrir($model->id) == true):
                                if (DemarchageAnnonce::model()->actiongetValide($model->id) == 0):
                                    ?>
                                    <li><a href="javascript:void(0);" id="Reinscrirelannonceaux" rel="<?php echo $model->id; ?>">
                                            <span class="color-icons arrow_right_co"></span> Réinscrire l'annonce aux offres</a>               
                                    </li>
                                <?php else: ?>
                                    <li><a href="javascript:void(0);" id="Desinscrirelannoncedes" rel="<?php echo $model->id; ?>">
                                            <span class="color-icons arrow_right_co"></span> Désinscrire l'annonce des offres</a>   
                                    </li>
                                <?php endif; ?>

                                <li>
                                    <a  rel="gallery" id="<?php echo $model->id; ?>" class="consulterhistorique" href="javascript:void(0);"  ><span class="color-icons arrow_right_co"></span> Consulter l'historique des offres</a>
                                </li>
                                <li><!--a href="javascript:void(0);" id="Visualiserloffre" rel="<?php //echo $model->id;      ?>">
                                        <span class="color-icons arrow_right_co"></span> Visualiser l'offre promotionnelle en cours de validité</a-->
                                    <a href="<?php echo Yii::app()->request->hostInfo . '/payment/?action=validateOffre&property_id=' . $model->id . '&hash_id=' . sha1($model->user_id) ?>" >
                                        <span class="color-icons arrow_right_co"></span> Visualiser l'offre promotionnelle en cours de validité</a>
                                </li>
                            <?php else: ?>
                                <li><a href="javascript:void(0);" id="Reinscrirelannonceauxs" rel="<?php echo $model->id; ?>">
                                        <span class="color-icons arrow_right_co"></span> Inscrire l'annonce aux offres</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="widget-head">
                <h5><span class="color-icons rosette_co"></span>  Gestion abonnement</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <?php $this->renderPartial('gestion_abonement_menu', compact('model')); ?>
                </div>
            </div>

            <div class="widget-head">
                <h5><span class="color-icons user_business_boss_co"></span> Clients acquéreurs</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <ul class="immobilier-ul" style="margin-top:10px;">
                        <?php if (WpTTelephones::model()->Checklogsms($model->id) == 1): ?>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('module/smsListe'); ?>?id=<?php echo $model->id; ?>" title="Immobilier.fr // Historique SMS" rel="lightbox[external 90% 90%]">
                                <span class="color-icons email_co"></span>  Consulter l'historique SMS client vendeur</a>
                        <?php else: ?>
                            <li> <strong>Auncun SMS envoyé au client vendeur</strong></li>
                        <?php endif; ?>
                        <li><a href="<?php echo PIUrl::createUrl('/module/aquereurs/?id=' . $model->id); ?>"><span class="color-icons arrow_right_co"></span> Consulter les clients acquéreurs <strong style="color:red">(<span id="countAllListCustomer" rel="<?php echo $model->id; ?>">...</span>)</strong></a></li>
                        <li><a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/home/acquereurs/?property_id=' . $model->id); ?>"><span class="color-icons arrow_right_co"></span> Nouveau client acquéreur</a></li>
                    </ul>
                </div>
            </div>
            <div class="widget-head">
                <h5><span class="color-icons email_co"></span> Suivi clientèle</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <ul class="immobilier-ul" style="margin-top:10px;">
                        <li><a href="<?php echo PIUrl::createUrl('suivi_clientele/index', array('id' => $model->id)); ?>" target="_blank"><span class="color-icons arrow_right_co"></span> Répondre par mail</a></li>
                    </ul>
                </div>
            </div>

            <div class="widget-head">
                <h5><span class="color-icons comment_co"></span> Ajouter un commentaire sur l'annonce</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <form method="POST" class="well" id="commentPropertyForm" action="<?php echo PIUrl::createUrl('/common/commentProperty'); ?>">
                        <input type="hidden" name="WpPostPropertyComment[post_property_id]" value="<?php echo $model->id; ?>"/>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label">Votre commentaire (5 caractères minimum) </label>
                                <div class="controls">
                                    <textarea name="WpPostPropertyComment[comment]" id="WpPostPropertyComment_comment" style="width: 100%;" class="input-xlarge" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn" type="submit"><i class="color-icons disk_co"></i>Ajouter le commentaire</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="span12">
        <div class="widget-block">
            <div class="widget-head">
                <h5><span id="countComment"></span> Commentaires</h5>
            </div>
            <div class="widget-content">
                <div class="widget-box">
                    <table class="table table-striped">
                        <tbody id="listCommentPropertys">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        var property_id = "<?php echo $model->id; ?>";
        /* Phương thức dùng để get số lượng các item in slidebar*/
        $.get(webroot + '/common/ajaxCountCHIFFRES/' + property_id, function(res) {
            if (!$.isEmptyObject(res)) {
                $("#sidebarCountSearch").html(res.search);
                $("#sidebarCountViewDetail").html(res.viewDetail);
                $("#sidebarCountContact").html(res.contact);
                $("#sidebarCountEnvoye").html(res.envoye);
                $("#sidebarCountAttente").html(res.attente);
                $("#countAllListCustomer").html(res.countListCustomer);
            }
        });
        /* Phương thức dùng để get all comment of property*/
        $.getJSON(webroot + '/common/getCommentProperty/id/' + property_id, function(res) {
            $("#countComment").html(res.count);
            if (!$.isEmptyObject(res.data)) {
                $.each(res.data, function(x, y) {
                    var cnt = x + 1;
                    var html = "<tr>\<td>" + cnt + "</td>\<td>" + y.created + "</td>\<td " + y.style + ">\<span><strong>" + y.label + "</strong></span>\<p style='white-space: pre-wrap;'>" + y.comment + "</p>\</td>\</tr>";
                    $("#listCommentPropertys").append(html);
                });
            }
        });
    });

    /* Réinscrire l'annonce aux offres */
    $(document).ready(function() {
        $("#Reinscrirelannonceaux").click(function() {
            var id = $(this).attr('rel');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: webroot + '/immoDemarchageAnnonce/reinscrirelannonce/' + id,
                data: {'id_annonce': id},
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.id == 1) {
                        alertify.alert(" L'annonce <strong style='color:blue;'>BTK" + id + "</strong> à été activée avec succès !.");
                    } else {
                        alertify.alert(" <strong style='color:red;'>Erreur lors de la reinscription aux offres (code 1).</strong>");
                    }
                }
            });
            return false;
        });
    });

    /* Inscrire l'annonce aux offres */
    $(document).ready(function() {
        $("#Reinscrirelannonceauxs").click(function() {
            var id = $(this).attr('rel');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: webroot + '/immoDemarchageAnnonce/reinscrirelannonce/' + id,
                data: {'id_annonce': id},
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.id == 1) {
                        alertify.alert(" L'annonce <strong style='color:blue;'>BTK" + id + "</strong> à été activée avec succès !.");
                    } else {
                        alertify.alert(" <strong style='color:red;'>Erreur lors de la reinscription aux offres (code 1).</strong>");
                    }
                }
            });
            return false;
        });
    });

    /* Désinscrire l'annonce des offres */
    $(document).ready(function() {
        $("#Desinscrirelannoncedes").click(function() {
            var id = $(this).attr('rel');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: webroot + '/immoDemarchageAnnonce/desinscrirelannonce/' + id,
                data: {'id_annonce': id},
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.id == 1) {
                        alertify.alert(" L'annonce <strong style='color:blue;'>BTK" + id + "</strong> à été supprimée des offres avec succès !.");
                    } else {
                        alertify.alert(" <strong style='color:red;'>Erreur lors de la suppression des offres (code 1).</strong>");
                    }
                }
            });
            return false;
        });
    });

    /* Visualiser l'offre promotionnelle en cours de validité */
//    $(document).ready(function() {
//        $("#Visualiserloffre").click(function() {
//            var id = $(this).attr('rel');
//            $.ajax({
//                type: 'POST',
//                url: webroot + '/visualiserloffre/index/' + id,
//                data: {'id_annonce': id},
//                success: function(data) {
//                    var obj = $.parseJSON(data);
//                    if (obj.id == 1) {
//                        alertify.alert(obj.idx);
//                    } else {
//                        alertify.alert(" error !. ");
//                    }
//                }
//            });
//            return false;
//        });
//    });
</script>
<?php
if (Yii::app()->user->hasFlash('nouvelleFicheAcquereur'))
{
    echo '<script>$(document).ready(function(){setTimeout(function(){$(".acquereursForm-modal").click()},300)});</script>';
}
?>
