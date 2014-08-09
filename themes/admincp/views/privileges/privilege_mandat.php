<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" name="form" method="get" action="">
	Reference annonce: 
	<input name="id" type="text" maxlength="9">
	Classer par
	<select class="form-control" name="order">
		<option value="date_signature ASC">Date signature croissante</option>
		<option value="date_signature DESC">Date signature décroissante</option>
		<option value="post_property_id ASC">Référence annonce croissant</option>
		<option value="post_property_id DESC">Référence annonce décroissant</option>
		<option value="id ASC">N°mandat croissant</option>
		<option value="id DESC">N°mandat décroissant</option>
	</select>
	<!--Afficher seulement -->
	<select class="form-control" name="filter">
		<option value="1">Tout afficher</option>
		<option value="desactive=0 and is_online=1">En ligne</option>
		<option value="desactive=1 and is_online=0">Hors ligne</option>
	</select>
	<input name="" type="submit" value="OK">			
</form>
';
?>
<?php $this->widget('TableWidget', array(
	'caption' => 'Mandats Privilège',
	'headers' => array('N°Mandat','Ref. annonce','Nom','Adresse du bien','Prix','Date signature'),
	'filter'=>$filter,
	'model' => $model,
	'row' => 'code/privilege_mandat_row',
	'item_count'=>$item_count,
	'page_size'=>PAGE_SIZE,
	'pages'=>$pages,
	'select'=>$select,
	'resultCaption'=>'mandats',
	)); 
?>