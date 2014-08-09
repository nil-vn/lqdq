<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);
?>
<ul class="breadcrumb" id="breadcrumb">
	<li><span class="badge badge-success"><strong><?php echo  UserModule::t('Update User')." (".$model->username; ?>)</strong></span></li>
	<li><span class=""> - <strong><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></strong></span></li>
</ul>

<?php
	$this->renderPartial('_form', array('model'=>$model,'profile'=>$profile,'allRoles'=>$allRoles,'userCurrenRole'=>$userCurrenRole));
?>