<ul class="immobilier-ul" style="margin-top:10px;">
    <?php if ($model->type_property == 1 && $model->getCoutCommande() > 0): ?>
        <li><a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/gestionAbonnement/validationCheque', array('id' => $model->id)); ?>"><span class="color-icons arrow_right_co"></span> Validation du ch&egrave;que en attente</a></li>
    <?php endif; ?>

    <?php if ($model->type_property == 1 && $model->payment_id == 7): ?>
        <?php if ($model->status != 2): ?>
            <li><a class="supprimerReactive" type="delete" href="javascript:void(0)" title="immobilierdev.com // Supprimer l'annonce"><span class="color-icons arrow_right_co"></span> Supprimer l'annonce</a></li>
        <?php endif; ?>
        <?php if ($model->status != 0): ?>
            <li><a href="javascript:void(0);" id="Reactiverlannonce" rel="<?php echo $model->id; ?>">
                    <span class="color-icons arrow_right_co"></span> Reactiver l'annonce</a>
            </li>
        <?php endif; ?>
    <?php elseif ($model->type_property == 2 && $model->status != 2): ?>
        <li><a class="supprimerReactive" type="delete" href="javascript:void(0)" title="immobilierdev.com // Supprimer l'annonce"><span class="color-icons arrow_right_co"></span> Supprimer l'annonce</a></li>
    <?php endif; ?>

    <?php
    if ($model->type_property == 1 && $model->status == 0 && $model->is_validate == 1):
        $forcageColor = getForcageColor(array('LBC' => 'spir', 'PV' => 'paruvendu', 'SL' => 'seloger'), $model->id);
        ?>
        <li>
            <a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/gestionAbonnement/PropertyForcage', array('id' => $model->id)); ?>">
                <span class="color-icons arrow_right_co">
                </span> Forcage diffusion 
                <strong style="color:<?php echo $forcageColor['LBC']['COLOR'] ?>">LBC</strong>/
                <strong style="color:<?php echo $forcageColor['PV']['COLOR'] ?>">PV</strong>/
                <strong style="color:<?php echo $forcageColor['SL']['COLOR'] ?>">SL</strong>
            </a>
        </li>
    <?php endif; ?>

    <?php if ($model->type_property == 1 && $model->payment_id == 7 && ($model->status == 0 AND $model->is_validate == 1)): ?>
        <li><a href="javascript:void(0);" id="Actualiserlannonce" rel="<?php echo $model->id; ?>">
                <span class="color-icons arrow_right_co"></span> Actualiser l'annonce</a>
        </li>
        <!--li><a href="<?php //echo PIUrl::createUrl('/common/doAction', array('id' => $model->id, 'action' => 'decouverte.supprimer'));                ?>" onclick="return confirm('Souhaitez-vous Désactiver cette annonce ?')">
                <span class="color-icons arrow_right_co"></span> Désactiver l'annonce</a>
        </li-->
        <li><a href="javascript:void(0);" id="Desactiverlannonce" rel="<?php echo $model->id; ?>">
                <span class="color-icons arrow_right_co"></span> Désactiver l'annonce</a>
        </li>
        <li><a href="#"><span class="color-icons arrow_right_co"></span> Création contrat privilège & envoi par mail</a></li>
        <li><a href="#"><span class="color-icons arrow_right_co"></span> Envoi mail information concernant les formules</a></li>
    <?php elseif ($model->type_property == 1 && $model->payment_id == 2): #ANNONCE EN STATU PRIVILEGE?>
        <li>
            <a  rel="gallery" id="<?php echo $model->id; ?>" class="detailcontratprivilege" href="javascript:void(0);"  ><span class="color-icons arrow_right_co"></span> Détail contrat privilège</a>
        </li>
        <li><a href="#"><span class="color-icons arrow_right_co"></span> Envoi mail contentieux</a></li>
        <?php if ($model->status == 0 && $model->is_validate == 1): #EN LIGNE?>
            <?php if (true):#dateDiff() > 1):?>
                <li><a href="javascript:void(0);" id="Actualiserlannoncefiche" rel="<?php echo $model->id; ?>">
                        <span class="color-icons arrow_right_co"></span> Actualiser l'annonce</a>
                </li>
            <?php endif; ?>
            <li>
                <a  rel="gallery" id="<?php echo $model->id; ?>" class="mettreenveille" href="javascript:void(0);"><input type="hidden" id="userid" name="userid" value="sha1(<?php echo $model->user_id ?>)"/><span class="color-icons arrow_right_co"></span><strong>Mettre en veille</strong></a>
            </li>
            <li>
                <a rel="gallery" href="javascript:void(0);" class="desactiverdemanduclient" id="<?php echo $model->id; ?>">
                    <span class="color-icons arrow_right_co"></span><strong>Désactiver à la demande du client</strong></a>
            </li>
            <li>
                <a rel="gallery" href="javascript:void(0);" class="bienvendu" id="<?php echo $model->id; ?>"><input type="hidden" id="uid" name="userid" value="<?php echo sha1($model->user_id); ?>"/>
                    <span class="color-icons arrow_right_co"></span><strong>Bien Vendu</strong></a>
            </li>
        <?php else: #HORS LIGNE?>
            <?php if ($model->status == 14): ?>
                <li>
                    <a href="javascript:void(0);" id="Reactiverlannonceenveille" rel="<?php echo $model->id; ?>">
                        <span class="color-icons arrow_right_co"></span> <strong>Réactiver l'annonce en veille</strong>
                    </a>
                </li>
                <?php
            //else: 
            elseif ($model->status != 83):
                ?>
                <?php
                if ($model->missDpe2($model->id) == 0):
