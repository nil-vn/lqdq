<?php 
	$id=$rowData->$select[0];
	$data[0]=$rowData->$select[1];
	$data[1]=$rowData->postProperty->payment_id;
	$data[2]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	$data[3]=$rowData->postProperty->type_property;
	switch ($rowData->$select[3]) {
		case 0:
			$css=' class="simple"';
			$status="Attente traitement";
			break;
		case 1:
			$css=' class="avocat"';
			$status="Traitement encours";
			break;
		case 2:
			$css=' class="mail"';
			$status="";
			break;
		case 3:
			$css=' class="recommande"';
			$status="Contrôle effectué"	;
			break;
	}
?>
<tr>
    <th <?php echo $css;?> scope="row" style="text-align:center ; vertical-align:middle;"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
	<td style="text-align:center ; vertical-align:middle;"><strong>
	<?php if($data[1]==7) {
		echo 'Découverte';
	} else if ($data[1]==2 || $data[1]==3|| $data[1]==4){
		echo 'Premium / Privilège';
	}?></strong></td>
    <td style="text-align:center ; vertical-align:middle;"><strong><?php echo $status;?></strong></td>
    <td style="text-align:center ; vertical-align:middle;"><?php echo $data[2];?></td>	  
    <td style="text-align:center ; vertical-align:middle;">
		<?php if ($rowData->$select[3]!=3) { ?>
			<a href="javascript:void();" class="annonce_controle_delete" value="<?php echo $id;?>" title="Marquer comme traitée (Supprime l'annonce du tableau)">
				<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Marquer comme traitée (Supprime l'annonce du tableau)">
			</a>	
		<?php } ?>
    </td>
</tr>