<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter ='<form class="filter" name="form" method="get" action="">
			Reference annonce: 
			<input name="id" type="text" maxlength="9">
			&nbsp;
			Classer par
			<select name="order">
			  <option value="post_property_id ASC">Référence annonce croissant</option>
			  <option value="post_property_id DESC">Référence annonce décroissant</option>
			  <option value="insertion_date DESC">Date décroissante</option>
			  <option value="insertion_date ASC">Date croissante</option>
			</select>
			&nbsp;
			Afficher seulement
			<select name="filter">
				<option value="status!=3 and status!=5">Tout afficher</option>
				<option value="status=0">En attente traitement</option>
				<option value="status=1">En attente acte athentique</option>
				<option value="status=2">en attente reglement</option>
				<option value="status=3">Dossier clôt</option>
				<option value="status=4">Conflit/Avocat</option>
				<option value="status=5">Dossier supprimé</option>
			</select>
			<input name="" type="submit" value="OK">
		</form>';
?>
<?php $this->widget('TableWidget', array(
        'caption' => 'Privil&egrave;ge vendu par Immobilier.fr',
		'headers' => array('Ref. annonce','Client vendeur','Client acqu&eacute;reur','Statut','Date facture','Honoraires','Date insertion','Facturation','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_vendu_immo_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonce(s) en cours de traitement',
)); ?>