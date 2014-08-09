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
        'caption' => 'AVOIRS PRIVILEGE',
		'headers' => array('N° Avoir','N° Facture','Ref. annonce','Date','Montant TTC','Client'),
		'filter'=>'code/privilege_avoir_filter',
		'isView'=>true,
		'model' => $model,
		'row' => 'code/privilege_avoir_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=> 'factures',
)); ?>