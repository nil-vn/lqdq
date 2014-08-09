<?php 
	$data[0]=$rowData->$select[0];
	$css=' class="simple"';
?>
<tr>
	<td <?php echo $css;?> style="text-align:center; width:40% ; vertical-align:middle;">
		<a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a>
	</td>
	<td style="text-align:center ; vertical-align:middle;">
		<a href="javascript:void();" title="Supprimer l\'annonce du tableau">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" class="decouvertes_sansacquereur_supprimer" value="<?php echo $data[0];?>" alt="Supprime l'annonce du tableau">
		</a>
	</td>
</tr>