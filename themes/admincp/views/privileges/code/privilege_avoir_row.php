<?php 
	$data[0]=$rowData->$select[0];
	$data[1]=$rowData->$select[1];
	$data[2]=$rowData->facture->post_property_id;
	$data[3]=date(Yii::app()->params['datetime'],strtotime($rowData->$select[2]));
	$data[4]=$rowData->$select[3]; 
	$data[5]=$rowData->facture->client_firstname.'/'.$rowData->facture->purchaser_firstname;
?>
<tr>
	<td style="text-align:center ; vertical-align:middle;">
		<a class="lienAvoir" href="<?php echo Yii::app()->createUrl('/compta/privilege_avoir_pdf', array('pid'=>$data[0], 'fid'=>$data[1]));?>" target="_blank">
			<?php echo $data[0];?>
			<img src="<?php echo Yii::app()->theme->baseUrl ?>/img/privilege/17.png" alt="mandat de vente" align="absmiddle" border="0">
		</a>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<?php echo $data[1];?>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[2];?>" target="_blank"><?php echo $data[2];?></a></td>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<?php echo $data[3];?>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<strong><?php echo $data[4];?>  &euro;</strong>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<?php echo $data[5];?>
	</td>
</tr>