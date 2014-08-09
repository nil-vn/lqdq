<?php 
	$id = $rowData->$select[0];
	$payment_id = $rowData->$select[1];
	$status = $rowData->$select[2];
	$created = date(Yii::app()->params['date'],strtotime($rowData->$select[3]));
	$is_validate = $rowData->$select[4];
?>
<tr>
	<td>
		<a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $id;?>" target="_blank">BTK<?php echo $id;?></a>
	</td>
	<td>
		<strong>
		<?php if ($payment_id==7) {
			echo 'Decouverte';
		} else if($payment_id==2||$payment_id==3||$payment_id==4) {
			echo 'Premium / Privilege';
		} else {
			echo 'Autre';
		}?>
		</strong>
	</td>
	<td>
		<?php echo $status;?>
	</td>
	<td>
		<strong><?php echo $created;?></strong>
	</td>
	
	<td>
		<?php if (!($is_validate==1&&$status==0)) {?>
		<a href="javascript:void();" class='annonce_controle_horsligne_active' value="<?php echo $id;?>" title="Activer cette annonce en decouverte (Supprime l\'annonce du tableau)">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/iconSuccess_16x16.gif" width="16" height="16" border="0" alt="Activer cette annonce en decouverte (Supprime l\'annonce du tableau)" />
		</a>
		<?php } ?>
		<?php if (!($is_validate==0&&$status==2)) {?>
		<a href="javascript:void();" class='annonce_controle_horsligne_delete' value="<?php echo $id;?>" title="Marquer comme traitée (Supprime l\'annonce du tableau)">
			<img src="/back-office/themes/admincp/img/privilege/50.png" width="16" height="16" border="0" alt="Marquer comme traitée (Supprime l'annonce du tableau)">
		</a>
		<?php } ?>
	</td>
</tr>