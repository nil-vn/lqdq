<div class="tooltip-demo well well-acq immobilier-box-google">
<?php
	$phoneNumber = trim($phoneNumber); $phoneNumber = str_replace('.','',$phoneNumber);
	$numberPhone = $phoneNumber;
	$phoneNumber = ltrim($phoneNumber,'0');
?>
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
		<button valtype="<?php echo $type;?>" type="button" phone="<?php echo $numberPhone;?>" rel="1" class="btn btn-small btn-success btn-validate-phone-acq">VALIDE</button>
		<button valtype="<?php echo $type;?>" type="button" phone="<?php echo $numberPhone;?>" rel="0" class="btn btn-small btn-danger btn-validate-phone-acq">INCORRECTE</button>
	<?php else:?>
		<button valtype="<?php echo $type;?>" type="button" phone="<?php echo $numberPhone;?>" rel="99" class="btn btn-small btn-danger btn-validate-phone-acq">MODIFIER</button>
		<span class="time"><?php echo date(Yii::app()->params['datetime'],strtotime($phone->date));?></span>
	<?php endif;?>
<?php endif;?>
</div>