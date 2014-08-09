<?php $this->beginContent(Rights::module()->appLayout); ?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner top-nav">
    <div class="container">
      <div class="branding">
        <div class="logo"> <a href="<?php echo PIUrl::createUrl('/');?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo_immobilierfr.gif" style="width:80px;height:24px;margin-top: 8px;" alt="Logo"></a> </div>
      </div>
      <?php $this->renderPartial('//common/user_login');?>
      <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <div class="nav-collapse collapse">
	  
		<?php if( $this->id!=='install' ): ?>
			<?php $this->renderPartial('/_menu'); ?>
		<?php endif; ?>
		
      </div>
    </div>
  </div>
</div>
<div id="main-content">
	<div class="container">
		<?php $this->renderPartial('/_flash'); ?>
		<?php echo $content; ?>	
	</div>
</div>
<?php $this->endContent(); ?>