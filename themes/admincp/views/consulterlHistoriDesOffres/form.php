<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table align="center">
    <p  align="center" style="font-size: 20px;">DETAIL DE DEMARCHAGE CONCERNANT L'ANNONCE REFERENCE <?php $mo = DemarchageAnnonce::model()->findByAttributes(array('id_demarche' => $id_demarche)); echo $mo->id_annonce; ?></p>
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
<?php //foreach($id_demarche as $com): ?>
            <input id="id_demarche" type="hidden" value="<?php echo $id_demarche; ?>">
<?php //endforeach; ?>
            <input name="action" type="hidden" value="reactiver">
            <strong>Décaler le démarchage de <input id="nbj" name="nbjours" type="text" value="23" size="5" maxlength="5"> jours</strong>* <br>
            <input id="clickVali" name="" type="submit" value="Valider">
            <br>
            *Calcul&eacute; sur la date actuelle (Valeur n&eacute;gative possible)

            <?php $this->endWidget(); ?>
        </td>
    </tr>
    <tr class="">
        <td width="50%" colspan="" align="center" class="titreorange"><strong>La prochaine offre sera envoyée le <?php $mo = DemarchageAnnonce::model()->findByAttributes(array('id_demarche' => $id_demarche)); echo $mo->prochaine_relance;//echo demarchage.prochaine_relance+1     ?></strong></td>
    </tr>
</table>
<script>
    $(document).ready(function() {

        $("#form_s").submit(function() {

            var nbj = $("#nbj").val();
            var id = $("#id_demarche").val();

            if (nbj != '')
            {
                d = new Date();
                d.setDate(d.getDate() + parseInt(nbj));
                strDay = (d.getDate() < 10 ? "0" : "") + d.getDate();
                month = d.getMonth() + 1;
                strMonth = (month < 10 ? "0" : "") + month;
                strDate = "" + strDay + "/" + strMonth + "/" + d.getFullYear();
                if (confirm('Souhaitez-vous décaler la date de prochain démarchage au ' + strDate + ' ?'))
                    //                       return true;
//                    else
//                        return false;
//                }
//                else
//                    return false;


                    if (id != '') {
                        $.ajax({
                            type: 'POST',
                            url: webroot + '/consulterlHistoriDesOffres/dodesinscrire/',
                            data: {'id_demarche': id, 'nbjs': nbj},
                            success: function(data) {
                                var obj = $.parseJSON(data);
                                if (data) {
                                    $('.deactivatedeca').html("<td>Démarchage décalé de " + obj.decalage + " jours le " + obj.dateaction + "</td>");
                                    alertify.alert(" Le démarchage de l\'annonce BTK"+ obj.idx +" à été décalé de "+ obj.nbjs +" jours avec succès !.");
                                } else {
                                    alertify.alert(" L\'annonce BTK"+ obj.idx +" n\'est plus inscrite en base de démarchage.\Veuillez cliquer sur réinscrire pour réactiver le démarchage.");
                                }
                            }
                        });
                        return false;
                    }
            }

        });

    });
</script>    