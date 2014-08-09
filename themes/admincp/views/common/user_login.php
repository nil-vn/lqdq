<ul class="nav pull-right" id="box-user-login-immo">
    <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">User <span class="badge badge-success user-count-user-online">...</span><i class="white-icons admin_user"></i><b class="caret"></b></a>
      <ul class="dropdown-menu user-list-user">
		
        <!--<li><a href="#"><i class="icon-cog"></i> Account Settings</a></li>-->
		
		<?php if(Yii::app()->user->checkAccess(null,array('admin'))):?>
        	<li><a href="<?php echo PIUrl::createUrl('/rights'); ?>"><i class="icon-cog"></i> Permissions Account</a></li>
        	<li><a href="<?php echo PIUrl::createUrl('/user'); ?>"><i class="icon-cog"></i> Account Manager</a></li>
		<?php endif;?>
		
        <li class="divider"></li>
        <li><a href="<?php echo PIUrl::createUrl('/user/logout'); ?>"><i class="icon-off"></i><strong> Logout</strong> (<?php echo Yii::app()->user->name;?>)</a></li>
      </ul>
    </li>
  </ul>