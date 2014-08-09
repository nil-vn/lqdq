<?php
	$data[0]=$rowData->$select[0];
	$arrUserMeta = (object)CHtml::listData($rowData->user->metas, 'meta_key', 'meta_value');
	$data[1] = getUserMeta($arrUserMeta,'first_name');
	$data[2]=$rowData->$select[1];
	$data[3]=date(Yii::app()->params['datetime'],strtotime($rowData->user->user_registered));
	switch ($rowData->$select[1]) {
	case 0:
		$css=' class="simple"';
		$status="en attente";
		break;
	default:
		$css=' class=""';
		$status="injoignable";
	}
?>

<tr>
	<th <?php echo $css;?> scope="row" style="text-align:center ; vertical-align:middle;"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
	<td style="text-align:center ; vertical-align:middle;"><strong><?php echo $data[1];?></strong></td>
	<td style="text-align:center ; vertical-align:middle;"><strong><?php echo $status;?></strong></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $data[3];?></td>
	<td style="text-align:center ; vertical-align:middle;">
		<a href="javascript:void();" class="controle_descriptif_actualiser" value="<?php echo $data[0];?>" title="Actualiser l'annonce (Supprime l'annonce du tableau)">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/21.png" width="16" height="16" border="0" alt="Actualiser l'annonce (Supprime l'annonce du tableau)">
		</a>
	</td>
</tr>