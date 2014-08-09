<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" name="form" method="get" action="">
	Reference annonce: 
	<input name="id" type="text" maxlength="9">
	Classer par
	<select name="order">
		<option value="id ASC">Référence annonce croissant</option>
		<option value="id DESC">Référence annonce décroissant</option>
		<option value="created DESC">Date décroissante</option>
		<option value="created ASC">Date croissante</option>
	</select>
	<button type="submit" class="btn btn-default">OK</button>
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'CONTROLE ANNONCE HORS LIGNE (DIFFEREE)',
		'headers' => array('Ref. annonce','Type annonce','Statut','Date insertion','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/annonce_controle_horsligne_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces en cours de traitement',
)); 