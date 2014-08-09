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
				<option value="1">Tout afficher</option>
				<option value="status=0">en attente</option>
				<option value="status=1">controlée</option>
			</select>
			<input name="" type="submit" value="OK">
		</form>';
?>
<?php $this->widget('TableWidget', array(
        'caption' => 'Privil&egrave;ge prise en main (à controler)',
		'headers' => array('Ref. annonce','Client','Statut','Date insertion','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_priseenmain_verifier_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonce(s)',
)); ?>