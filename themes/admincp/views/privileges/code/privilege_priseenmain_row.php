<?php
	$data[0]=$rowData->$select[0];
	$infoUser = WpPostProperty::model()->getUser($data[0]);
	if(!empty($infoUser)){
		$arrUserMeta = CHtml::listData($infoUser, 'meta_key', 'meta_value');
		$data[1] = $arrUserMeta['first_name'];
	} else {
		$data[1] = '';
	}
	$data[2]=$rowData->$select[1];
	$data[3]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	switch ($data[2]) {
		case 0:
			$css=' class="simple"';
			$status="en attente";
			break;
		case 1 || 3:
			$css=' class="avocat"';
			$status="injoignable";
	}
?>

<tr>
	<th <?php echo $css?> style="text-align:center" scope="row"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
	<td style="text-align:center"><strong><?php echo $data[1];?></strong></td>
	<td style="text-align:center"><strong><?php echo $status;?></strong></td>
	<td style="text-align:center"><?php echo $data[3];?></td>
	<td style="text-align:center">
		<?php if ($data[2]!=1) {?>
		<a class='privilege_priseenmain_marquer_injoignable' value="<?php echo $rowData['id'];?>" title="Marquer comme injoignable">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/02.png" width="16" height="16" border="0" alt="Marquer comme injoignable">
		</a>
		<?php } else { ?>
			<img width="16" height="16" border="0" alt="Marquer comme injoignable">
		<?php } ?>
		&nbsp;
		<a class="privilege_priseenmain_supprimer" value="<?php echo $rowData['id'];?>" title="Supprimer l'annonce du tableau">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Supprimer l'annonce du tableau">
		</a>			      
	</td>
</tr>