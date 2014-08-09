<?php
$data[0]=$rowData->$select[0];
$data[1]=$rowData->$select[1];
$data[2]=date(Yii::app()->params['date'],strtotime($rowData->$select[2]));
switch ($rowData->statut) {
case 0:
	$css=' class=""simple""';
	$statut="en attente";					
case 1:
	$css=' class="avocat"';
	$statut='';
case 2:
	$css=' class="mail"';
	$statut="Basculé en contrôle";
case 3:
	$css=' class="recommande"';
	$statut="Contrôle effectué";
}
if(!empty($rowData->date_rappel)){
	$diff = date_diff(date_create($rowData->date_rappel),date_create(date('Y-m-d H:i:s')));
	if($diff->days>0){
		$css=' style="background-color:#CF0"';
		$statut='<strong style="color:red">Annonce à rappeler<br>le '.$rowData->date_rappel.'</strong>';
	}
}
?>

<tr>
		  <th <?php echo $css;?> scope="row" style="text-align:center ; vertical-align:middle;"><a href="<?php echo PIUrl::createUrl('/'); ?>/?property_id=<?php echo $data[0];?>" target="_blank">BTK<?php echo $data[0];?></a></th>
		  <td style="text-align:center ; vertical-align:middle;"><strong><?php echo $statut;?></strong></td>
		  <td style="text-align:center ; vertical-align:middle;"><?php echo substr($data[2],0,10);?></td>
		  <td style="text-align:center ; vertical-align:middle;">
			
				<?php if ($this->isClient($data[0])) {?>
				<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/05.png" width="16" height="16" border="0" />
				<?php } else {?>
				"Aucun client"
				<?php } ?>
		  </td>
		  <td style="text-align:center ; vertical-align:middle;">
			<?php 
			if($rowData->statut==0){
				if ($data[1]!=1) { ?>
				<select class="action_vendu_<?php echo $data[0];?>" style="height: 25px;margin-top: 10px;">
					<option value="mail">Contr&ocirc;le e-mail</option>
					<option value="simple">Contr&ocirc;le courrier simple</option>
					<option value="recommande">Contr&ocirc;le courrier recommand&eacute;</option>
					<option value="supprimer">Marquer comme trait&eacute; (supprimer)</option>
				</select>
				<input name="" type="submit" class="submit_vendu" ref="<?php echo $data[0];?>" value="ok">
				&nbsp;	
				<a class="privilege_controle_creer" href="javascript:void();" value="<?php echo $data[0];?>" title="Basculer en vendu par immo">
				<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/163/45.png" width="16" height="16" border="0" alt="Basculer en vendu par immo" />
				</a>
				&nbsp;
				</br>
				Rappeler dans:
				<select class="num_vendu_<?php echo $data[0] ;?>" style="width:55px;height: 25px;margin-top: 10px;" name="delai" id="delai">
					<?php for($j = 1; $j <= 31; $j++) {?>
				  <option value="<?php echo $j;?>" <?php echo ($j == 3) ? 'selected="selected"' : '';?>><?php echo $j;?></option>
				  <?php }?>
				</select> 
				<select class="day_vendu_<?php echo $data[0] ;?>" style="width:100px;height: 25px;margin-top: 10px;" name="periode" id="periode">
					<option value="d">jours</option>
					<option value="w" selected="selected">semaines</option>
					<option value="m">mois</option>
				</select>
				<input class="privilege_controle_rappeler" ref="<?php echo $data[0] ;?>" type="image" src="<?php echo Yii::app()->theme->baseUrl;?>/img/161/37.png" align="absmiddle" alt="" title="Rappeler ce client" />
				<?php } else { ?>
					<img width="16" height="16" border="0" alt="Marquer comme injoignable" />
				<?php } 
			}
			?>
		  </td>
</tr>  