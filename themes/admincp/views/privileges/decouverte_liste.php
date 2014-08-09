<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<?php $this->widget('TableWidget', array(
        'caption' => 'DÉCOUVERTE LISTE',
		'headers' => array('Id annonce','Type mandat','Date Insc','Date Desinscription','Commentaire Desinscription','Valide','Nom','Tel'),
		// 'filter'=>'code/privilege_avoir_filter',
		'isView'=>true,
		'model' => $model,
		'row' => 'code/decouverte_liste_row',
		'item_count'=>$pages->itemCount,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		// 'select'=>$select,
		'resultCaption'=> 'decouverte',
)); ?>
