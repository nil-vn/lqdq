<?php 
	$data[0]=$rowData->$select[0];
	$data[1]=date(Yii::app()->params['date'],strtotime($rowData->$select[1]));
	$arrUserMeta = (object)CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value');
	$data[2]=getUserMeta($arrUserMeta,'last_name');
	$data[3]=round((($rowData->$select[2])/100)/1.196,2);
	$data[4]=round(($rowData->$select[2])/100 - (($rowData->$select[2])/100)/1.196,2);
	$data[5]=round(($rowData->$select[2])/100,2);
	$select[3] = trim($select[3],'`');
	if ($rowData->$select[3] == 1) {
		$data[6]= 'cheque';
	} else {
		$data[6]= 'cb';
	}
	switch ($rowData->$select[4]) {
		case 'success': $result = 'accepté'; $css = ''; break;
		case 'g5':$result = 'facture annulée - raison : insuffisance de credit'; $css = 'class="avocat"'; break;
		case 'failure': $result = 'facture annulée - raison : insuffisance de credit'; $css = 'class="avocat"'; break;
		case 'rembourse': $result = 'facture annulée - raison : remboursement du montant'; $css = 'class="avocat"'; break;
		default : $result ='?'; $css='';
	}
?>
<tr>
    <th scope="row">
        <a class="facture" href="<?php echo $this->baseHost;?>/my-ad/?action=bondeCommande&property_id=<?php echo $data[0];?>&exportOrder=1&tem" target="_blank" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
			<?php echo $data[0];?>
			<a href="<?php echo Yii::app()->createUrl('/compta/premium_facture_pdf', array('f'=>$data[0])); ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/privilege/17.png" alt="mandat de vente" align="absmiddle" border="0"></a>
		</a>
    </th>
    <td><?php echo $data[1];?></td>
    <td><?php echo $data[2];?></td>
    <td><?php echo $data[3];?></td>		  
    <td><?php echo $data[4];?></td>
    <td><?php echo $data[5];?></td>
    <td><?php echo $data[6];?></td>
    <td><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a> <?php echo $result;?></td>
</tr>