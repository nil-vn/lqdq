<!-- CORPS DE LA PAGE -->
<style>
    /*Messages d'info (succes ou erreur)*/
    p.alert { background:url(/themes/admincp/img/163/info.png) no-repeat; }
    p.alert a{ color:#CC0000; text-decoration:none }
    p.alert a:hover{ color:#990000; text-decoration:none }
    p.info { background: #f8fafc; text-align: left; padding: 5px 1px 5px 10px;	border-top: 2px solid #b5d4fe;	color:#666666;	border-bottom: 2px solid #b5d4fe; }
    p.info a{ color:#006699; text-decoration:none }
    p.info a:hover{ color:#0066FF; text-decoration:none }

</style>
<table width="730" align="center">
    <tr>
        <td>
<!--            <% If msg<>"" Then %>-->
            <br />
<!--            <p style="color:red"><%= msg %></p>-->
<!--            <% End If %>-->
        </td>
    </tr>
    <tr>
        <td>
            <p class="info">
                <strong>
                    Vous souhaitez retirer l'annonce Privil&egrave;ge r&eacute;f&eacute;rence BTK<?php echo $idannone; ?> de la vente.</strong>
                <br />
                <br />
                Cette annonce sera donc désactivée après validation du formulaire ci-dessous.
                <br />

            </p>
        </td>
    </tr>
    <tr>
        <td class="fondvert" align="center">
            <br>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'form_s',
                'htmlOptions' => array(
                    'onsubmit' => 'return false;',
                ),
            ));
            ?>
            <input id="gpost" name="getpost" type="hidden" value="1" />
            <input id="anonnce" name="ID" type="hidden" value="<?php echo $idannone; ?>" />

            <input name="HASH" type="hidden" value="<?php //echo HASH                ?>" />	

            <div id="commentaire" align="center" style="width:100%; border-top:2px #FFF dotted; color:#333333">

                <select name="raison" id="raison" style="width:290px;">
                    <option value="" selected="selected">Veuillez sélectionner la raison de la d&eacute;sactivation</option>
                    <option value="Bien mis en location">Bien mis en location</option>
                    <option value="Travaux sur le bien">Travaux sur le bien</option>
                    <option value="Raison personnelle ou familiale">Raison personnelle ou familiale</option>
                    <option value="Destruction du bien">Destruction du bien</option>
                    <option value="Autre">Autre</option>
                </select>
                <br />
                <textarea  name="comm" id="comm" cols="80" rows="10" style="border:2px #CCC dotted; width:650px;"></textarea>
                <br />
                <br />

            </div>
            <div align="center">
                <br />                
                <input id="clickVali" name="" type="submit" value="Je d&eacute;sactive cette annonce >>">
                <br />
                <br />
            </div>


        </td>
    </tr>   

    <?php $this->endWidget(); ?>
</td>
</tr>

</table>
<script>
    $(document).ready(function() {
        $("#form_s").submit(function() {
            var g_post = $("#gpost").val();
            var idann = $("#anonnce").val();
            var idrai = $("#raison").val();
            var com = $("#comm").val();

            if ($("#raison").val() == "") {
                alert("Veuillez séléctionner la raison de la désactivation.");
                $("#raison").focus();
                return false;
            }
            if ($("#comm").val().length < 5) {
                alert("Veuillez saisir un minimum de 5 caractères dans le champ commentaire.");
                $("#comm").focus();
                return false;
            }

            $.ajax({
                type: 'POST',
                url: webroot + '/desactiverDemandeDuClient/duclient/',
                data: {'getpost': g_post, 'annonce': idann, 'com': com, 'idrai': idrai},
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (data)
                    {
                        alertify.alert('Annonce désactivée');
                    } else
                    {
                        alertify.alert('Une erreur est survenue pendant la d&eacute;sactivation de votre annonce (raison: ' + obj.erreur + ').<br /><br />Veuillez nous contacter si le probl&egrave;me persiste');
                    }
                }
            });
            return false;

        });

    });
</script>    