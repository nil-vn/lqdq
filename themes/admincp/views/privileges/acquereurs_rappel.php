<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>

<?php $this->widget('TableWidget', array(
        'caption' => 'RAPPEL CLIENTS ACQUEREURS',
		'headers' => array('Ref. annonce','Nom acquereur','Tel acqu.','Nom vendeur','Tel vend.','Date rappel','Actions'),
		'model' => $model,
		'row' => 'code/acquereurs_rappel_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'acquereurs en attente de rappel',
)); ?>