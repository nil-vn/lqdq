<table align="center">
    <tr> 
        <td colspan="2" align="center">
            <br>IMPRIMER LES FACTURES DE CE CLIENT
            <br>
            <br>
            <?php
            foreach ($model as $value)
            {
                if ($value['check'] == 1)
                    $modep = "chèque";
                else
                    $modep = "CB";
                if (strtolower($value['result']) == 'success')
                {
                    ?>
                    <table>
                        <tr id="abcde"><td>
                                <br>
                                <a href="<?php echo Yii::app()->createUrl('/compta/premium_facture_pdf', array('f'=>$value['id'])); ?>" target="_blank">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/pdf1.png" border="0" align="absmiddle" style="width: 30px; height: 30px;">
                                    &nbsp;Facture n° <strong>V<?php echo $value['id'] ?></strong>
                                </a> 
                                <a rel="<?php echo $value['post_property_id'] ?>" id="abonnementpremiumhisto" href="javascript:void(0)"><input type="hidden" value="<?php echo $value['id'] ?>" id="id_histo"/> -- <b>Marquer comme remboursé</b>
                                </a> 
                                -- Paiement de <strong><?php echo number_format($value['ttc_amount'] / 100, 2, '.', '') ?> &euro;</strong> par <?php echo $modep ?> (effectué le <?php echo $value['payment_date'] ?>)   
                            </td></tr>
                    </table>
                    <?php
                } elseif (strtolower($value['result']) == 'success2')
                {
                    ?>
                    <br>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/alert.gif" title="ERREUR débit, voir commentaire sur fiche client">
                    <a href="<?php echo Yii::app()->createUrl('/compta/premium_facture_pdf', array('f'=>$value['id']));  ?>" target="_blank">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/pdf1.png" border="0" align="absmiddle" style="width: 30px; height: 30px;">
                        &nbsp;Facture n° <strong>V<?php echo $value['id'] ?></strong>
                    </a> 
                    <a rel="<?php echo $value['post_property_id'] ?>" id="abonnementpremiumhisto" href="javascript:void(0)"> <input type="hidden" value="<?php echo $value['id'] ?>" id="id_histo"/> -- <b>Marquer comme remboursé</b>
                    </a> 
                    -- Paiement de <strong><?php echo number_format($value['ttc_amount'] / 100, 2, '.', '') ?> &euro;</strong> par <?php echo $modep ?> (effectué le <?php echo $value['payment_date'] ?>)
                    <?php
                } elseif (strtolower($value['result']) == 'rembourse')
                {
                    ?> 
                    <br>
                    <font color="red">Paiement de <strong><?php echo number_format($value['ttc_amount'] / 100, 2, '.', '') ?> &euro;</strong> par <strong><?php echo $modep ?> Remboursé</strong></font>
                    <?php
                } else
                {
                    ?>
                    <br>
                    <font color = "red">Paiement de <strong><?php echo number_format($value['ttc_amount'] / 100, 2, '.', '')
                    ?> &euro;</strong> par <strong><?php echo $modep ?> Refusé</strong></font> le <strong><?php echo $value['payment_date'] ?></strong> (<?php echo $value['payment_date'] ?>)	
                    <?php
                }
            }
            ?>
    </tr>
</table>    
<script>
    $(document).ready(function() {
        $("#abonnementpremiumhisto").live('click', function() {
            var id_pro = $(this).attr('rel');
            var id_his = $("#id_histo").val();
            $.ajax({
                type: "POST",
                url: webroot + '/abonnementPremiumHistoriquePaiement/abonnementpremiumhisto/',
                data: {'post_property_id': id_pro, 'id': id_his},
                success: function(data)
                {
                    var obj = $.parseJSON(data);
                    alert("Attention, veuillez vous assurer que le paiement a bien été annulé au près de la banque avant modification du statut !\n\nSouhaitez-vous marquer ce paiement comme remboursé ?");
                    $("#abcde").empty();
                    $("#abcde").html('<font color=\'red\'>Paiement de <strong>'+ obj.amount + ' &euro;</strong> par<strong> '+ obj.modep +' Remboursé</strong></font>');
                }
            });
            return false;
        });
    });
</script>
