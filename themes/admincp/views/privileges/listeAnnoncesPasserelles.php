<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" action="" name="filters" id="filters">
    SL: <input type="checkbox" name="SL" value="1">
    PV: <input type="checkbox" name="PV" value="1">
    LBC: <input type="checkbox" name="LBC" value="1">
    Ids: <input type="text" name="ids" value="ex: 142647,142698" onfocus="if (this.value == \'ex: 142647,142698\')
                this.value = \'\'">
    <select name="forcee">
        <option value="0">Toute</option>
        <option value="1">DIFFUSION FORCEE</option>
        <!--<option value="2" >DIFFUSION INTERDITE</option></select>-->
    </select>
    <input type="submit" class="btn" value="Actualiser">
</form>
';

	if (Yii::app()->session['asc']==1) {
		$asc = 0;
		$img = '<img src="'.Yii::app()->theme->baseUrl.'/img/privilege/sort_asc.png"/>';
	} else {
		$asc = 1;
		$img = '<img src="'.Yii::app()->theme->baseUrl.'/img/privilege/sort_desc.png"/>';
	}
	if (Yii::app()->session['order'] ==1 ) {
		$headers[0]='<a href="?order=1&asc='.$asc.'">Diff '.$img.'</a>';
	} else {
		$headers[0]='<a href="?order=1&asc=1">Diff</a>';
	}
	$headers[1]='Commentaire';
	if (Yii::app()->session['order'] == 2 ) {
		$headers[2]='<a href="?order=2&asc='.$asc.'">Ref. annonce '.$img.'</a>';
	} else {
		$headers[2]='<a href="?order=2&asc=1">Ref. annonce</a>';
	}	
	$headers[3]='Nom';
	$headers[4]='Adresses du bien';
	if (Yii::app()->session['order'] == 3 ) {
		$headers[5]='<a href="?order=3&asc='.$asc.'">Prix '.$img.'</a>';
	} else {
		$headers[5]='<a href="?order=3&asc=1">Prix</a>';
	}
	if (Yii::app()->session['order'] == 4 ) {
		$headers[6]='<a href="?order=4&asc='.$asc.'">Date MAJ '.$img.'</a>';
	} else {
		$headers[6]='<a href="?order=4&asc=1">Date MAJ</a>';
	}
	if (Yii::app()->session['order'] ==5 ) {
		$headers[7]='<a href="?order=5&asc='.$asc.'">Date Depot '.$img.'</a>';
	} else {
		$headers[7]='<a href="?order=5&asc=1">Date Depot</a>';
	}
?>
<?php $this->widget('TableWidget', array(
        'caption' => 'Annonces diffusées sur les passerelles',
		'headers' => $headers,
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/listeAnnoncesPasserelles_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces',
)); ?>