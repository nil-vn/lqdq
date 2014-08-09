<?php if ($model === false): ?>
    <center>
        <strong>
            Désolé mais un problème au niveau de l'annonce à été détécté !<br>
            La référence de l'annonce est : 
            <br>
            <strong>BTK<?php echo Yii::app()->request->getParam('id'); ?></strong>
            <br>
            <br>
            Merci de contacter votre Administrateur.
        </strong>
    </center>
<?php else: ?>

    <div class="">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-admin.gif" />
        <div class="nonboxy-widget">
            <div class="widget-head">
                <h5> <span class="color-icons"></span> PAIEMENT PAR CHEQUE </h5>
            </div>
            <div class="widget-content">
                <div style="text-align:center;">
                    <p><strong>INFORMATIONS NECESSAIRES A LA VALIDATION DE L'ANNONCE <span style="color:red">BTK<?php echo Yii::app()->request->getParam('id'); ?></span></strong></p>
                    <p style="color:red;"><strong>UN BON DE COMMANDE EXISTE DEJA POUR CETTE ANNONCE:</strong></p>
                    <p style="color:red;"><strong>Ce client souhaite publier son annonce pour <?php echo round($model['nb_jours'] / 7.5, 0) ?> semaines (<?php echo round(round($model['nb_jours'] / 7.5, 0) / 4, 1); ?> mois)</strong></p>
                </div>
                <form name="form" class="form-horizontal well" id="AjouterDeBienForm" method="POST">
                    <input name="id_m" type="hidden" value="<?php echo Yii::app()->request->getParam('id'); ?>">
                    <input name="teleop" type="hidden" value="TELEOP">
                    <div class="nonboxy-widget">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="my_postal_code">N° Chèque :</label>
                                <div class="controls">
                                    <input name="numc" value="" type="text" class="input-xlarge" id="numc">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="my_postal_code">Montant du chèque : (Suivant période de publication)</label>
                                <div class="controls">
                                    <select name="montant_periode" id="montant_periode" size="10" style="width:100%; background-color:#FFCC73; font-weight:bold; border-width:1px; border-color:#999999;">
                                        <option value="4680_30" <?php if ($model['nb_jours'] == 30 && $model['montant_ttc'] == 4680) echo 'selected="selected"'; ?>>- Offre 1 mois -- 46,80 &euro;</option>
                                        <option value="8400_90" <?php if ($model['nb_jours'] == 90 && $model['montant_ttc'] == 8400) echo 'selected="selected"'; ?>>- Offre 3 mois -- 84 &euro;</option>
                                        <option value="13440_180" <?php if ($model['nb_jours'] == 180 && $model['montant_ttc'] == 13440) echo 'selected="selected"'; ?>>- Offre 6 mois -- 134,40 &euro;</option>
                                        <option value="">----------------------------</option>
                                        <option value="1400_7" <?php if ($model['nb_jours'] == 7 && $model['montant_ttc'] == 1400) echo 'selected="selected"'; ?>>1 semaine soit 7 jours -- 14 &euro;</option>
                                        <option value="2800_15" <?php if ($model['nb_jours'] == 15 && $model['montant_ttc'] == 2800) echo 'selected="selected"'; ?>>2 semaines soit 15 jours -- 28 &euro;</option>
                                        <option value="4200_22" <?php if ($model['nb_jours'] == 22 && $model['montant_ttc'] == 4200) echo 'selected="selected"'; ?>>3 semaines soit 22 jours -- 42 &euro;</option>
                                        <option value="5600_30" <?php if ($model['nb_jours'] == 30 && $model['montant_ttc'] == 5600) echo 'selected="selected"'; ?>>1 mois soit 30 jours -- 56 &euro;</option>
                                        <option value="7000_37" <?php if ($model['nb_jours'] == 37 && $model['montant_ttc'] == 7000) echo 'selected="selected"'; ?>>5 semaines soit 37 jours -- 70 &euro;</option>
                                        <option value="7900_45" <?php if ($model['nb_jours'] == 45 && $model['montant_ttc'] == 7900) echo 'selected="selected"'; ?>>6 semaines soit 45 jours -- 79 &euro; (gain 5&euro;)</option>
                                        <option value="9900_60" <?php if ($model['nb_jours'] == 60 && $model['montant_ttc'] == 9900) echo 'selected="selected"'; ?>>2 mois soit 60 jours -- 99 &euro; (gain 13&euro;)</option>
                                        <option value="12500_75" <?php if ($model['nb_jours'] == 75 && $model['montant_ttc'] == 12500) echo 'selected="selected"'; ?>>2.5 mois soit 75 jours -- 125 &euro; (gain 15&euro;)</option>
                                        <option value="14900_90" <?php if ($model['nb_jours'] == 90 && $model['montant_ttc'] == 14900) echo 'selected="selected"'; ?>>3 mois soit 90 jours -- 149 &euro; (gain 19&euro;)</option>
                                        <option value="16900_105" <?php if ($model['nb_jours'] == 105 && $model['montant_ttc'] == 16900) echo 'selected="selected"'; ?>>3.5 mois semaines soit 105 jours -- 169 &euro; (gain 27&euro;)</option>
                                        <option value="18500_120" <?php if ($model['nb_jours'] == 120 && $model['montant_ttc'] == 18500) echo 'selected="selected"'; ?>>4 mois soit 120 jours -- 185 &euro; (gain 39&euro;)</option>
                                        <option value="19900_135" <?php if ($model['nb_jours'] == 135 && $model['montant_ttc'] == 19900) echo 'selected="selected"'; ?>>4.5 mois soit 135 jours -- 199 &euro; (gain 53&euro;)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="my_postal_code">Montant en € :</label>
                                <div class="controls">
                                    <input name="montant" id="montant" value="<?php //echo $model['montant_ttc'];  ?>" type="text" class="input-xlarge">
                                    <input name="periode" id="periode" value="14" type="hidden" class="input-xlarge">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-actions">
                                <button type="button" class="btn btn-info submit-valider">VALIDER LE PAIEMENT PAR CHEQUE</button>
                            </div>
                        </fieldset>
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        $("#montant_periode").live('click', function() {
                            var get_option = $("#montant_periode option:selected").val();
                            var arr = get_option.split('_');
                            $("#montant").val(arr[0]);
                            return false;

                        });
                    });
                    $(document).ready(function() {
                        $(".submit-valider").live('click', function() {
                            var _form = $('#AjouterDeBienForm');
                            var data = {
                                'montant': _form.find("#montant").val(),
                                'periode': _form.find("#periode").val(),
                                'numc': _form.find("#numc").val()
                            }
                            if (verif(_form)) {
                                $.ajax({
                                    type: 'POST',
                                    url: '/back-office/gestionAbonnement/validationCheque/id/' + <?php echo Yii::app()->request->getParam('id'); ?>,
                                    data: data,
                                    success: function(res) {
                                        hideLoadPage();
                                        var obj = $.parseJSON(res);
                                        if (res.log.lg == 0) {
                                            html = res.log.logContact;
                                            html += res.log.logAnnonce;
                                            html += res.log.logContact2;
                                            html += res.log.logNotify;
                                            html += $.parseJSON(res.log.logEmail).toString();
                                            //html += "<strong>L'annonce référence BTK"+ res.id +" est en ligne.</strong>";
                                            $(".fancybox-inner").html(html);
                                            $.fancybox.update();
                                        }
                                        else
                                        {
                                            html = res.log.logContact;
                                            html += res.log.logAnnonce;
                                            html += res.log.logContact2;
                                            html += res.log.logNotify;
                                            html += res.log.ouverDe;
                                            html += res.log.logContact;
                                            html += res.log.logAnnonce;
                                            html += res.log.checkDm;
                                            html += res.log.decouv;
                                            html += "<strong>L'annonce référence BTK" + res.id + " est en ligne.</strong>";
                                            //                                                html += $.parseJSON(res.log.logEmail).toString();
                                            //html += "<strong>L'annonce référence BTK"+ res.id +" est en ligne.</strong>";
                                            $(".fancybox-inner").html(html);
                                            $.fancybox.update();
                                        }
                                    }
                                });
                                return false;
                            }
                        });
                    });

                    function verif(form) {
                        var Error = true;
                        form.find("#montant_periode").val(form.find("#montant").val() + '_' + form.find("#periode").val());
                        if (form.find("#numc").val() == "") {
                            error("Merci de saisir un numéro de chèque !");
                            form.find("#numc").focus();
                            Error = false;
                            return false;
                        }

                        if (form.find("#montant_periode").val() == "")
                        {
                            form.find("#montant_periode").addClass('error');
                            error('Merci de selectionner une periode de publication pour votre annonce.');
                            form.find("#montant_periode").focus();
                            Error = false;
                            return false;
                        }
                        if (form.find("#montant").val() == "")
                        {
                            form.find("#montant").addClass('error');
                            error("Merci de saisir un montant dans le champ approprié.");
                            form.find("#montant").focus();
                            Error = false;
                            return false;
                        }
                        if (form.find("#periode").val() == "")
                        {
                            form.find("#periode").addClass('error');
                            error("Merci de selectionner une période de publication.");
                            form.find("#periode").focus();
                            Error = false;
                            return false;
                        }
                        showloadPage();
                        return Error;
                    }
                </script>
            </div>
        </div>
    </div>
<?php endif; ?>