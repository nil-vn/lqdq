<ul class="breadcrumb" id="breadcrumb">
	<li><span class="badge badge-success"><strong><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></strong></span></li>
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	$model->username,
);

?>
<?php echo CHtml::link(UserModule::t('Update User'),array('update','id'=>$model->id), array("class"=>"btn","style"=>"margin-right:5px")); ?>
<?php echo CHtml::link(UserModule::t('Delete User'),"#", array("class"=>"btn","submit"=>array('delete','id'=>$model->id), 'confirm' => UserModule::t('Are you sure to delete this item?'))); ?>
<?php
 
	$attributes = array(
		'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		'password',
		'email',
		'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	
	$this->widget('bootstrap.widgets.TbDetailView', array(
		'htmlOptions'=>array('style'=>'margin-top:10px'),
		'data'=>$model,
		'attributes'=>$attributes,
	));
	

?>
