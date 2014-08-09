<?php
	if($validateEmail == null){
		$status = '<span class="label label-important">A VERIF</span>';
	}elseif($validateEmail->isvalide == 1){
		$status = '<span class="label label-success">OK</span>';
	}elseif($validateEmail->isvalide == 0){
		$status = '<span class="label label-important">BAD</span>';
	}
?>
<div class="tooltip-demo well immobilier-box-google">
	<?php echo $status;?>
	<?php if($validateEmail === null):?>
	<button type="button" uuid="<?php echo $model->user->ID;?>" rel="1" class="btn btn-small btn-success btn-setvalidate">VALIDE</button>
	<button type="button" uuid="<?php echo $model->user->ID;?>" rel="0" class="btn btn-small btn-danger btn-setvalidate">BAD</button>
	<button type="button" uuid="<?php echo $model->user->ID;?>" rel="0" class="btn btn-small btn-inverse btn-setvalidate">BlackList</button>
	<?php else:?>
		<button type="button" uuid="<?php echo $model->user->ID;?>" rel="99" class="btn btn-small btn-danger btn-setvalidate">MODIFIER</button>
		<span class="time"><?php echo date(Yii::app()->params['datetime'],strtotime($validateEmail->date));?></span>
	<?php endif;?>
	<?php $url = "https://www.google.fr/search?q=%22".trim($model->user->user_email)."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
	<a target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/google.gif"/></a>
</div>