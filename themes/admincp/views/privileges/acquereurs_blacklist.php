<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$total = $this->getClientWaitControl();
?>
<?php
$filter = '
<form class="filter" name="form" method="get" action="">
	Rechercher: 
	<input  name="id" type="text">
	&nbsp;
	Afficher seulement
	<select name="filter">
		<option value="controle=0 and valide=0">En attente de contrôle</option>
		<option value="controle=1 and valide=1">Acquereur blacklisté</option>
		<option value="controle=1 and valide=2">Acquereur whitelisté</option>
	</select>
	<input name="" type="submit" value="OK">
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'BLACKLIST CLIENT ACQUEREUR',
		'headers' => array('Ref. annonce','Nom','telephone','portable','e-mail','Date insertion','type de client','commentaire','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/acquereurs_blacklist_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'acquereurs en attente de controle',
		'total'=>$total,
)); 
?>