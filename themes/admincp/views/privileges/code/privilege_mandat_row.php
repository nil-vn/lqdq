<?php
$data[0] = $rowData->$select[0];
$data[1] = $rowData->$select[1];
$data[2] = $rowData->$select[2];
$data[3] = $rowData->$select[3];
//CVarDumper::dump($data[0], 10, true);
//    exit;
//$model = $this->getFind123($data[1]);
//if (!empty($model))
//$arrUserMeta = (object)CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value');
//$city = split('_',$rowData->postProperty->city);
//if (isset($city[1])) {
//	$city = $city[1];
//} else {
//	$city = '';
//}
//if ($rowData->postProperty->city)
//$data[2]=getUserMeta($arrUserMeta,'first_name').' '.getUserMeta($arrUserMeta,'last_name');
//$data[3]=$rowData->postProperty->address.'<br />'.$rowData->postProperty->postal_code.' '.$city;
//$data[4] = $rowData->postProperty->prix;
//$data[5]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
//$isOnline = $rowData->$select[3];
//CVarDumper::dump($rowData, 10, true);
//    exit;
//$arrUserMeta = (object)CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value');
//$city = split('_',$rowData->postProperty->city);
//if (isset($city[1])) {
//	$city = $city[1];
//} else {
//	$city = '';
//}
//if ($rowData->postProperty->city)
//$data[2]=getUserMeta($arrUserMeta,'first_name').' '.getUserMeta($arrUserMeta,'last_name');
//$data[3]=$rowData->postProperty->address.'<br />'.$rowData->postProperty->postal_code.' '.$city;
//$data[4] = $rowData->postProperty->prix;
//$data[5]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
//$isOnline = $rowData->$select[3];
//dump($rowData);
$data[5] = date(Yii::app()->params['date'], strtotime($rowData->$select[2]));
$isOnline = $rowData->$select[3];
?>
<?php
$model = $this->getFind123($data[1]);

if (!empty($model))
{
	?>

	<tr>
		<th scope="row" style="text-align:center">
			<?php echo $data[0]; ?> <?php if ($isOnline == 1) echo '<img src="' . Yii::app()->theme->baseUrl . '/img/privilege/online.png"></img>'; ?>
		</th>
		<td style="text-align:center"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[1]; ?>" target="_blank">BTK<?php echo $data[1]; ?></a></td>
		<td style="text-align:center"> 
			<?php echo $data[2]; ?>
		</td>

		<td style="text-align:center">
			<?php
			//echo $data[3]; 
			echo $model->address;
			?>
		</td>
		<td style="text-align:center"><strong><?php //echo ($data[4]!=''?$data[4]:0);    ?><?php echo $model->prix; ?></strong> €</td>	  
		<td style="text-align:center">
			<?php echo $data[5]; ?>
			<?php
			$pid = $data[1];
			$pdfFile = dirname(__FILE__) . '/../../../../../../wp-content/plugins/immobilier/front-end/application/privilege_mandat/Mandat_Immobilier.fr_BTK'.$pid.'.pdf';
			if (file_exists($pdfFile)) :
			?>
			<a href="<?php echo '/wp-content/plugins/immobilier/front-end/application/privilege_mandat/Mandat_Immobilier.fr_BTK'.$pid.'.pdf'; ?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl ?>/img/privilege/17.png" alt="mandat de vente" align="absmiddle" border="0"></a>
			<?php endif; ?>
		</td>
	</tr>    
<?php } ?>