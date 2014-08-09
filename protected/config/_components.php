<?php

//Nơi khai báo các components được sử dụng trong hệ thống.
return array(
    'user' => array(
        'class' => 'RWebUser',
        // enable cookie-based authentication
        'allowAutoLogin' => true,
        'loginUrl' => array('/user/login'),
    ),
    // uncomment the following to enable URLs in path-format
    'urlManager' => array(
        'urlFormat' => 'path',
        'showScriptName' => false,
        'rules' => require(dirname(__FILE__) . '/_routers.php'),
    ),
    'db' => array(
        'connectionString' => 'mysql:host=192.168.1.253;dbname=immobilier_test',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => 'dating123',
        'charset' => 'utf8',
        'enableProfiling' => true,
        'enableParamLogging' => true
    ),
    /* 'db'=>array(
      'connectionString' => 'mysql:host=localhost;dbname=immobilier_test',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
      ), */
    /* 'db'=>array(
      'connectionString' => 'mysql:host=mariadb-immobilier.jelastic.lunacloud.com;dbname=immo',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => 'pnyE7IX4zq',
      'charset' => 'utf8',
      ), */
    'mongodb' => array(
        'class' => 'EMongoDB',
        'connectionString' => 'mongodb://192.168.1.113',
        'dbName' => 'immobilier',
        'fsyncFlag' => true,
        'safeFlag' => true,
        'useCursor' => false
    ),
    'securityManager' => array(
        //'cryptAlgorithm' => 'rijndael-256',
        'encryptionKey' => '112121223423434534534534',
    ),
    /* 'mongodb' => array(
      'class'            => 'EMongoDB',
      'connectionString' => 'mongodb://localhost',
      'dbName'           => 'immobilier',
      'fsyncFlag'        => true,
      'safeFlag'         => true,
      'useCursor'        => false
      ), */
    'errorHandler' => array(
        // use 'site/error' action to display errors
        'errorAction' => 'home/error',
    ),
    'log' => array(
        'class' => 'CLogRouter',
        'routes' => array(
            /* array(
              'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
              'ipFilters'=>array('127.0.0.1','192.168.1.113'),
              ), */
            /* array(
              'class'=>'EMongoLogRoute',
              ), */
            // uncomment the following to show log messages on web pages

            /* array(
              'class'=>'CWebLogRoute',
              'showInFireBug'=>true
              ), */
            array(
                'class' => 'CFileLogRoute',
                'levels' => 'info, error, warning, vardump, notice', //trace
            )
        ),
    ),
    'bootstrap' => array(
        'class' => 'ext.bootstrap.components.Bootstrap',
        'responsiveCss' => true,
    ),
    'dynamicRes' => array(
        'class' => 'application.extensions.DynamicRes.DynamicRes',
        'urlConfig' => array(// Its fix Css, and convert Url to RealName 
            'baseUrl' => '/',
            'basePath' => dirname(__FILE__) . '/../../', // path of your site (ending with /) (No Change This)
            'debug' => true
        )
    ),
//    'mail' => array(
//        'class' => 'application.components.Mailer',
//        'transportType' => 'smtp', /// case sensitive!
//        'transportOptions' => array(
//            'host' => 'smtp.gmail.com',
//            'username' => 'orishop.biz@gmail.com',
//            'password' => 'muadonglanhgia',
//            'port' => '465',
//            'encryption' => 'ssl',
//        ),
    'mail' => array(
        'class' => 'application.components.Mailer',
        'transportType' => 'smtp', /// case sensitive!
        'transportOptions' => array(
            'host' => 'smtp.gmail.com',
            'username' => 'hoaithuongth89@gmail.com',
            'password' => 'hoaithuong89',
            'port' => '465',
            'encryption' => 'ssl',
        ),
        'viewPath' => 'application.views.mail',
        'logging' => true,
        'dryRun' => false
    ),
    'authManager' => array(
        'class' => 'RDbAuthManager',
        'connectionID' => 'db',
        'defaultRoles' => array('Authenticated', 'Guest'),
        'assignmentTable' => 'authassignment',
        'itemTable' => 'authitem',
        'itemChildTable' => 'authitemchild',
        'rightsTable' => 'rights'
    ),
    'cache' => array(
        'class' => 'CFileCache'
    ),
    'ePdf' => array(
        'class' => 'ext.yii-pdf.EYiiPdf',
        'params' => array(
            'mpdf' => array(
                'librarySourcePath' => 'application.vendors.mpdf',
                'constants' => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
            /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
              'mode'              => '', //  This parameter specifies the mode of the new document.
              'format'            => 'A4', // format A4, A5, ...
              'default_font_size' => 0, // Sets the default document font size in points (pt)
              'default_font'      => '', // Sets the default font-family for the new document.
              'mgl'               => 15, // margin_left. Sets the page margins for the new document.
              'mgr'               => 15, // margin_right
              'mgt'               => 16, // margin_top
              'mgb'               => 16, // margin_bottom
              'mgh'               => 9, // margin_header
              'mgf'               => 9, // margin_footer
              'orientation'       => 'P', // landscape or portrait orientation
              ) */
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf',
                'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
            /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
              'orientation' => 'P', // landscape or portrait orientation
              'format'      => 'A4', // format A4, A5, ...
              'language'    => 'en', // language: fr, en, it ...
              'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
              'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
              'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
              ) */
            )
        ),
    ),
);
/* End file _components.php */
/* Location: aplication.protected.config._components */