 <?php
	$data[0] = $rowData->$select[0];
	$infoUser = WpPostProperty::model()->getUser($rowData->postProperty['id']);
	if(!empty($infoUser)){
		$arrUserMeta = CHtml::listData($infoUser, 'meta_key', 'meta_value');
		$data[1] = $arrUserMeta['first_name'];
		$data[2] = $arrUserMeta['last_name'];
		$data[3] = isset($arrUserMeta['email']) ? $arrUserMeta['email'] : '';
		$a = '';
		if(trim($arrUserMeta['landline']) != ""){
			if(trim($arrUserMeta['mobile_phone']) == ""){
				$a = '';
			} else {
				$a = ' / ';
			}
		} else {
			if(trim($arrUserMeta['mobile_phone']) == ""){
				$a = '';
			} else {
				$a = '';
			}
		}
		$data[4]= $arrUserMeta['landline'].$a.$arrUserMeta['mobile_phone'];
	} else {
		$data[1] = '';
		$data[2]= '';
		$data[3]= '';
		$data[4]= '';
	}
	$data[5]=date(Yii::app()->params['date'],strtotime($rowData->$select[1]));
	$data[6]=$rowData->$select[2];
 ?>
 <tr class="">
	<td style="text-align:center"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank"><?php echo $data[0];?></a></td>
	<td style="text-align:center"><?php echo $data[1];?></td>
	<td style="text-align:center"><?php echo $data[2];?></td>
	<td style="text-align:center"><?php echo $data[3];?></td>
	<td style="text-align:center"><?php echo $data[4];?></td>
	<td style="text-align:center"><?php echo $data[5];?></td>
	<td style="text-align:center"><?php echo $data[6];?></td>
	<td style="text-align:center">
		<span><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/success.png" width="16" height="16" border="0" class="location_attente_activer" value="<?php echo $data[0];?>" title="Activer" style="cursor:pointer"></span>
		<span><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/01.png" width="16" height="16" border="0" class="location_attente_supprimer" value="<?php echo $data[0];?>" title="Supprimer" style="cursor:pointer"></span>
	</td>
 </tr>