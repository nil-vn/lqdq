<div class="wide form" style="margin-top:10px">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
	'htmlOptions'=>array('class'=>'form-horizontal well'),
)); ?>

    <div class="control-group">
        <?php echo $form->label($model,'id',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'id'); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'varname',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'title',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'field_type',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->dropDownList($model,'field_type',ProfileField::itemAlias('field_type')); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'field_size',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'field_size'); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'field_size_min',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'field_size_min'); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'required',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->dropDownList($model,'required',ProfileField::itemAlias('required')); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'match',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'range',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'error_message',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'other_validator',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'other_validator',array('size'=>60,'maxlength'=>5000)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'default',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'widget',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'widgetparams',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'widgetparams',array('size'=>60,'maxlength'=>5000)); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'position',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->textField($model,'position'); ?>
    	</div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'visible',array('class'=>'control-label')); ?>
		<div class="controls">
        <?php echo $form->dropDownList($model,'visible',ProfileField::itemAlias('visible')); ?>
    	</div>
    </div>

    <div class="row buttons">
		<div class="controls">
        <?php echo CHtml::submitButton(UserModule::t('Search'),array('class'=>'btn')); ?>
    	</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form --> 