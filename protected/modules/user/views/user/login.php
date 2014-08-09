<!DOCTYPE HTML>
<html lang="en">
    <head>
        <?php $this->renderPartial('//common/header'); ?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div class="branding">
                        <div class="logo">
                            <a href="<?php echo Yii::app()->baseUrl; ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo_immobilierfr.gif" style="margin-top:8px" width="80" height="24" alt="Logo"></a>
                        </div>
                    </div>
                    <ul class="nav pull-right">
                        <li><a href="<?php echo Yii::app()->request->hostInfo; ?>"><i class="icon-share-alt icon-white"></i> Go to Main Site</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-container">
            <div class="well-login">
                <?php echo CHtml::beginForm(); ?>
                <div class="control-group">
                    <div class="controls">
                        <div>
                            <?php echo CHtml::activeTextField($model, 'username', array('class' => 'login-input user-name', 'placeholder' => 'Username or Email')) ?>
                            <?php echo CHtml::error($model, 'username'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div>
                            <?php echo CHtml::activePasswordField($model, 'password', array('class' => 'login-input user-pass', 'placeholder' => 'Password')) ?>
                            <?php echo CHtml::error($model, 'password'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div>
                            <?php echo CHtml::activeTextField($model, 'verifyCode',array('class' => 'login-input user-name', 'placeholder' => 'Code de securite')); ?>
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo CHtml::error($model, 'verifyCode'); ?>
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <button class="btn btn-inverse login-btn" type="submit">Login</button>
                </div>
                <div class="remember-me">
                    <?php //echo CHtml::activeCheckBox($model, 'rememberMe', array('class' => 'rem_me')); ?>
                    <!--Remeber Me-->
                </div>
                <?php echo CHtml::endForm(); ?>
            </div>

            <?php //echo CHtml::link(Yii::t("UserModule.User", "Registration"),Yii::app()->getModule("user")->registrationUrl); ?>  <?php //echo CHtml::link(Yii::t("UserModule.user", "Lost Password?"),Yii::app()->getModule("user")->recoveryUrl); ?>

        </div>
        <?php $this->renderPartial('//common/footer'); ?>
    </body>
    <?php
    $form = new CForm(array(
        'elements' => array(
            'username' => array(
                'type' => 'text',
                'maxlength' => 32,
            ),
            'password' => array(
                'type' => 'password',
                'maxlength' => 32,
            ),
            'verifyCode' => array(
                'type' => 'text',
                'maxlength' => 32,
            ),
            'rememberMe' => array(
                'type' => 'checkbox',
            )
        ),
        'buttons' => array(
            'login' => array(
                'type' => 'submit',
                'label' => 'Login',
            ),
        ),
            ), $model);
    ?>
