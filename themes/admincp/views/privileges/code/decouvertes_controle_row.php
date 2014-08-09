<?php
	$data[0]=$rowData->$select[0];
	$arrUserMeta = (object)CHtml::listData($rowData->postProperty->user->metas, 'meta_key', 'meta_value');
	$data[1]=getUserMeta($arrUserMeta,'first_name');
	$data[2]=$rowData->$select[1];
	$data[3]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	$id = $rowData->$select[3];
	switch ($rowData->$select[1]) {
		case 0:
			$css=' class="simple"';
			$status="en attente";	
			break;
		case 1:
			$css=' class="avocat"';
			$status="injoignable";
			break;
	}
?>	

<tr>
    <th <?php echo $css;?> scope="row"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
    <td><strong><?php echo $data[1];?></strong></td>
    <td><strong><?php echo $status;?></strong></td>
    <td><?php echo $data[3];?></td>  
    <td>
		<?php if ($data[2]!=1) {?>
        <a href="javascript:void();" class="decouvertes_controle_marquer" value="<?php echo $id;?>" title="Marquer comme injoignable">
            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/02.png" width="16" height="16" border="0" alt="Marquer comme injoignable">
        </a>
		<?php } else { ?>
			<img width="16" height="16" border="0" alt="Marquer comme injoignable">
		<?php } ?>
        <!--  -->	
        &nbsp;
        <a href="javascript:void();" class="decouvertes_controle_actualiser" value="<?php echo $id;?>" title="Actualiser l'annonce (Supprime l'annonce du tableau)">
            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/21.png" width="16" height="16" border="0" alt="Actualiser l'annonce (Supprime l'annonce du tableau)">
        </a>	      
        &nbsp;
        <a href="javascript:void();" class="decouvertes_controle_supprime" value="<?php echo $id;?>" title="Supprime l'annonce du tableau">
            <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/01.png" width="16" height="16" border="0" alt="Supprime l'annonce du tableau">
        </a>	      
    </td>
</tr>