//                    CVarDumper::dump($model->missDpe2($model->id), 10, true);
//                    exit; 
                    ?>
                    <li><a href="javascript:void(0);" id="Reactiverlannonces" rel="<?php echo $model->id; ?>">
                            <span class="color-icons arrow_right_co"></span> Réactiver l'annonce</a>
                    </li>
                <?php endif; ?>
            <?php elseif ($model->status == 83): ?>  
                <li><a href="javascript:void(0);" id="Desactiverclient" rel="<?php //echo $model->id;                ?>">
                        <span class="color-icons arrow_right_co"></span> Désactiver à la demande du client</a>
                </li>
            <?php endif; ?>
            <li><a href="#"><span class="color-icons arrow_right_co"></span> Souscription d'un nouvel abonnement</a></li>
            <li> <a rel="gallery" href="javascript:void(0);" class="Creationcontratprivilegemail" id="<?php echo $model->id; ?>">
                <span class="color-icons arrow_right_co"></span>Création contrat privilège & envoi par mail</a></li>
        <?php endif; ?>
    <?php elseif ($model->type_property == 1 && ($model->payment_id == 3 || $model->payment_id == 4) && ($model->status == 0 AND $model->is_validate == 1 AND $model->status != 83)): #DESACTIVATION ANNONCE DE VENTE PREMIUM ?>
        <?php if ($model->payment_id == 3 && $model->getExistsPaypalProfile() > 0): #VERIF SI ABONNEMENT PAYPAL EN COURS ?>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl();?>?id=<?php echo $model->id;?>"><span class="color-icons arrow_right_co"></span> <strong>R&eacute;silier l'abonnement Premium (Paypal)</strong></a></li>
        <?php elseif ($model->getExistsAbonnementEncoursDemarchage()): #VERIF SI OFFRE PROMO EN COURS ?>
            <li><a href="#"><span class="color-icons arrow_right_co"></span> <strong>R&eacute;silier l'abonnement Premium (offre)</strong></a></li>
        <?php else: ?>
            <li><a href="#"><span class="color-icons arrow_right_co"></span> <strong>R&eacute;silier l'abonnement Premium</strong></a></li>
        <?php endif; ?>
    <?php elseif ($model->type_property == 1 && ($model->status != 0 || $model->is_validate != 1)): #ACTIVATION ANNONCE DE VENTE ?>
        <?php if ($model->status != 2 && ($model->payment_id == 3 || $model->payment_id == 4)): ?>
            <li><a class="supprimerReactive" type="delete" href="javascript:void(0)" title="immobilierdev.com // Supprimer l'annonce"><span class="color-icons arrow_right_co"></span> Supprimer l'annonce</a></li>
        <?php endif; ?>   
        <li><a href="#"><span class="color-icons arrow_right_co"></span> Souscription d'un nouvel abonnement</a></li>
        <li>
            <a rel="gallery" href="javascript:void(0);" class="Creationcontratprivilegemail" id="<?php echo $model->id; ?>">
                <span class="color-icons arrow_right_co"></span>Création contrat privilège & envoi par mail</a>
        </li>

    <?php elseif ($model->type_property == 2): #LOCATION?>
        <?php if ($model->status == 1 || $model->is_validate == 1):
            ?>
            <a href="javascript:void(0);" id="wd-activeProperty1" rel="<?php echo $model->id; ?>"><span class="color-icons arrow_right_co"></span><?php echo $model->is_validate == 0 ? "Désactiver l'annonce" : "Activer l'annonce"; ?></a>
            <input type="hidden" id="active1" name="Active" value="<?php echo $model->is_validate == 0 ? 1 : 0; ?>"/>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($model->getExistPremiumHistory() > 0): ?>  
        <li><a rel="gallery" href="javascript:void(0);" class="consulterhistofactures" id="<?php echo $model->id; ?>">
                <span class="color-icons arrow_right_co"></span>Consulter l'historique des factures (<?php echo $model->getExistPremiumHistory(); ?>)</a>
        </li>
    <?php endif; ?>
</ul>

