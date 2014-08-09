<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
	$total = $this->countClientValid();
?>
<?php
$filter ='<form class="filter" name="form" method="get" action="">
				Reference annonce:
				<input name="id" type="text" maxlength="9">
				&nbsp;
				Classer par
				<select name="order">
				  <option value="post_property_id ASC">Référence annonce croissant</option>
				  <option value="post_property_id DESC">Référence annonce décroissant</option>
				  <option value="creation_date DESC">Date décroissante</option>
				  <option value="creation_date ASC">Date croissante</option>
				</select>
				&nbsp;
				Afficher
				<select name="filter">
					<option value="1=1">Tout</option>
					<option value="etape=2 and (datediff(now(),rappel_date)>=0 OR rappel_date is null)">e-mail</option>
					<option value="etape=3 and (datediff(now(),rappel_date)>=0 OR rappel_date is null)">courrier simple</option>
					<option value="etape=4 and (datediff(now(),rappel_date)>=0 OR rappel_date is null)">courrier recommandé</option>
					<option value="etape=5 and (datediff(now(),rappel_date)>=0 OR rappel_date is null)">Avocat</option>							
				</select>
				<input name="" type="submit" value="OK">
			</form>';
?>
<?php $this->widget('TableWidget', array(
        'caption' => 'Privil&egrave;ge encours de contr&ocirc;le',
		'headers' => array('Ref. annonce','Statut','Date insertion','Acqu&eacute;reur(s)','Suppression'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_controle_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces',
		'total'=>$total,
)); ?>