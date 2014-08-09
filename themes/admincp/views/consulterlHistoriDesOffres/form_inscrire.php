<table align="center">
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'form_ss',
    'htmlOptions' => array(
        'onsubmit' => 'return false;',
    ),
        ));
?>
<tr>
    <td class="fondvert" align="center">
        <br>
        <?php //foreach($id_annonce as $com): ?>
        <a href="javascript:void(0);" id="Reinscrirelannonceauxs" rel="<?php echo $id_annonce; ?>">
            <input  name="" type="submit" value="Inscrire/Réinscrire l'annonce en base de démarchage"></a> 
        <?php //endforeach; ?>
    </td>
</tr>
<?php $this->endWidget(); ?>
</table>
<script>
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
</script>