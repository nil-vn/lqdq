<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php $this->renderPartial('//common/header'); ?>
    </head>
    <body <?php if (Yii::app()->controller->action->id == 'error') echo "id='error404'"; ?>>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner top-nav">
                <div class="container">
                    <div class="branding">
                        <div class="logo"> <a href="<?php echo PIUrl::createUrl('/'); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo_immobilierfr.gif" style="width:80px;height:24px;margin-top: 8px;" alt="Logo"></a> </div>
                    </div>
                    <?php $this->renderPartial('//common/user_login'); ?>
                    <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <div class="nav-collapse collapse">

                        <ul class="nav">
                            <li class="dropdown"><a href="<?php echo PIUrl::createUrl('privileges'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon list"></i> Tableaux</a></li>
                            <li class="dropdown"><a href="<?php echo PIUrl::createUrl('webmail'); ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="nav-icon cup"></i> Messagerie (<span id="countMessageUnread" style="color:white">...</span>)</a>
                            </li>
                            <li><a class="acquereursForm-modal-decauverte" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/module/decouverte'); ?>"><i class="nav-icon shuffle"></i> Découvertes(<span style="color:#fff" class="menuCountPropertyDecouverte">...</span>)</a></li>
                            <li><a class="menuCountAcq" href=""><i class="nav-icon user_comment"></i> Acq[New=<span style="color:#fff" class="menuCountAcqNew">...</span>;Alt=<span style="color:#fff" class="menuCountAcqAttente">...</span>]</a></li>
                            <?php if (Yii::app()->controller->id == 'home'): ?>
                                <li class=""><a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/home/acquereurs/?property_id=' . $this->property_id); ?>"><i class="nav-icon record"></i>Nouveau client</a></li>
                            <?php endif; ?>
                            <?php if (Yii::app()->user->checkAccess(null, array('admin'))): ?>
                                <li class=""><a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/module/configs'); ?>"><i class="nav-icon cog_3"></i>Configuration</a></li>
                            <?php endif; ?>
                            <?php if (Yii::app()->user->checkAccess(null, array('admin'))): ?>
                                <li class=""><a class="acquereursForm-modal"  href="<?php echo PIUrl::createUrl('/wpErrors/index'); ?>"><i class="nav-icon cog_3"></i>Errors</a></li>
                            <?php endif; ?>
                            <li class=""><a class="acquereursForm-modal" data-fancybox-type="iframe" href="<?php echo PIUrl::createUrl('/module/stats'); ?>"><i class="nav-icon cog_3"></i>Stats</a></li>
                        </ul>


                    </div>
                </div>
            </div>
        </div>
        <div id="main-content">
            <div class="container">
                <?php echo $content; ?>
            </div>
        </div>
        <?php $this->renderPartial('//common/footer'); ?>
    </body>
</html>