<meta charset="utf-8">
<title><?php echo $this->pageTitle;?>e</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $this->description;?>">
<meta name="author" content="GreenGlobal">
<!-- styles -->
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/jquery.jqplot.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/prettify.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/elfinder.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/elfinder.theme.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/fullcalendar.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/js/plupupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/styles.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/icons-sprite.css" rel="stylesheet">
<link id="themes" href="<?php echo Yii::app()->theme->baseUrl;?>/css/themes.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/js/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/library/css/jquery.toastmessage.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/library/css/alertify.core.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/library/css/alertify.default.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/common.css" rel="stylesheet">
<script src="<?php echo Yii::app()->theme->baseUrl;?>/library/jquery.toastmessage.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/library/alertify.min.js"></script>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/ie/ie9.css" />
<![endif]-->
<!--fav and touch icons -->
<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->theme->baseUrl;?>/ico/apple-touch-icon-57-precomposed.png">
<?php
	$mesAlertErr = Yii::app()->user->hasFlash('error') == true ? Yii::app()->user->getFlash('error') : '';
	$mesAlertSuc = Yii::app()->user->hasFlash('success') == true ? Yii::app()->user->getFlash('success') : '';
	$tab2 = Yii::app()->user->hasFlash('tab2') == true ? Yii::app()->user->getFlash('tab2') : '';
?>
<script>
	var webroot = '<?php echo PIUrl::createUrl("/");?>';
	var themeUrl = '<?php echo Yii::app()->theme->baseUrl;?>';
	var mesAlertErr = "<?php echo $mesAlertErr;?>";
	var mesAlertSuc = "<?php echo $mesAlertSuc;?>";
	var tab2 = "<?php echo $tab2?>";
	$(document).ready(function(){
		if(mesAlertErr != '')
			message('log',mesAlertErr,8000);
		if(mesAlertSuc != '')
			message('log',mesAlertSuc,8000);
		if(tab2 != '')
		{
			setTimeout(function(){
				$("a[href='#tab2']").click();
			},500);
		}
	});
</script>