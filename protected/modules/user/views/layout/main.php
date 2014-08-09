<?php $this->beginContent($this->module->appLayout); ?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner top-nav">
    <div class="container">
      <div class="branding">
        <div class="logo"> <a href="<?php echo PIUrl::createUrl('/');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo_immobilierfr.gif" style="width:80px;height:24px;margin-top: 8px;" alt="Logo"></a> </div>
      </div>
      <?php $this->renderPartial('//common/user_login');?>
      <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <div class="nav-collapse collapse">
		<?php
			$currentController = strtolower(Yii::app()->controller->id);
			$currenAction = strtolower(Yii::app()->controller->action->id);
			if($currentController == 'default' ){
				if(UserModule::isAdmin()) {
					$this->widget('zii.widgets.CMenu', array(
						'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							 array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
						)
					));
				}
			}elseif($currentController == 'admin' && $currenAction == 'admin'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
							array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
							array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
							//array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
						)
				));
			}elseif($currentController == 'admin' && $currenAction == 'create'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
							array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
							//array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
						)
				));
			}elseif($currentController == 'admin' && $currenAction == 'update'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
						    //array('label'=>UserModule::t('View User'), 'url'=>array('view','id'=>$model->id)),
						    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
						    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
						)
				));
			}elseif($currentController == 'admin' && $currenAction == 'view'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
						    //array('label'=>UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id)),
						    //array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
						    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
						    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
						)
				));
			}elseif($currentController == 'profilefield' && $currenAction == 'admin'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
						    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
						)
				));
			}elseif($currentController == 'profilefield' && $currenAction == 'update'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
						    //array('label'=>UserModule::t('View Profile Field'), 'url'=>array('view','id'=>$model->id)),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
						    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
						)
				));
			}elseif($currentController == 'profilefield' && $currenAction == 'create'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
    						array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
						)
				));
			}elseif($currentController == 'profilefield' && $currenAction == 'view'){
				$this->widget('zii.widgets.CMenu', array(
					'firstItemCssClass'=>'first',
						'lastItemCssClass'=>'last',
						'htmlOptions'=>array('class'=>'actions nav'),
						'items'=>array(
							array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('create')),
						    //array('label'=>UserModule::t('Update Profile Field'), 'url'=>array('update','id'=>$model->id)),
						    //array('label'=>UserModule::t('Delete Profile Field'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>1),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
						    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('admin')),
						    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
						)
				));
			}
		?>
      </div>
    </div>
  </div>
</div>
<div id="main-content">
	<div class="container">
		<?php echo $content; ?>	
	</div>
</div>
<?php $this->endContent(); ?>