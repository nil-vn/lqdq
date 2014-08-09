<?php 

	$data[0]=$rowData->post_property_id;
	$data[1]=isset($rowData->postProperty->exportForcageCom->com)?$rowData->postProperty->exportForcageCom->com:''; //com
	$arrUserMeta = (isset($rowData->postProperty->user->metas))?(object)CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value'):(object)null;
	$data[2]=getUserMeta($arrUserMeta,'first_name').' '.getUserMeta($arrUserMeta,'last_name');
	$data[3]=isset($rowData->postProperty->address)?$rowData->postProperty->address:'';
	$data[4]=isset($rowData->postProperty->postal_code)?$rowData->postProperty->postal_code:'';
	$data[4].=' ';
	$data[4].= isset($rowData->postProperty->city)?$rowData->postProperty->city:'';
	$data[5]=$rowData->postProperty->prix;

	// if(isset($rowData->postProperty->postMetas)){
	// 	$arrPostMeta = CHtml::listData($rowData->postProperty->postMetas, 'category_field_id', 'name');
	// 	$rowData->postProperty->postMetas = $arrPostMeta;
	// 	if( array_key_exists(6,$rowData->postProperty->postMetas) )
	// 		$data[5] = $rowData->postProperty->postMetas['6'];
	// 	else
	// 		$data[5] = '';
	// }else{
	// 	$data[5] = '';
	// }
	if(isset($rowData->postProperty->created))
		$data[6]=date(Yii::app()->params['datetime'],strtotime($rowData->postProperty->created));
	else
		$data[6]='';
	if (empty($rowData->postProperty->date_modified)) {
		if(isset($rowData->postProperty->created))
			$data[7]=date(Yii::app()->params['datetime'],strtotime($rowData->postProperty->created));
		else
			$data[7]='';
	} else {
		$data[7]=date(Yii::app()->params['datetime'],strtotime($rowData->postProperty->date_modified));
	}
	//
	$pip = isset($rowData->postProperty->prospection)?$rowData->postProperty->prospection:null;
	if ($pip!=null) {
		$pip = $rowData->postProperty->prospection[0]->com;
	} else {
		$pip = null;
	}
	$nbAcq = WpListCustomer::model()->count(array('condition'=>'post_property_id = '.$data[0]));
	// set color for LBC/PV/SL
	$forcage_lbc = $this->getForcage('spir',$data[0]);
	$forcage_pv = $this->getForcage('paruvendu',$data[0]);
	$forcage_sl = $this->getForcage('seloger',$data[0]);
	if ($forcage_lbc==1) {
		$color_lbc="green";
	} else if ($forcage_lbc==0) {
		$color_lbc="red";
	} else {
		$color_lbc="black";
	}
	if ($forcage_pv==1) {
		$color_pv="green";
	} else if ($forcage_pv==0) {
		$color_pv="red";
	} else {
		$color_pv="black";
	}
	if ($forcage_sl==1) {
		$color_sl="green";
	} else if ($forcage_sl==0) {
		$color_sl="red";
	} else {
		$color_sl="black";
	}
	// set color row
	if(isset($rowData->postProperty->payment_id) && $rowData->postProperty->payment_id==2)
		$css=' style="background-color:#E3F6CE" title="Annonce privil&egrave;ge"';
	else if($pip==2)
		$css=' style="background-color:#BDBDBD" title="Pas interess&eacute;"';
	else if($pip==1)
		$css=' style="background-color:#A9D0F5" title="Interess&eacute;"';
	else if($nbAcq>0)
		$css=' style="background-color:#F6D8CE" title="Avec acqu&eacute;reur(s)"';
	else
		$css='';
?>
<tr <?php echo $css;?>>
	<td scope="row" >
		<a href="<?php echo PIUrl::createUrl('privileges/forcage',array('id'=>$data[0]));?>" target="_blank" title="Forcage diffusion LBC/PV/SL" target="_blank">
		<strong style="color:<?php echo $color_lbc;?>">LBC</strong>/<strong style="color:<?php echo $color_pv;?>">PV</strong>/<strong style="color:<?php echo $color_sl;?>">SL</strong></a>
	</td>
	<td valign="top" style="vertical-align: top;width:300px">
	<center>
	<form name="ft<?php echo $data[0];?>" method="post" action="">
	<input type="hidden" name="id" value="<?php echo $data[0];?>"/>
	<textarea name="com2"  style="width:450px;height:50px" readonly><?php echo $data[1];?></textarea>
	<textarea maxlength="3000" name="com" style="width:410px;height:35px;vertical-align: top" onfocus="this.style.color='red'"></textarea>
	<input type="submit" name="OK" value="OK" style="height:30px;vertical-align: top">
	</form>
	</center>
	</td>
	<td><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></td>
	<td><?php echo $data[2];?></td>
	<td>
		<?php echo $data[3];?><br>
		<?php echo $data[4];?>
	</td>
	<td><strong><?php echo $data[5];?>&euro;</strong> </td>	  
	<td><?php echo $data[6];?></td>
	<td><?php echo $data[7];?></td>
</tr>  