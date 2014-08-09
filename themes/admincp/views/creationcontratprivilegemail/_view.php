<style>
    .Style5{font-size:20px; font-weight:bold; color: #FF9900;}
    .Style8{font-size:14px; font-weight:bold; color: #FF6600; font-family: 'Verdana, Arial, Helvetica, sans-serif';}
    .Style12{font-size:14px; font-weight:bold; color: #FF0000; font-family: 'Verdana, Arial, Helvetica, sans-serif';}
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;

    }
</style>
<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo_sonneries.gif" width="391" height="70" border="0" align="absmiddle"><span class="Style4">
</span><br>
<table width="60%"  border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td>	

            <script language="javascript1.4" type="text/javascript">
                $(document).ready(function() {
                    //$('select').append('<option >Veuillez selectionner votre ville</option>');        
                    //var vl = $('#vile').val();
                    $("#cp").keyup(function() {
                        var vile = $("#cp").val();
//                        $("select").text("");

                        $.ajax({
                            type: 'POST',
//                            url: webroot + '/creationcontratprivilegemail/dovillie/',
                            url: '<?php echo Yii::app()->request->baseUrl . "/creationcontratprivilegemail/dovillie/" . $idannone; ?>',
                            data: {'vile': vile},
                            success: function(data) {
                                var obj = $.parseJSON(data);
                                $("#vile .vile_pc").remove();
                                $("#vile").removeAttr('disabled');

                                for (var i = 0; i < obj.msg.length; i++) {

                                    $("#vile").append('<option class="vile_pc" value="' + obj.msg[i].nom + '(' + obj.msg[i].cp + ')">' + obj.msg[i].nom + '(' + obj.msg[i].cp + ')</option>');

                                }

                            }
                        });
                        return false;
                    });
                });
                function isNumber(n) {
                    return !isNaN(parseFloat(n)) && isFinite(n);
                }
                function verif(form) {
                    if ((form.taux.value == "" || form.taux.value == "0") && (form.taux2.value == "" || form.taux2.value == "0"))
                    {
                        alert("Merci de selectionner le pourcentage de frais de diffusion.");
                        form.taux.focus();
                        return false;
                    }
                    if (form.taux.value != "")
                    {
                        form.taux.value = form.taux.value.replace(",", ".").replace("%", "").replace(/^\s+/g, "").replace(/\s+$/g, "");
                        if (form.taux.value.indexOf(".") > 0 && (form.taux.value.length - form.taux.value.indexOf(".") - 1) > 1) {
                            alert("Le pourcentage de frais de diffusion doit comporter un seul chiffre après la virgule.");
                            form.taux.focus();
                            return false;
                        }
                        if (!isNumber(form.taux.value)) {
                            alert("Merci de sélectionner un pourcentage de frais de diffusion valide.");
                            form.taux.focus();
                            return false;
                        }
                    }
                    if (form.taux.value == "" && form.taux2.value != "")
                    {
                        form.taux.value = form.taux2.value
                    }
                    if (form.provenance.value == "")
                    {
                        alert("Merci de choisir une provenance.");
                        form.provenance.focus();
                        return false;
                    }
                    if (form.provenance.value == "of" && form.taux.value >= 2.9)
                    {
                        alert("Pour les offres le taux doit être inférieur au taux de base(2.9).");
                        form.taux.focus();
                        return false;
                    }
                    if (form.email.value == "")
                    {
                        alert("Adresse email obligatoire pour la mise à jour.");
                        form.email.focus();
                        return false;
                    }
                    if (form.portable.value == "")
                    {
                        if (!confirm("Numéro de portable obligatoire pour l'envoie de SMS, souhaitez-vous quand même valider le formulaire ?"))
                            return false;
                    }
                    if (form.adresse.value == "" || form.cp.value == "" || form.ville.value == "")
                    {
                        if (!confirm("l'adresse complète du client est obligatoire, souhaitez-vous quand même valider le formulaire ?")) {
                            form.adresse.focus();
                            return false;
                        }
                    }
                    return true;
                    //alert(form.taux.value); return false;
                }
            </script>	
            <br>
            <span class="Style5">PUBLICATION ANNONCE PRIVILEGE </span>


            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'form_s',
                'htmlOptions' => array(
                    'onsubmit' => 'return verif(document.getElementById("form_s"));',
                ),
            ));
            ?>
            <input name="id_m" id="id_m" type="hidden" value="<?php echo $idannone ?>">
            <input name="teleop" type="hidden" value="<?php echo isset($teleop)?$teleop:''; ?>">
    <center>
        <br>
        <span class="Style8">INFORMATIONS<br>
            <br>
        </span><span class="Style12">Annonce référence BTK <strong><?php echo $idannone; ?></strong></span><span class="Style8"><br>
            <br>
            <div style="border:1px solid black">
                <h4><a href="<?php echo Yii::app()->request->baseUrl . '/creationcontratprivilegemail/viewop/' . $idannone; ?>" target="blank"><i>Voir toute la liste</i></a><br />Historique des contrats envoyés à partir du 22/07/2013</h4>
                <?php
                //20130722 start
                //Dim ret,retStr : ret=f_privilege_contrat_op(ID,retStr) : if( ret>0 ) then response.write retStr
                $str = "";
                $ret = WpPostCategory::model()->f_privilege_contract_op($idannone, $str);
                ?>
                <span style="display: inline-block;width:10px;height:10px;background-color:lightgreen"></span>Activée &nbsp;&nbsp;&nbsp; 
                <span style="display: inline-block;width:10px;height:10px;background-color:lightblue"></span>Réactivée &nbsp;&nbsp;&nbsp; 
                <span style="display: inline-block;width:10px;height:10px;background-color:pink"></span>Désactivée
                <table border="0" style="border: 1px solid black">
                    <tr style="background-color:lightgrey">
                        <td>Id_annonce&nbsp;&nbsp;</td>
                        <td>Conseiller&nbsp;&nbsp;</td>
                        <td>Date envoi&nbsp;&nbsp;</td>
                        <td>Offre&nbsp;&nbsp;</td>
                        <td>Pourcentage&nbsp;&nbsp;</td>
                        <td>Date signature&nbsp;&nbsp;</td>
                        <td>Date désactivation&nbsp;&nbsp;</td>
                    </tr>
                <?php
                    foreach ($infoTLogCreationContratOp as $row) {
                        $of = $row->offre;
                        switch ($row->offre)
                        {
                            case 'of':
                                $of = "Offre Ex Min 1 Acq Attente";
                                break;
                            case 'tel':
                                $of = "Suite entretien téléphonique";
                                break;
                            case 'acqfree':
                                $of = "Last Acq Free";
                                break;
                            default:
                                break;
                        }

                        $myStyle = "";
                        if (!empty($row->fiche->signature_date) && !empty($row->fiche->day_off)){
                            if (strtotime($row->fiche->day_off) < strtotime($row->fiche->signature_date))
                            {
                                $myStyle = "background-color:lightblue";
                            } else
                            {
                                $myStyle = "background-color:pink";
                            }
                        } elseif (!empty($row->fiche->signature_date)){
                            $myStyle = "background-color:lightgreen";
                        }

                        $id = $row->post_property_id;
                        /*if ($row->nb > 1){
                            $id = "<a href=\"?id=" . $id . "\" target=\"blank\" title=\"Plusieurs contrats correspondent &agrave; cette annonce\">" . $id . "</a>";
                        }*/
                        ?>
                        <tr style="<?php echo $myStyle;?>">
                            <td><?php echo $id;?>&nbsp;&nbsp;&nbsp;</td>
                            <td><?php echo $row->op;?>&nbsp;&nbsp;&nbsp;</td>
                            <td><?php echo $row->d;?>&nbsp;&nbsp;&nbsp;</td>
                            <td><?php echo $of;?>&nbsp;&nbsp;&nbsp;</td>
                            <td><?php echo $row->pourcentage;?>%</td>
                            <td><?php echo $row->fiche->signature_date;?></td>
                            <td><?php echo $row->fiche->day_off;?></td>
                        </tr>
                    <?php } ?>
                    </table>
                    <?php
                $POURCENTAGE_PRIVILEGE = 2.9;
                ?>
            </div><br>
        </span>
        <strong>Merci de s&eacute;lectionner le pourcentage de frais de diffusion :</strong><br>
        <span style="display: inline-block; width: 150px; text-align: left">Taux</span>		
        <select name="taux2" id="taux2" style="width:250px">
            <option value="">Selection obligatoire</option>
            <option value="1" <?php If ($POURCENTAGE_PRIVILEGE == 1) : ?>selected <?php endif; ?>>1 %</option>
            <option value="1.3" <?php If ($POURCENTAGE_PRIVILEGE == 1.3) : ?>selected <?php endif; ?>>1.3 %</option>
            <!--<option value="1.25" <% If POURCENTAGE_PRIVILEGE="1.25" Then %>selected<% End If %>>1.25 %</option>-->
            <option value="1.5" <?php If ($POURCENTAGE_PRIVILEGE == 1.5) : ?>selected <?php endif; ?>>1.5 %</option>
            <option value="2" <?php If ($POURCENTAGE_PRIVILEGE == 2) : ?>selected <?php endif; ?>>2 %</option>
            <option value="2.5" <?php If ($POURCENTAGE_PRIVILEGE == 2.5) : ?>selected <?php endif; ?>>2.5 %</option>
            <option value="2.9" <?php If ($POURCENTAGE_PRIVILEGE == 2.9) : ?>selected <?php endif; ?>>2.9 %</option>
            <option value="3" <?php If ($POURCENTAGE_PRIVILEGE == 3) : ?>selected <?php endif; ?>>3 %</option>
            <option value="3.8" <?php If ($POURCENTAGE_PRIVILEGE == 3.8) : ?>selected <?php endif; ?>>3.8 %</option>
            <option value="5" <?php If ($POURCENTAGE_PRIVILEGE == 5) : ?>selected <?php endif; ?>>5 %</option>
        </select>
        <br>
        <div id="divAutreTaux">
            ** Ou autre taux **
            <br>
            <span style="display: inline-block; width: 150px; text-align: left">Valeur en chiffre ex 1.7</span> <input type="text" name="taux" style="width:250px">
        </div>

        <br/>  
        <span style="display: inline-block; width: 150px; text-align: left">Choix du mail</span><select name="provenance" id="provenance" style="width:250px"><option value="">Choisir le Mail</option><option value="tel">Suite entretien t&eacute;l&eacute;phonique</option><option value="of">Offre Ex Min 1 Acq Attente</option><option value="acqfree">Last Acq Free</option></select>
        <br/><br/>


        <fieldset class="scheduler-border">
            <legend class="scheduler-border"><strong>Coordonnées du client : </strong></legend>
            <br>
            <div align="center" class="Style12">Tous les champs sont obligatoires <br>
                <h3>Attention ! En modifiant ces informations vous modifiez les infos du contact de la Ref&nbsp;BTK<?php echo $idannone; ?> , pensez-y avant de cliquer sur le bouton</a>
                    <br>
                    <br>
                    </div>
                    <?php
                    $first_name = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'first_name'));
                    $last_name = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'last_name'));
                    $email = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'email'));
                    $mobile_phone = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'mobile_phone'));
                    $address = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'address'));
                    //$ville = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'mypostville'));
                    //$cp2 = WpUserMeta::model()->findByAttributes(array('user_id' => $iduser, 'meta_key' => 'cp'));

                    $city   = WpUserMeta::model()->getMetaValues($iduser, 'mypostville');
                    //if (!empty($city)) {
                        $split = explode("_", $city);
                        if (count($split) > 1) {
                            $cp     = $split[0];
                            $ville  = $split[1];
                        } else {
                            $cp = "";
                            // Array with only 1 component ~ Old data
                            $ville  = $city; // Is not standard
                            if (empty($ville)) {
                                $ville = WpUserMeta::model()->getMetaValues($iduser, 'villes');
                            }
                            $split_ville = explode("_", $ville);
                            if (count($split_ville) > 1) {
                                $ville  = $split_ville[1];
                                $cp     = $split_ville[0];
                            }

                            if (empty($cp)) {
                                $cp     = WpUserMeta::model()->getMetaValues($iduser, 'mypostcode');
                                if (empty($cp)) {
                                    $cp = WpUserMeta::model()->getMetaValues($iduser, 'postal_code');
                                }
                            }
                        }
                    //}
                    ?>
                    <table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="50%"><div align="right"><strong>Nom : </strong></div></td>
                            <td width="50%" align="left">
                                <input name="nom" id="nom" type="text" style="border-width:1px; border-color:#666666;" value="<?php echo $first_name['meta_value'] ?>" size="50" maxlength="100" >
                            </td>
                        </tr>
                        <tr>
                            <td><div align="right"><strong>Prénom : </strong></div></td>
                            <td align="left">
                                <input name="prenom" id="prenom" type="text" style="border-width:1px; border-color:#666666;" value="<?php echo $last_name['meta_value']; ?>" size="50" maxlength="100" >
                            </td>
                        </tr>
                        <tr>
                            <td><div align="right"><strong>E-mail : </strong></div></td>
                            <td align="left">
                                <input name="email" id="email" type="text" style="border-width:1px; border-color:#666666;" value="<?php echo $info_wp_post_properties->user->user_email; ?>" size="50" maxlength="100" >
                            </td>
                        </tr>
                        <tr>
                            <td><div align="right"><nobr><strong>Téléphone portable ou fixe (Envoie SMS) : </strong></nobr></div></td>
                            <td align="left">
                                <input name="portable" id="portable" type="text" style="border-width:1px; border-color:#666666;" value="<?php echo $mobile_phone['meta_value']; ?>" size="50" maxlength="100" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>

                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>Adresse : </strong></td>
                            <td align="left">
                                <input name="adresse" id="adresse" type="text" style="border-width:1px; border-color:#666666;" value="<?php echo $address['meta_value']; ?>" size="50" maxlength="255" >
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><strong>Cp : </strong></td>
                            <td align="left"><input name="cp"  type="text" id="cp" style="border-width:1px; border-color:#666666;" value="<?php echo $cp; ?>" size="10" maxlength="5"></td>
                        </tr>
                        <tr>
                            <td><div align="right"><strong>Ville : </strong></div></td>
                            <td align="left" id="villes"><span></span>
                                <select id="vile" name="ville" disabled = "disabled">
                                    <!-- <option id="property_villes_title"  value="0">Veuillez sélectionner votre ville</option>  -->
                                    <option id="property_villes_title"  value="0"><?php echo $ville;?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <br><br>
                                <strong>
                                    Cliquez ici pour valider les coordonn&eacute;es et envoyer le contrat à <?php echo $last_name['meta_value'] ?> <?php echo $first_name['meta_value'] ?> :
                                    <br>
                                    <br>
                                </strong>
                                <input type="submit" value="ENVOYER LE CONTRAT"></td></tr>
                    </table>


                    <?php $this->endWidget(); ?>

                    </fieldset>
                    </center>


                    </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                    </tr>
                    </table>
                    <script>
                        $(document).ready(function() {
                            var id = $('#id_m').val();
                            var taux = $('#taux2 option:selected').val();
                            var provenance = $('#provenance option:selected').val();
                            var teleop = $('#teleop').val();
                            var nom = $('#nom').val();
                            var prenom = $('#prenom').val();
                            var adresse = $('#adresse').val();
                            var portable = $('#portable').val();
                            var email = $('#email').val();

                            $.ajax({
                                type: 'POST',
                                url: "<?php echo Yii::app()->request->baseUrl . '/creationcontratprivilegemail/privilegesEtape/'; ?>",
                                data: {'id': id},
                                success: function(data) {

                                }
                            });
                            return false;
                        });
                    </script>