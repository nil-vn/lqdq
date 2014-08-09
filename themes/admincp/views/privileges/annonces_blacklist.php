<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter ='
<form class="filter" name="form" method="get" action="">
	Rechercher une reference:
	<input name="id" type="text">
	&nbsp;
	Afficher seulement
	<select name="filter">
		<option value="status=0">Annonce en attente de contrôle</option>
		<option value="status=1">Annonce blacklistée</option>
		<option value="status=2">Annonce whitelistée</option>
		<option value="status=3">Annonce supprimée</option>
	</select>
	<input name="" type="submit" value="OK">				
	<br>
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'Blacklist client vendeur',
		'headers' => array('Reference','Date insertion','Type de client','Commentaire','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/annonces_blacklist_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonce(s)',
)); 
?>