<?php
	$infoUser = WpListCustomer::model()->getUser($rowData->$select[1]);
	if(!empty($infoUser)){
		$arrUserMeta = CHtml::listData($infoUser, 'meta_key', 'meta_value');
		$data[7] = $arrUserMeta['first_name'];
		$data[8]= $arrUserMeta['landline'];
		$data[9]= $arrUserMeta['mobile_phone'];
	} else {
		$data[7] = '';
		$data[8]= '';
		$data[9]= '';
	}
	$data[5]= date(Yii::app()->params['date'],strtotime($rowData->$select[5]));
	$data[0]=$rowData->$select[1];
	$data[2]=$rowData->$select[2];
	$data[3]=$rowData->$select[3];
	$data[4]=$rowData->$select[4];
	$data[6]=$rowData->$select[6];
	
	$css=' class="simple"';
	$status="A controler";

?>

<tr>
	<th <?php echo $css?> style="text-align:center" scope="row"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
	<td style="text-align:center"><strong>
			<?php echo $data[2];?>
	</strong>
	</td>
	<td style="text-align:center"><?php if(strlen($data[6]) > 0) {?>Tel: <strong><?php echo $data[6];?></strong><?php }?><br>
		<?php if(strlen($data[3]) > 0) {?>Port: <strong><?php echo $data[3];?></strong><?php }?><br>
		<?php if(strlen($data[4]) > 0) {?>Email: <strong><?php echo $data[4];?></strong><?php }?>
	</td>
	<td style="text-align:center"><strong>
			<?php echo $data[7];?>
	</strong>
	</td>
	<td style="text-align:center"><strong>
		<?php if(strlen($data[8]) > 0) {?>Tel: <strong><?php echo $data[8];?></strong><?php }?><br>
		<?php if(strlen($data[9]) > 0) {?>Port: <strong><?php echo $data[9];?></strong><?php }?>
		</strong>
	</td>
	</td>
	<td style="text-align:center"><strong>
		Opérateur inconnu
	<br><strong style="color:#F00">Rappel du<br><?php echo $data[5];?></strong>
			
	</strong>
	</td>
	<td style="text-align:center">
		<?php if ($data[2]!= 1) {?>
		<a class="acquereurs_rappel_supprimer" href="javascript:void();" value="<?php echo $rowData['id'];?>" title="Client vérifié">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/162/02.png" width="16" height="16" border="0" alt="Client vérifié">
		</a>		
		<?php } else { ?>
			<img width="16" height="16" border="0" alt="Marquer comme injoignable">
		<?php } ?>
		&nbsp;&nbsp;
		<select style="width:60px !important;height:25px !important;margin-top:10px" name="delai" id="delai">
		<?php for($i=31;$i > 0; $i--) {?>
		<option value="<?php echo $i?>" <?php if($i==9) echo 'selected="selected"';?>><?php echo $i;?></option>
		<?php }?>
		</select>
		<span>jours</span>
		<a href="javascript:void();" class='acquereurs_rappel_rappeler' value="<?php echo $rowData['id'];?>" title="Rappeler ce client dans X jours (saisir ou sélectionner une valeur, 9 jours par défaut)">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/161/37.png" width="16" height="16" border="0" alt="">
		</a>		
	</td>
</tr>