<script>
    /* Active and Deactive */
    $(document).ready(function() {
        var ida = $("#active1").val();
        //alert(ida);
        $("#wd-activeProperty1").click(function() {
            var id = $(this).attr('rel');
            ida = $("#active1").val();
            showloadPage();
            $.ajax({
                type: 'POST',
                url: webroot + '/home/activeProperty/' + id,
                data: {'id': id, 'ida': ida},
                success: function(data) {
                    if (ida == 0) {
                        $("#active1").val(1);
                        $("#wd-activeProperty1").html("<span class='color-icons arrow_right_co'></span>Désactiver l'annonce</a>");
                        alertify.alert('Activer succès.');
                    } else {
                        $("#active1").val(0);
                        $("#wd-activeProperty1").html("<span class='color-icons arrow_right_co'></span>Activer l'annonce</a>");
                        alertify.alert('Désactiver succès.');
                    }
                    hideLoadPage();
                    //location.reload();
                }
            });
            return false;
        });
    });

    /*Actualiser l'annonce*/
    $(document).ready(function() {
        $("#Actualiserlannonce").click(function() {
            var id = $(this).attr('rel');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: webroot + '/common/doAction1/' + id,
                data: {'id': id},
                success: function(data) {
                    alertify.alert(" Actualiser l'annonce succès.");
                }
            });
            return false;
        });
    });
    /*Actualiserlannoncefiche l'annonce*/
    $(document).ready(function() {
        $("#Actualiserlannoncefiche").click(function() {
            var id = $(this).attr('rel');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: webroot + '/common/doactualiserficheprivilege/' + id,
                data: {'post_property_id': id},
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.id_check == 1) {
                        alertify.alert(" L'annonce <strong style='color:blue;'>BTK" + id + "</strong> à été actualisée avec succès !.");
                    } else {
                        alertify.alert(" <strong style='color:red;'>Erreur lors de l'actualisation (code 1).</strong>");
                    }
                }
            });
            return false;
        });
    });

    /*Désactiver l'annonce*/
    $(document).ready(function() {
        $("#Desactiverlannonce").click(function() {
            var id = $(this).attr('rel');
            $.ajax({
                type: 'POST',
                url: webroot + '/common/doAction/' + id,
                data: {'id': id},
                success: function(data) {
                    alertify.alert(" Désactiver l'annonce succès.");
                }
            });
            return false;
        });
    });

    /* Reactiver l'annonce */
    $(document).ready(function() {
        $("#Reactiverlannonce").click(function() {
            var id = $(this).attr('rel');
            $.ajax({
                type: 'POST',
                url: webroot + '/common/doReactiver/' + id,
                data: {'id': id},
                success: function(data) {
                    alertify.alert(" Reactiver l'annonce succès.");
                }
            });
            return false;
        });
    });

    /* Réactiver l'annonce */
    $(document).ready(function() {
        $("#Reactiverlannonces").click(function() {
            var id = $(this).attr('rel');
            $.ajax({
                type: 'POST',
                url: webroot + '/common/doReactivers/' + id,
                data: {'post_property_id': id},
                success: function(data) {

                    var obj = $.parseJSON(data);
                    if (obj.id == 1)
                    {
                        alertify.alert("L\'annonce BTK" + id + " à été reactivée avec succès !");
                    }
                    if (obj.id == 0)
                    {
                        alertify.alert("Erreur lors de la reactivation(code 1)");
                    }
                    if (obj.id == 2)
                    {
                        alertify.alert("Erreur lors de la reactivation (code 2)");
                    }
                }
            });
            return false;
        });
    });

    /* Réactiver l'annonce en veille */
    $(document).ready(function() {
        $("#Reactiverlannonceenveille").click(function() {
            var id = $(this).attr('rel');
            $.ajax({
                type: 'POST',
                url: webroot + '/common/reactiverlannonceenveille/' + id,
                data: {'post_property_id': id},
                success: function(data) {

                    var obj = $.parseJSON(data);
                    if (obj.id == 1)
                    {
                        alertify.alert("L\'annonce BTK" + id + " à été reactivée avec succès !");
                    }
                    if (obj.id == 0)
                    {
                        alertify.alert("Erreur lors de la reactivation(code 1)");
                    }
                    if (obj.id == 2)
                    {
                        alertify.alert("Erreur lors de la reactivation (code 2)");
                    }
                }
            });
            return false;
        });
    });

    /*Bien Vendu*/
//    $(document).ready(function() {
//        $("#bienvendu").click(function() {
//            var id = $(this).attr('rel');
//            var uid =  $("#uid").val();
//            alert(id);
//            alert(uid);
//            $.ajax({
//                type: 'POST',
//                url: webroot + '/bienVendu/bienvendu/',
//                data: {'id': id,'uid':uid},
//                success: function(data) {
//                    alertify.alert("OK");
//                }
//            });
//            return false;
//        });
//    });
</script>
