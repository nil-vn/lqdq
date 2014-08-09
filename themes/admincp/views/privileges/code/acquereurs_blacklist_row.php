<?php
	$data[0] = $rowData->$select[0];
	$data[1] = $rowData->$select[1];
	$data[2] = $rowData->$select[2];
	$data[3] = $rowData->$select[3];
	$data[4] = $rowData->$select[4];
	$data[5] = $rowData->$select[5];
	$valide = $rowData->$select[6];
	$data[7] = $rowData->$select[7];
	$controle = $rowData->$select[8];
	$data[9] = $rowData->$select[9];
	$data[10] = $rowData->$select[10];
	if ($valide==0&&$controle==0) {
		$css = 'class="simple"';
		$status = 'Attente controle';
	} else if ($valide==2&&$controle==1) {
		$css = 'class="mail"';
		$status = 'Whitelisté';
	} else if ($valide==1&&$controle==1) {
		$css = 'class="avocat"';
		$status = 'blacklisté';
	}
	//dump($rowData);
?>
<tr>
	<th scope="row" <?php echo $css;?>>
		<strong>
		<a href="<?php echo PIUrl::createUrl('/');?>/?property_id=<?php echo $data[1]?>" target="_blank">BTK<?php echo $data[1];?></a>
		</strong>
	</th>
	<td><strong><?php echo $data[2];?></strong></td>
	<td><strong><?php echo $data[3];?></strong></td>
	<td><strong><?php echo $data[4];?></strong></td>
	<td><strong><a href="<?php echo PIUrl::createUrl('home/search',array('profile'=>$data[5]));?>" target="_blank"><?php echo $data[5];?></a></strong></td>
	<td><strong><?php echo $data[7];?></strong></td>
	<td><strong><?php echo (strlen($data[9])>1?$data[9]:"Autre");?></strong></td>
	<td><strong><?php echo (strlen($data[10])>1?$data[10]:"Aucun commentaire");?></strong></td>
	<td>
		<strong><?php echo $status;?></strong>
		<br>
		Client whitelisté <?php echo $this->getClientWhitelist($data[0]);?> fois
		<br>
		<?php
		if ($valide==0&&$controle==0||$valide==2 && $controle==1) {
		?>
		<a href="javascript:void();" class="acquereurs_blacklist_blacklist" value="<?php echo $data[0]?>" title="Blacklister ce client">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/13.png" width="16" height="16" border="0" alt="Blacklister ce client" title="Blacklister ce client" />
		</a>
		&nbsp;&nbsp;
		<?php } ?>
		<?php
		if ($valide==0&&$controle==0||$valide==1 && $controle==1) {
		?>		
		<a href="javascript:void();" class="acquereurs_blacklist_whitelist" value="<?php echo $data[0]?>" title="Whitelister ce client">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/14.png" width="16" height="16" border="0" alt="Whitelister ce client" title="Whitelister ce client" />
		</a>
		<?php } ?>
	</td>
</tr>