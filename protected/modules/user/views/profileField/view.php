<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t($model->title),
);
?>
<ul class="breadcrumb" id="breadcrumb">
	<li><span class="badge badge-success"><strong><?php echo UserModule::t('View Profile Field #').$model->varname; ?></strong></span></li>
</ul>
<a href="<?php echo PIUrl::createUrl('/user/profileField/update',array('id'=>$model->id));?>" class="btn"><?php echo UserModule::t('Update Profile Field');?></a>
<?php echo CHtml::link(UserModule::t('Delete Profile Field'),"#", array("class"=>"btn","submit"=>array('delete', 'id'=>$model->id), 'confirm' => UserModule::t('Are you sure to delete this item?'))); ?>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'htmlOptions'=>array('style'=>'margin-top:10px'),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'varname',
		'title',
		'field_type',
		'field_size',
		'field_size_min',
		'required',
		'match',
		'range',
		'error_message',
		'other_validator',
		'widget',
		'widgetparams',
		'default',
		'position',
		'visible',
	),
)); ?>
