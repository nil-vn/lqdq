<div class="wide form" style="margin-top:10px">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>
<fieldset>
	<div class="control-group">
	        <?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
			<div class="controls">
	        <?php echo $form->textField($model,'id'); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'username',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'activkey',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'create_at',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->textField($model,'create_at'); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'lastvisit_at',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->textField($model,'lastvisit_at'); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'superuser',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus')); ?>
			</div>
	</div>
	
	<div class="control-group">
	        <?php echo $form->label($model,'status',array('class'=>'control-label')); ?>
			<div class="controls">
	         <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus')); ?>
			</div>
	</div>
	
	<div class="control-group">
			<div class="controls">
	         <?php echo CHtml::submitButton(UserModule::t('Search'),array('class'=>'btn')); ?>
			</div>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->