<html>
    <head>
        <LINK href="../../style/bo.css" type="text/css" rel="stylesheet">
        <title>Immobilier.fr - Gestion clientèle</title>
        <style type="text/css">
            <!--
            .Style1 {
                color: #FF6600;
                font-weight: bold;
            }
            -->
        </style>
    </head>
    <body>
        <table align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <div style=" text-align: center;" id="info_mss"></div>
                    <div style=" text-align: center;" id="info_mss1"></div>
                    <div style=" text-align: center;" id="info_mss2"></div>
                    <div style=" text-align: center;" id="info_mss3"></div>
                    <div style=" text-align: center;" id="info_mss4"></div>
                    <div style=" text-align: center;" id="info_mss5"></div>
                </td>
            </tr>
            <tr>     
                <td>	

                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-admin.gif" width="468" height="60">
                    <br>
                    <br>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'form_s',
                        'htmlOptions' => array(
                            'onsubmit' => 'return false;',
                        ),
                    ));
                    ?>
                    <input name="action" id="post" type="hidden" value="envoyer">
                    <input name="id" type="hidden" id="idannonce" value="<?php echo $idannone; ?>">
                    <input name="id" type="hidden" id="us" value="<?php echo $us; ?>">
                    <table width="800" class="tdgris">
                        <tr>
                            <td colspan="2">
                                <span class="Style1"><u>Détail du message sélectionné  :</u></span>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Expéditeur
                            </td>
                            <td>
                                <input style="width:400px;" name="adresse" id="mailex" type="text" value="contentieux@immobilier.fr " size="50">
                            </td>
                        </tr>
                        <tr>
                            <td>Destinataire
                            </td>
                            <td>
                                <input style="width:400px;" name="destinataire" id="userem" type="text" value="<?php echo $um; ?>" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Objet:
                            </td>
                            <td>
                                <input style="width:600px;" name="Objet" id="objet" size="90" type="text" value="ANNONCE REF. BTK<?php echo $idannone; ?> // VOTRE DOSSIER VA ETRE TRANSMIS AU CONTENTIEUX">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Message:
                            </td>
                            <td>
                                <textarea name="message" cols="70" rows="20" id="comment" style="width:600px;">Bonjour,

Ma collègue du service Privilège me transmets ce jour votre dossier Privilège sur lequel elle n'enregistre aucune réponse de votre part depuis plusieurs semaines.

De ce fait je suis dans l'obligation de mettre votre dossier en contentieux et de diligenter toutes les procédures nécessaires à la clarification de la situation de cette vente.

Vous disposez encore de 48 heures pour me donner les élements ci-dessous, en suite de quoi votre dossier sera entre les mains de nos conseils.

Si vous souhaitez classer ce dossier, merci de compléter sous 48 heures le formulaire "coordonnées acquéreurs " et de nous l'adresser par retour de mail :

NOM ET PRENOM DE MONSIEUR :

NOM ET PRENOM DE MADAME :

TELEPHONE DE MONSIEUR :

TELEPHONE DE MADAME :

ADRESSE E-MAIL :

NOTAIRE EN CHARGE DE LA VENTE :

Dans l'attente de vous lire sur le sujet, je vous transmets mes sincères salutations.
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                SMS:
                            </td>
                            <td>
                                <textarea style="width:600px;" name="sms" id="sms" cols="70" rows="5">immobilier.fr transmets votre dossier au contentieux, nous contacter à l'adresse: contentieux@immobilier.fr</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="Envoyer">
                            </td>
                        </tr>
                    </table>
                    <?php $this->endWidget(); ?>

                </td>
            </tr>
        </table>
    </body>
</html>
<script>
    $(document).ready(function() {
        $("#form_s").submit(function() {
            var p = $("#post").val();
            var idannonce = $("#idannonce").val();
            var userem = $("#userem").val();
            var us = $("#us").val();
            var comment = $("#comment").val();
            var objet = $("#objet").val();
            var mailex = $("#mailex").val();
            var sms = $("#sms").val();
//            var datecompromis = $("#datecompromis").val();


            if (p == 'envoyer')
            {
                $.ajax({
                    type: 'POST',
                    url: webroot + '/envoimailcontentieux/Excuenvoimail/',
                    data: {'idannonce': idannonce, 'userem': userem, 'us': us, 'comment': comment, 'objet': objet, 'mailex': mailex, 'sms': sms},
                    success: function(data) {
                        var obj = $.parseJSON(data);

                        if (obj.msg == 0) {
                            $("#info_mss").html("[ SMSBOX :: <span style='color:green;'>Info</span> ] Hors tranche horaire, le message será reporté (code " + obj.code + ")");
                            $("#info_mss1").html("[ SMSBOX :: <span style='color:green;'>Info</span> ] Code retour: (code " + obj.code + ")");
                            $("#info_mss2").html("Message retour: " + obj.status);
                            $("#info_mss3").html("[ SMSBOX :: <span style='color:green;'>Info</span> ] log_retour start");
                            $("#info_mss4").html("[ SMSBOX :: <span style='color:green;'>Info</span> ] log_retour end ret=1");
                            $("#info_mss5").html("<strong>Envoie du SMS au client venduer sur tel 1: " + obj.sdt + " </strong>");
                            alertify.alert("Message envoyé avec succès");
                        }
                        else if (obj.msg == 1) {
                            alertify.alert("Message envoyé avec succès");    
                        }
                        else if (obj.msg == 2) {
                            alertify.alert("Erreur lors de l\'envoi du message");
                            $("#info_mss").html("");
                            $("#info_mss1").html("");
                            $("#info_mss2").html("");
                            $("#info_mss3").html("");
                            $("#info_mss4").html("");
                            $("#info_mss5").html("");
                        }
                    }
                });
                return false;
            }

        });
    });
</script>   
