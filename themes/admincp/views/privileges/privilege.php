<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/exportCSV.js"></script>
<div style="text-align:center">
    <span>
        <a href="<?php echo PIUrl::createUrl('privileges/premium');?>"><button id="premium" type="button" class="btn btn-default">premium</button></a>
        <a href="<?php echo PIUrl::createUrl('privileges/privilege');?>"><button id="privilege" type="button" class="btn btn-default">privilege</button></a>
        <a href="<?php echo PIUrl::createUrl('privileges/privilege_avoir');?>"><button id="privilegeAvoir" type="button" class="btn btn-default">privilegeAvoir</button></a>
    </span>
</div><!-- End demo -->
<?php $this->widget('TableWidget', array(
        'caption' => 'FACTURES PRIVILEGE [ REGISTRE REPERTOIRE DE LA LOI DU 2 JANVIER 1970 ]',
		'headers' => array('N° facture','Réf. annonce','N° mandat','Date signature','Honoraires TTC','Avoir restant','Gestion facture'),
		'filter'=>'code/privilege_filter',
		'isView'=>true,
		'model' => $model,
		'row' => 'code/privilege_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'factures',
)); ?>