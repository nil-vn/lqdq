 <div class="flashes">

	<?php if( Yii::app()->user->hasFlash('RightsSuccess')===true ):?>

		<div class="alert alert-success fade in">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>Well done!</strong> <?php echo Yii::app()->user->getFlash('RightsSuccess'); ?>
		</div>

	<?php endif; ?>

	<?php if( Yii::app()->user->hasFlash('RightsError')===true ):?>

		<div class="alert alert-error fade in">
			<button data-dismiss="alert" class="close" type="button">×</button>
			<strong>Oh snap!</strong> <?php echo Yii::app()->user->getFlash('RightsError'); ?>
		</div>

	<?php endif; ?>

 </div>