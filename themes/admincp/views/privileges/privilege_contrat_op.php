<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<span style="display: inline-block;width:10px;height:10px;background-color:lightgreen"></span>
Activée &nbsp;&nbsp;&nbsp;
<span style="display: inline-block;width:10px;height:10px;background-color:lightblue"></span>
Réactivée &nbsp;&nbsp;&nbsp;
<span style="display: inline-block;width:10px;height:10px;background-color:pink"></span>
Désactivée
<table class="table" border="0" style="border: 1px solid black">
  <tr style="background-color:lightgrey">
    <td>Id_annonce&nbsp;&nbsp;</td>
	<td>Conseiller&nbsp;&nbsp;</td>
	<td>Date envoi&nbsp;&nbsp;</td>
	<td>Offre&nbsp;&nbsp;</td>
	<td>Pourcentage&nbsp;&nbsp;</td>
	<td>Date signature&nbsp;&nbsp;</td>
	<td>Date désactivation&nbsp;&nbsp;</td>
  </tr>
  <?php foreach($model as $item) {?>
  <?php
    if ($item->offre=='of') {
      $of = 'Offre Ex Min 1 Acq Attente';
    }
	if ($item->offre=='tel') {
	  $of = 'Suite entretien téléphonique';
	}
	if ($item->offre=='acqfree') {
	  $of = 'Last Acq Free';
	}
	$myStyle = '';

	if ($item->fiche->signature_date!='' && $item->fiche->activation_date!='') {
	  if (strtotime($item->fiche->activation_date)<strtotime($item->fiche->signature_date)) {
		$myStyle = 'background-color:lightblue';
	  } else {
		$myStyle = 'background-color:pink';
	  }
	} else if ($item->fiche->signature_date!='') {
	  $myStyle = 'background-color:lightgreen';
	}
	$id = $item->post_property_id;
	if ($property_id=='') {
		if ($this->getNb($id)>1) {
			$id = '<a href="?id='.$id.'" target="_blank" title="Plusieurs contrats correspondent &agrave; cette annonce">'.$id.'</a>';
		}
	}
  ?>
  <tr style="<?php echo $myStyle;?>">
    <td><?php echo $id ?>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $item->op; ?>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo date(Yii::app()->params['date'],strtotime($item->d));?>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $of;?>&nbsp;&nbsp;&nbsp;</td>
	<td><?php echo $item->pourcentage;?>%</td>
	<td><?php 
			if ($item->fiche->signature_date!='') {
				echo date(Yii::app()->params['date'],strtotime($item->fiche->signature_date));
			}
		?>
	</td>
	<td><?php 
		if ($item->fiche->activation_date!='') {
			echo date(Yii::app()->params['date'],strtotime($item->fiche->activation_date));
		}
		?>
	</td>
  </tr>
  <?php } ?>
</table>