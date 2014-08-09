<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" name="form" method="get" action="'.PIUrl::createUrl('privileges/privilege_vendu').'">
	Reference annonce: 
	<input name="id" type="text" style="width:150px" maxlength="9" value="">
	Classer par
	<select name="order">
		<option value="post_property_id ASC">Référence annonce croissant</option>
		<option value="post_property_id DESC">Référence annonce décroissant</option>
		<option value="date_insertion ASC">Date insertion croissante</option>
		<option value="date_insertion DESC">Date insertion décroissante</option>

		<!--<option value="postProperty.created ASC">Date MAJ croissante</option>
		<option value="postProperty.created DESC">Date MAJ décroissante</option>-->
	</select>
	Afficher seulement
	<select name="filter" style="width:auto">
		<option value="1" selected="">Tout afficher</option>
		<option value="t.statut=0">En attente traitement</option>
		<!--<option value="t.statut=1">injoignable</option>-->
		<option value="t.statut=2">Basculé en contrôle</option>
		<option value="t.statut=3">Contrôlé (supprimé)</option>
	</select>
	<input name="" type="submit" value="OK">
</form>
';
?>
<?php $this->widget('TableWidget', array(
        'caption' => 'PRIVILÈGE VENDU À CONTROLER',
		'headers' => array('Ref. annonce','Statut','Date insertion','Acquéreur(s)','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_vendu_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces en cours de traitement',
)); ?>