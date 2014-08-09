<?php
	$data[0] = $rowData->$select[0];
	$data[1] = $rowData->$select[1];
	$data[2] = date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	$data[3] = $rowData->$select[3];
	$data[4] = $rowData->$select[4];
	switch ($rowData->$select[5]) {
		case 0: $css=' class="simple"';
				$status='Attente controle';
				break;
		case 1: $css = 'class="avocat"';
				$status ='blacklistée';
				break;
		case 2: $css = 'class="mail"';
				$status = 'Whitelistée';
				break;
		case 3: $css = 'class="recommande"';
				$status = 'Supprimée';
				break;
	}
?>
<tr>
	<td <?php echo $css;?>><a href="<?php echo PIUrl::createUrl('/')?>?property_id=<?php echo $data[1];?>"><?php echo $data[1];?></a></td>
	<td><?php echo $data[2];?></td>
	<td><?php if (strlen($data[3])>1) {echo $data[3];} else {echo 'Autre';}?></td>
	<td><?php if (strlen($data[4])>1) {echo $data[4];} else {echo 'Aucun commentaire';}?></td>
	<td><?php echo $status;?>
		<br>
		Annonce whitelistée <?php echo '1';?> fois
		<br>
		<?php
		if ($rowData->$select[5]==0||$rowData->$select[5]==2) {
		?>
		<a href="javascript:void();" class="annonces_blacklist_blacklist" value="<?php echo $data[0]?>" title="Blacklister ce client">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/13.png" width="16" height="16" border="0" alt="Blacklister ce client" title="Blacklister ce client" />
		</a>
		<?php } ?>
		<?php
		if ($rowData->$select[5]==0||$rowData->$select[5]==1) {
		?>
		&nbsp;&nbsp;
		<a href="javascript:void();" class="annonces_blacklist_whitelist" value="<?php echo $data[0]?>" title="Whitelister ce client">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/14.png" width="16" height="16" border="0" alt="Whitelister ce client" title="Whitelister ce client" />
		</a>
		<?php } ?>
	</td>
</tr>