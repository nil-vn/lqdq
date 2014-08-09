<?php
$data[0]=$rowData->$select[0];
$data[1]=$rowData->$select[1];
$data[2]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
switch ($data[1]) {
case 0:
	$css=' class="simple"';
	$status='en attente';
	break;
case 1:
	$css=' class="avocat"';
	$status='injoignable';
}
?>

<tr>
		  <th <?php echo $css;?> scope="row" style="text-align:center ; vertical-align:middle;"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
		  <td style="text-align:center ; vertical-align:middle;"><strong><?php echo $status;?></strong></td>
		  <td style="text-align:center ; vertical-align:middle;"><?php echo substr($data[2],0,10);?></td>
		  <td style="text-align:center ; vertical-align:middle;">
			
				<?php if ($this->isClient($data[0])) {?>
				<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/05.png"" width=""16"" height="16" border="0" />
				<?php } else {?>
				"Aucun client"
				<?php } ?>
		  </td>
		  <td style="text-align:center ; vertical-align:middle;">
			<?php if ($data[1]!=1) { ?>
			<a href="javascript:void();" class="privilege_maj_marquer_injoignable" value="<?php echo $data[0];?>" title="Marquer comme injoignable">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/02.png" width="16" height="16" border="0" alt="Marquer comme injoignable" />
			</a>
			<?php } else { ?>
				<img width="16" height="16" border="0" alt="Marquer comme injoignable" />
			<?php } ?>
			<a href="javascript:void();" class="privilege_maj_supprime" value="<?php echo $data[0];?>" title="Supprime l'annonce du tableau">
				<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Supprime l'annonce du tableau" />
			</a>
		  </td>
</tr>  