<style type="text/css">
<!--
.Style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #666666;
}
.Style3 {color: #FF0000}
.Style4 {color: #00CC00}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
//MM_reloadPage(true);
//-->
</script>
</head>
	<body>
	
	<div align="center" >
    
	<span class="Style1">
		<?php if($ret=1){ ?>
			<SPAN style="color:green">ENVOI DU CONTRAT REUSSI POUR L'ANNONCE REFERENCE</SPAN> <span class="Style3">BTK<?php echo $id; ?></span>
		<?php }else{ ?>
			<font color="red">ERREUR D'ENVOI DU CONTRAT POUR L'ANNONCE REFERENCE <span class="Style3">BTK<?php echo $id; ?><br><?php echo $msg_err;?><br><br></font>		
		<?php }
		if(!empty($id_mail))
			if($id_mail>0){ ?>
			<br>Apercu du mail envoyé:<br>
			<iframe src="<?php echo Yii::app()->createAbsoluteUrl('module/historyEmail?id='.$id_mail);?>" style="width:100%;height:800px"></iframe>
		<?php } ?>
    </span>
      
    </div>