<!DOCTYPE HTML>
<html lang="en">
<head>
<?php $this->renderPartial('//common/header');?>
	<script language="javascript">
	function ouvre_fenetre(url, rappel_client,largeur,hauteur)
	{
	    window.open(url, rappel_client, 'status=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizeable=yes,copyhistory=no,width='+largeur+',height='+hauteur);
	}
	</script>
</head>
<body style="margin:0px auto;background-color:#f9f9f9!important">
<div id="main-content">
  <div class="container" style="width:1027px;margin:-50px auto !important;">
	<?php echo $content;?>
  </div>
</div>
<?php $this->renderPartial('//common/footer');?>
</body>
</html>