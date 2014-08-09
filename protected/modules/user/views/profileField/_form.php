<style>.help-block.error, span.required, .errorMessage{color:red}</style>
<div class="form">
<p class="note"></p>

<?php echo CHtml::beginForm('','post',array('class'=>'well form-horizontal ')); ?>
	<?php //echo CHtml::errorSummary($model); ?>
	
	<div class=" varname control-group">
		<?php echo CHtml::activeLabelEx($model,'varname',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo (($model->id)?CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50,'readonly'=>true)):CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50))); ?>
		<?php echo CHtml::error($model,'varname'); ?>
		<p class="hint"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>
		</div>
	</div>

	<div class=" title control-group">
		<?php echo CHtml::activeLabelEx($model,'title',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'title'); ?>
		<p class="hint"><?php echo UserModule::t('Field name on the language of "sourceLanguage".'); ?></p>
		</div>
	</div>

	<div class=" field_type control-group">
		<?php echo CHtml::activeLabelEx($model,'field_type',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_type',array('size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')):CHtml::activeDropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('id'=>'field_type'))); ?>
		<?php echo CHtml::error($model,'field_type'); ?>
		<p class="hint"><?php echo UserModule::t('Field type column in the database.'); ?></p>
		</div>
	</div>

	<div class=" field_size control-group">
		<?php echo CHtml::activeLabelEx($model,'field_size',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_size',array('readonly'=>true)):CHtml::activeTextField($model,'field_size')); ?>
		<?php echo CHtml::error($model,'field_size'); ?>
		<p class="hint"><?php echo UserModule::t('Field size column in the database.'); ?></p>
		</div>
	</div>

	<div class=" field_size_min control-group">
		<?php echo CHtml::activeLabelEx($model,'field_size_min',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'field_size_min'); ?>
		<?php echo CHtml::error($model,'field_size_min'); ?>
		<p class="hint"><?php echo UserModule::t('The minimum value of the field (form validator).'); ?></p>
		</div>
	</div>

	<div class=" required control-group">
		<?php echo CHtml::activeLabelEx($model,'required',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeDropDownList($model,'required',ProfileField::itemAlias('required')); ?>
		<?php echo CHtml::error($model,'required'); ?>
		<p class="hint"><?php echo UserModule::t('Required field (form validator).'); ?></p>
		</div>
	</div>

	<div class=" match control-group">
		<?php echo CHtml::activeLabelEx($model,'match',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'match'); ?>
		<p class="hint"><?php echo UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."); ?></p>
		</div>
	</div>

	<div class=" range control-group">
		<?php echo CHtml::activeLabelEx($model,'range',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'range',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo CHtml::error($model,'range'); ?>
		<p class="hint"><?php echo UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'); ?></p>
		</div>
	</div>

	<div class=" error_message control-group">
		<?php echo CHtml::activeLabelEx($model,'error_message',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'error_message'); ?>
		<p class="hint"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>
		</div>
	</div>

	<div class=" other_validator control-group">
		<?php echo CHtml::activeLabelEx($model,'other_validator',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'other_validator',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'other_validator'); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))); ?></p>
		</div>
	</div>

	<div class=" default control-group">
		<?php echo CHtml::activeLabelEx($model,'default',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo (($model->id)?CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true)):CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255))); ?>
		<?php echo CHtml::error($model,'default'); ?>
		<p class="hint"><?php echo UserModule::t('The value of the default field (database).'); ?></p>
		</div>
	</div>

	<div class=" widget control-group">
		<?php echo CHtml::activeLabelEx($model,'widget',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php 
		list($widgetsList) = ProfileFieldController::getWidgets($model->field_type);
		echo CHtml::activeDropDownList($model,'widget',$widgetsList,array('id'=>'widgetlist'));
		//echo CHtml::activeTextField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'widget'); ?>
		<p class="hint"><?php echo UserModule::t('Widget name.'); ?></p>
		</div>
	</div>

	<div class=" widgetparams control-group">
		<?php echo CHtml::activeLabelEx($model,'widgetparams',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'id'=>'widgetparams')); ?>
		<?php echo CHtml::error($model,'widgetparams'); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))); ?></p>
		</div>
	</div>

	<div class=" position control-group">
		<?php echo CHtml::activeLabelEx($model,'position',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeTextField($model,'position'); ?>
		<?php echo CHtml::error($model,'position'); ?>
		<p class="hint"><?php echo UserModule::t('Display order of fields.'); ?></p>
		</div>
	</div>

	<div class=" visible control-group">
		<?php echo CHtml::activeLabelEx($model,'visible',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo CHtml::activeDropDownList($model,'visible',ProfileField::itemAlias('visible')); ?>
		<?php echo CHtml::error($model,'visible'); ?>
		</div>
	</div>

	<div class=" buttons control-group">
		<div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'btn')); ?>
		</div>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
<div id="dialog-form" title="<?php echo UserModule::t('Widget parametrs'); ?>">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="value">Value</label>
		<input type="text" name="value" id="value" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>