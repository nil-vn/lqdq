<?php
	$data[0] = $rowData->$select[0];
	$data[1] = $rowData->$select[1];
	$data[2] = date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	switch ($data[1]) {
		case 0:
			$css=' class="simple"';
			$status="en attente";	
			break;
		case 1:
			$css=' class="avocat"';
			$status="injoignable";
			break;
		default:
			$css='';
			$status='';
	}
?>

<tr>
	<th <?php echo $css?> style="text-align:center" scope="row"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
	<td style="text-align:center"><strong><?php if($data[1]==1) echo 'injoignable'; else echo 'en attente'; ?></strong></td>
	<td style="text-align:center"><?php echo $data[2]?></td>
	<td style="text-align:center">
		<?php if ($this->isClient($data[0])) {?>
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/05.png"" width=""16"" height="16" border="0" />
		<?php } else {?>
			"Aucun client"
		<?php } ?>			      
	</td>		  
	<td style="text-align:center">
		<?php if ($data[1]!=1) { ?>
		<a class='privilege_reveil_mark_injoignable' value="<?php echo $data[0];?>" href="javascript:void();" title="Marquer comme injoignable">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/02.png" width="16" height="16" border="0" alt="Marquer comme injoignable">
		</a>
		<?php } else { ?>
			<img width="16" height="16" border="0" alt="Marquer comme injoignable">
		<?php } ?>
		&nbsp;
		<a class="privilege_reveil_supprimer" value="<?php echo $data[0];?>" href="javascript:void();" title="Supprimer l'annonce du tableau">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Supprimer l'annonce du tableau">
		</a>				      
	</td>
</tr> 