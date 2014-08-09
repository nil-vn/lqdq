<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" name="form" method="get" action="">
	<span>
	Reference annonce: 
	<input name="id" type="text" maxlength="9">
	Classer par
	<select name="order">
		<option value="post_property_id ASC">Référence annonce croissant</option>
		<option value="post_property_id DESC">Référence annonce décroissant</option>
		<option value="date_insertion DESC">Date décroissante</option>
		<option value="date_insertion ASC">Date croissante</option>
	</select>
	Afficher seulement
	<select name="filter">
		<option value="1">Tout afficher</option>
		<option value="`t`.`status`=0">En attente traitement</option>
		<option value="`t`.`status`=3">Contrôlé (supprimé)</option>
	</select>
	<input name="" type="submit" value="OK">
	<br/><br/>
	<span style="display:inline-block">
		<label style="float:left">
			<input type="radio" name="payment_type" value="(postProperty.payment_id = 2 or postProperty.payment_id = 3 or postProperty.payment_id = 4)">
			Premium / Privilège
		</label>
		
		<label style="float:left">
			<input type="radio" name="payment_type" value="(postProperty.payment_id = 7)">
			Découverte
		</label>
		<div style="clear:both"></div>
	</span>
	</span>
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'CONFORME / NON CONFORME',
		'headers' => array('Ref. annonce','Type annonce','Statut','Date insertion','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/annonce_controle_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=> 'annonce(s)', 
));
?>