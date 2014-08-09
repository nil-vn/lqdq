<?php //date('Y-m-d H:s:i');
?>
<div style="position:absolute; top:0px; left:0px; border:1px solid black;font-size:12px; height:81px; width:237px">
<center>
	<form action="<?php echo PIUrl::createUrl('webmail/validate');?>" method="post" name="f1">
	<?php if (isset($_POST['email_modifier'])) { ?>
		<input type="hidden" name="email" value="<?php echo $_POST['email_modifier'];?>">
		<?php echo $_POST['email_modifier'];?>
		<br />
		A VERIFIER:
	<?php } else {?>
		Mail : <input type="text" name="email" value="">
		<br>
	<?php } ?>
	<input type="hidden" name="isValidate">
	<input style="background-color:green;height:23px;font-size:10px;font-weight:bold;width:50px" type="button" value="VALIDE" onclick="document.f1.isValidate.value='1';document.f1.submit()">
	<input style="background-color:red;height:23px;font-size:10px;font-weight:bold;width:85px" type="button" value="INCORRECTE" onclick="document.f1.isValidate.value='0';document.f1.submit()">
	<input style="background-color:red;height:23px;font-size:10px;font-weight:bold;width:65px" type="button" value="BlackList" onclick="document.f1.isValidate.value='0';document.f1.submit()">
	</form>
</center>
<div>
</div>
</div>