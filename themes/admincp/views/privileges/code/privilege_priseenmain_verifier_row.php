<?php				
  $data[0] = $rowData->$select[0];
  $data[1] = $rowData->$select[1];
  $arrUserMeta = (object)CHtml::listData($rowData->property->user->metas, 'meta_key', 'meta_value');
  $name = getUserMeta($arrUserMeta,'first_name');
  $status = $rowData->$select[2];
  $data[3] = date(Yii::app()->params['datetime'],strtotime($rowData->$select[3]));
  switch($status) {
    case 0: $css = 'class="simple"'; $status = 'controlée en attente'; break;
	case 1: $css = 'class="avocat"'; $status = 'controlée'; break;
	default: $css = ''; $status = '';
  }
?>
<tr <?php echo $css;?>>
  <th scope="row"><a href="<?php echo PIUrl::createUrl('/');?>/?property_id=<?php echo $data[1];?>" target="_blank">BTK<?php echo $data[1];?></a></th>
  <td><strong><?php echo $name;?></strong></td>
  <td><strong><?php echo $status;?></strong></td>
  <td><?php echo $data[3];?></td>					  		  
  <td>
    &nbsp;
	<?php if ($rowData->$select[2]!=1) {?>
    <a href="javascript:void();" class="privilege_priseenmain_verifier_supprimer" value="<?php echo $data[1];?>" title="Supprimer l'annonce">
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Supprime l'annonce du tableau" />
    </a>		
	<?php } ?>
  </td>
</tr>  