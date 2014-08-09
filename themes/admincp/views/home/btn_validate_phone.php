<div class="tooltip-demo well immobilier-box-google">
<?php $phoneNumber = trim($phoneNumber); $phoneNumber = str_replace('.','',$phoneNumber); $phoneNumber = ltrim($phoneNumber,'0'); $phoneNumber = trim($phoneNumber);?>
<?php if(strlen($phoneNumber) != 9 ):?>
	<span style="color:red">FORMAT INCORRECTE <?php echo strlen($phoneNumber);?></span>
<?php else:?>
	<?php
		if($phone == null){
			$status = '<span class="label label-important">A VERIFIER</span>';
		}elseif($phone->isvalide == 1){
			$status = '<span class="label label-success">OK</span>';
		}elseif($phone->isvalide == 0){
			$status = '<span class="label label-important">BAD</span>';
		}
	?>
	<?php echo $status;?>
	<?php if($phone === null):?>
		<button valtype="<?php echo $type;?>" type="button" uuid="<?php echo $model->user->ID;?>" rel="1" class="btn btn-small btn-success btn-validate-phone">VALIDE</button>
		<button valtype="<?php echo $type;?>" type="button" uuid="<?php echo $model->user->ID;?>" rel="0" class="btn btn-small btn-danger btn-validate-phone">INCORRECTE</button>
	<?php else:?>
		<button valtype="<?php echo $type;?>" type="button" uuid="<?php echo $model->user->ID;?>" rel="99" class="btn btn-small btn-danger btn-validate-phone">MODIFIER</button>
		<span class="time"><?php echo date(Yii::app()->params['datetime'],strtotime($phone->date));?></span>
	<?php endif;?>
	<?php if(Yii::app()->controller->id !== 'module'):?>
		<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$phoneNumber)."%22+OR+%22".str_replace('.','-',$phoneNumber)."%22+OR+%22".$phoneNumber."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
		<a target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/google.gif"/></a>
	<?php endif;?>
<?php endif;?>
</div>