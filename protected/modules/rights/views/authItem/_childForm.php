<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>
	
	<div class="control-group">
		<div class="controls">
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
		<?php echo $form->error($model, 'itemname'); ?>
		<div class="controls">
	</div>
	
	<div class="control-group buttons">
		<div class="controls">
		<?php echo CHtml::submitButton(Rights::t('core', 'Add'),array('class'=>'btn')); ?>
		<div class="controls">
	</div>

<?php $this->endWidget(); ?>

</div>