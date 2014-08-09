<?php
	$data[0]=$rowData->$select[0];
	$data[1]=$rowData->$select[1];
	$data[2]=$rowData->$select[2];
	$data[3]=date(Yii::app()->params['date'],strtotime($rowData->mandate->signature_date));
	$data[4]=$rowData->$select[3];
	$tot = $this->getAvoir_ttc($data[0]);
	$data[5]=$rowData->$select[3]-$tot['mySum'];
	if ($rowData->$select[4]==0) {
		$css=' class="simple"';
		$status="Edit&eacute;e";
	} else if ($rowData->$select[4]==1) {
		$css=' class="avocat"';
		$status='<strong>Facture annul&eacute;e</strong><br>'.$rowData->$select[5];
	}
?>

<tr id="tr<?php echo $data[0];?>" >
    <th <?php echo $css?> scope="row" style="text-align:center ; vertical-align:middle;">
        <a class="lienFacture" href="<?php echo Yii::app()->createUrl('/compta/privilege_facture_pdf', array('id'=>$data[0]));?>" target="_blank" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
			<span>
                Facture n°<?php echo $data[0];?>
            </span>
            <img src="<?php echo Yii::app()->theme->baseUrl ?>/img/privilege/17.png" alt="mandat de vente" align="absmiddle" border="0">
		</a>
    </th>
    <td style="text-align:center ; vertical-align:middle;"><?php echo $data[1];?></td>
    <td style="text-align:center ; vertical-align:middle;"><?php echo $data[2];?></td>
    <td style="text-align:center ; vertical-align:middle;"><?php echo $data[3];?></td>
    <td style="text-align:center ; vertical-align:middle;"><strong><?php echo $data[4];?> €</strong></td>
    <td id="AV<?php echo $data[0];?>" style="text-align:center ; vertical-align:middle;"><strong style="color:#096"><?php echo $data[5];?> €</strong></td>
    <td style="text-align:center ; vertical-align:middle;">
		<?php if ($rowData['status']==0) {?>
			<?php if ($data[5]==$data[4]) {?>
			<button class="privilege_annuler" value="<?php echo $data[0];?>" name="<?php echo $data[0];?>">Annuler la facture</button>
			<?php } ?>
			<?php if($data[5]>0) {?>
			<button class="privilege_create_avoir" value="<?php echo $data[0];?>" name="<?php echo $data[0];?>_<?php echo $data[5];?>">G&eacute;nerer un avoir</button>
			<?php } ?>
		<?php } else {
			echo $status;
		} ?>
    </td>
</tr>