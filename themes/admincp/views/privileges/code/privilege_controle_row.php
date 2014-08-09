<?php
$data[0] = $rowData->$select[0];
$data[1] = $rowData->$select[1];
$data[2] = $rowData->$select[2];
$data[3] = date(Yii::app()->params['date'],strtotime($rowData->$select[3]));
$data[4] = $rowData->$select[4];
switch ($data[2]-1) {
	case 1:
		$css=' class="mail"';
		$status="E-mail";
		break;
	case 2:
		$css=' class="simple"';
		$status="Courrier simple";
		break;
	case 3:
		$css=' class="recommande"';
		$status="Courrier recommandé";
		break;
	case 4:
		$css=' class="avocat"';
		$status="Avocat";
		break;
}
if (strlen($data[3]) > 0) {
    if (strtotime(date('Y-m-d')) > strtotime($data[4])) {
        $css = ' style="background-color:#CF0"';
        $status = '<strong style="color:red">Rappel du ' . date(Yii::app()->params['date'], strtotime($data[4])) . '</strong>';
    }
}
?>
<tr <?php echo $css?>>
	  <th scope="row"><a href="<?php echo PIUrl::createUrl('/')?>/?property_id=<?php echo $data[1]?>" target="_blank">BTK<?php echo $data[1];?></a></th>
	  <td>
		<strong><?php echo $status;?></strong>
		
		<br>
		<!-- TRAITEMENT MANUEL (COURRIERS, AVOCAT...) -->
		<?php if ($data[2]<4) {?>
			<select name="etape" id="etape" postPropertyId="<?php echo $data[1]?>" style="width:190px;">
			  <option value="" selected="selected">MODIFIER STATUT</option>						
			  <?php if ($data[2]-1==1) { ?><option value="2">COURRIER SIMPLE</option><?php } ?>
			  <?php if ($data[2]-1<=2) { ?><option value="3">COURRIER RECOMMANDE</option><?php } ?>
			  <?php if ($data[2]-1==3) { ?><!--<option value="4">AVOCAT</option> --><?php } ?>
			</select>
		<?php } ?>
		
	  </td>
	  <td><?php echo $data[3];?></td>
	  <td>
		<?php if ($this->isClient($data[1])) { ?>
			<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/05.png" width="16" height="16" border="0" />
		<?php } else {?>
			Aucun client
		<?php } ?>
	  </td>
	  <td style="text-align:center">
		<a href="javascript:void();" class="privilege_controle_basculer" value="<?php echo $data[0];?>" title="Basculer en vendu par immo">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/45.png" width="16" height="16" border="0" alt="Basculer en vendu par immo" />
		</a>
		&nbsp;
		<a href="javascript:void();" class="privilege_controle_supprimer" value="<?php echo $data[0];?>" title="Marquer comme traitée (Supprime l'annonce du tableau)">
		<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/50.png" width="16" height="16" border="0" alt="Marquer comme traitée (Supprime l'annonce du tableau)" />
		</a>
		<div id="fr<?php echo $data[0];?>">
			Rappeler dans: 
			<select name="delay" class="delay">                            
			<?php for($i=1;$i<=31;$i++) {?>
			  <option value="<?php echo $i;?>" <?php if ($i==3) {?>selected="selected"<?php }?>><?php echo $i;?></option>                              	
			<?php } ?>
			</select>
			<select name="period" class="period">
				<option value="d">jours</option>
				<option value="w" selected="selected">semaines</option>
				<option value="m">mois</option>
			</select>
			<a href="javascript:void(0)" class="privilege_controle_rappel" value="<?php echo $data[0];?>" title="Rappeler ce client" >
				<input type="image" src="<?php echo Yii::app()->theme->baseUrl;?>/img/privilege/37.png" align="absmiddle" alt=""/>
			</a>
		</div>							  
	  </td>
	</tr>