<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>
<ul class="breadcrumb" id="breadcrumb">

	<li><span class="badge badge-success"><strong><?php echo Rights::t('core', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></strong></span></li>
	<li><span class=""> - <strong><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></strong></span></li>
</ul>
<div class="createAuthItem">

	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>

</div>