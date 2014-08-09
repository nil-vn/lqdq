<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<h3>Top 100 erreur 500:</h3><br/>
<?php $this->widget('TableWidget', array(
		'headers' => array('date','#','path','#','err_msg','URL','referer','ip','UA','postGet'),
		'model' => $model500,
		'row' => 'code/erreur_liste_row500',
		'select'=>$select500,
));?>
<h3>Top 100 erreur 404:</h3><br/>
<?php $this->widget('TableWidget', array(
		'headers' => array('date','#','err_msg','#','path','UA','postGet','URL','referer'),
		'model' => $model404,
		'row' => 'code/erreur_liste_row404',
		'select'=>$select404,
));?>