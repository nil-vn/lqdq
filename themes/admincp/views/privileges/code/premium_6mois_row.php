<?php
	$data[0] = $rowData->$select[0];
	$data[1] = $rowData->$select[1];
	$status = $rowData->$select[2];
	switch ($status) {						
		case 0:
			$css=' class="simple"';
			$status='en attente';
			break;
		case 1:
			$css=' class="avocat"';
			$status='injoignable';
			break;
		default:
			$css='';
			$status='';
	}
	$data[3] = date(Yii::app()->params['date'],strtotime($rowData->$select[3]));
?>
<tr <?php echo $css;?>>
	<td><a href="<?php echo PIUrl::createUrl('/');?>/?property_id=<?php echo $data[1];?>" target="_blank">BTK<?php echo $data[1];?></a></td>
	<td><strong><?php echo $status;?></strong></td>
	<td><?php echo $data[3];?></td>
	<td>
		<?php if ($rowData->$select[2]!=1) {?>
		<a href="javascript:void();" class="premium_6mois_marquer" value="<?php echo $data[1];?>" title="Marquer comme injoignable">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/02.png" width="16" height="16" border="0" alt="Marquer comme injoignable" />
		</a>
		<?php } else { ?>
			<img width="16" height="16" border="0" alt="Marquer comme injoignable" />
		<?php } ?>
		&nbsp;
		<a href="javascript:void();" class="premium_6mois_supprimer" value="<?php echo $data[1];?>" title="Supprime l'annonce du tableau">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Supprimer l'annonce du tableau" />
		</a>
	</td>
</tr>