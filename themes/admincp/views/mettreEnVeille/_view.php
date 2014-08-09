<!-- CORPS DE LA PAGE -->
<style>
    /*Messages d'info (succes ou erreur)*/

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
                    Vous souhaitez mettre en veille l'annonce Privil&egrave;ge r&eacute;f&eacute;rence BTK<?php echo $idannonce; ?>.</strong>
                <br />
                <br />
                L'annonce sera automatiquement r&eacute;activ&eacute;e apr&egrave;s la période sélectionnée.
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
            <input id="anonnce" name="ID" type="hidden" value="<?php echo $idannonce; ?>" />
            <div id="periode" align="center" style="width:100%; background-color:#F0F0F0; border-top:2px #FFF dotted; color:#333333">
                <br />
                Veuillez s&eacute;lectionner, ci-dessous, la dur&eacute;e pendant laquelle votre annonce restera en veille (hors ligne):
                <br />
                <br />
                <strong>
                    <label>
                        <input type="radio" name="periode" id="periode" value="d,15" />
                        15 jours</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,1" />
                        1 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,2" />
                        2 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,3" />
                        3 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,4" />
                        4 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,5" />
                        5 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,6" />
                        6 mois&nbsp;&nbsp;</label>

                    <label>
                        <input type="radio" name="periode" id="periode" value="m,12" />
                        1 an&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </strong>  
                <br />
                <br />	
            </div>
            <div align="center">
                <br />                
                <input id="clickVali" name="" type="submit" value="Je d&eacute;sactive cette annonce >>">
                <br />
                <br />
            </div>
            <?php $this->endWidget(); ?>
        </td>
    </tr>

</table>
<script>
    $(document).ready(function() {
        $("#form_s").submit(function() {
            var g_post = $("#gpost").val();
            var idann = $("#anonnce").val();
            var pre = $("input[type='radio'][name='periode']:checked").val();
            var p = false;
            if ($("input[type='radio'][name='periode']:checked").is(":checked")) {
                p = true;
            }
            if (p === false)
                alert("Veuillez sélectionner un délai de réactivation automatique.");


            //return p;

            $.ajax({
                type: 'POST',
                url: webroot + '/mettreEnVeille/meteveis/',
                data: {'getpost': g_post, 'anon': idann, 'p': pre, },
                success: function(data) {
                    var obj = $.parseJSON(data);
                    if (obj.check == 1)
                        alertify.alert('Contrat privilège non valide');
                    if (obj.check == 2)
                        alertify.alert('Aucun abonnement Privilège en cours');
                    if (obj.msg == 1)
                        alertify.alert('Annonce mise en veille avec succès.');
                    if (obj.msg == 2)
                        alertify.alert('Une erreur est survenue pendant la mise en veille de votre annonce.<br /><br />Veuillez nous contacter si le probl&egrave;me persiste.');
                    if (obj.msg == 3)
                        alertify.alert('Une erreur est survenue pendant la mise en veille de votre annonce.<br /><br />Veuillez nous contacter si le probl&egrave;me persiste.');
                    if (obj.msg == 4)
                        alertify.alert('Une erreur est survenue pendant la mise en veille de votre annonce.<br /><br />Veuillez nous contacter si le probl&egrave;me persiste.');                   
                }
            });
            return false;

        });

    });
</script>    
