<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter ='
<form class="filter" name="form" method="get" action="">
	Reference annonce:
	<input name="id" type="text" maxlength="9">
	Classer par
	<select name="order">
		<option value="id ASC">Référence annonce croissant</option>
		<option value="id DESC">Référence annonce décroissant</option>
	</select>						
	<input name="" type="submit" value="OK">
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'Controle descriptif annonce privilege',
		'headers' => array('Ref. annonce','Type annonce','Statut','Date annonce','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/controle_descriptif_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonce(s)',
)); 
?>