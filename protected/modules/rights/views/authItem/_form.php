<style>.help-block.error, span.required{color:red}</style>
<div class="form first">

<?php if( $model->scenario==='update' ): ?>
	<div class="nonboxy-widget">
	<div class="widget-head">
		<h5><?php echo Rights::getAuthItemTypeName($model->type); ?></h5>
	</div>
	</div>
<?php endif; ?>
	
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'htmlOptions' => array('class'=>'form-horizontal well')
)); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'name',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'name'); ?>
		<p class="hint"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></p>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'description',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model, 'description', array('maxlength'=>255, 'class'=>'text-field')); ?>
		<?php echo $form->error($model, 'description'); ?>
		<p class="hint"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></p>
		</div>
	</div>

	<?php if( Rights::module()->enableBizRule===true ): ?>

		<div class="control-group">
			<?php echo $form->labelEx($model, 'bizRule',array('class'=>'control-label')); ?>
			<div class="controls">
			<?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'text-field')); ?>
			<?php echo $form->error($model, 'bizRule'); ?>
			<p class="hint"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></p>
			</div>
		</div>

	<?php endif; ?>

	<?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

		<div class="control-group">
			<?php echo $form->labelEx($model, 'data',array('class'=>'control-label')); ?>
			<div class="controls">
			<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text-field')); ?>
			<?php echo $form->error($model, 'data'); ?>
			<p class="hint"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></p>
			</div>
		</div>

	<?php endif; ?>

	<div class="control-group buttons">
		<div class="controls">
		<?php echo CHtml::submitButton(Rights::t('core', 'Save'),array('class'=>'btn')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div>