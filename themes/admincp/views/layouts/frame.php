<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/styles.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/library/css/alertify.core.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/library/css/alertify.default.css" rel="stylesheet">
<style>html,body{padding:0;margin:0;}</style>
<script>var webroot = '<?php echo PIUrl::createUrl("/");?>'; var themeUrl = '<?php echo Yii::app()->theme->baseUrl;?>';</script>
</head>
<body>
	<?php echo $content;?>
</body>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/library/alertify.min.js"></script>
</html>