<?php
	$data[0] = $rowData->$select[0];
	$data[1] = $rowData->$select[1];
	$data[2] = date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
	$data[3] = $rowData->$select[3];
	$id = $rowData->$select[4];
	switch ($data[1]) {
		case 0:
			$css = 'class="simple"';
			$status = 'Attente traitement';
			break;
		case 1:
			$css = 'class="avocat"';
			$status = '';
			break;
		case 2:
			$css = 'class="mail"';
			$status = '';
			break;
		case 3:
			$css = 'class="recommande"';
			$status = 'Contrôle effectué';
			break;
	}	
	if ($data[3]!=null) {
		if (strtotime(date('Y-m-d H:s:i'))>strtotime(strtotime($data[3]))) {
			$css=' class="mail"';
			$status='Annonce à rappeler le '.date(Yii::app()->params['date'],strtotime($data[3]));
		}
	}
?>
<tr <?php echo $css;?>>
  <th scope="row"><a href="<?php echo PIUrl::createUrl('/');?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
  <td><strong><?php echo $status;?></strong></td>
  <td><?php echo $data[2];?></td>
  <td>
	<?php 
		if ($this->isClient($data[0])) {
			echo '<img src="'.Yii::app()->theme->baseUrl.'/img/163/05.png" width="16" height="16" border="0" />';
		} else {
			echo 'Aucun client';
		}
	?>	
  </td>		  
  <td style="text-align:center">
  <?php 
	switch ($data[1]) {
		case 0:
  ?>
	<!-- RAPPEL ANNONCE -->
	<div id="fr<?php echo $id;?>">
		Rappeler dans: 
		<select name="delay" class="delay">                            
		<?php for ($i=1;$i<=31;$i++) { ?>
		  <option value="<?php echo $i;?>" <?php if ($i==3) {?>selected="selected"<?php } ?>><?php echo $i;?></option>                              	
		<?php } ?>
		</select> 
		<select name="period" class="period">
			<option value="d">jours</option>
			<option value="w" selected="selected">semaines</option>
			<option value="m">mois</option>
		</select>
		<a href="javascript:void(0)" class="privilege_desactiver_rappel" value="<?php echo $id;?>">
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/161/37.png" align="absmiddle" alt=" title="Rappeler ce client" />
		</a>
	</div>	
	<a href="javascript:void();" class="privilege_desactiver_vendu" value="<?php echo $id;?>" title="Basculer en vendu">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/163/02.png" width="16" height="16" border="0" alt="Basculer en vendu" />
	</a>
	&nbsp;	
	<a href="javascript:void();" class="privilege_desactiver_venduimmo" value="<?php echo $id;?>" title="Basculer en vendu par immo">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/163/45.png" width="16" height="16" border="0" alt="Basculer en vendu par immo" />
	</a>
	&nbsp;
	<a href="javascript:void();" class="privilege_desactiver_supprimer" value="<?php echo $id;?>" title="Marquer comme traitée (Supprime l'annonce du tableau)">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/162/50.png" width="16" height="16" border="0" alt="Marquer comme traitée (Supprime l'annonce du tableau)" />
	</a>	
  </td>
  <?php
		break;
	}
  ?>
</tr>