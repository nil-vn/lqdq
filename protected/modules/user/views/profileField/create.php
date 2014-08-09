<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t('Create'),
);
?>
<ul class="breadcrumb" id="breadcrumb">
	<li><span class="badge badge-success"><strong><?php echo UserModule::t('Create Profile Field'); ?></strong></span></li>
	<li><span class=""> - <strong><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></strong></span></li>
</ul>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>