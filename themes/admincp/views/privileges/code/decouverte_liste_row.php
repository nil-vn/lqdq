<?php
	$postProperty = WpPostProperty::model()->find('id='.$rowData['id_annonce']);
	if ($rowData['valide']==0)
		$style='style="background-color:pink;"';
	else
		$style='';
	if ($postProperty) :
?>
<tr id="tr<?php echo $rowData['id_annonce'];?>" <?php echo $style; ?>>
	<td style="text-align:center ; vertical-align:middle;">
		<a href="<?php echo PIUrl::createUrl('/');?>/?property_id=<?php echo $rowData['id_annonce'];?>" target="_blank">
			<?php echo 'BTK'.$rowData['id_annonce'];?>
		</a>
	</td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $rowData['type_m'];?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $rowData['date_creation'];?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $rowData['desinscription_date'];?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $rowData['desinscription_commentaire'];?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo $rowData['valide'];?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo WpUserMeta::model()->getMetaValues($postProperty->user_id, 'first_name');?></td>
	<td style="text-align:center ; vertical-align:middle;"><?php echo WpUserMeta::model()->getMetaValues($postProperty->user_id, 'mobile_phone');?></td>
</tr>
<?php endif; ?>