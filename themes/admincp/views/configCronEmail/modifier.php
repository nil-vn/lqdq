<div style="position:absolute; top:0px; left:0px; border:1px solid black;font-size:12px; height:40px; width:237px">
<center>
<?php echo $temail['email'];?> 
<form action="" method="post" name="f1">&nbsp;
<?php if ($temail['isvalide']==1) { ?>
<font color="green">OK</font>&nbsp;&nbsp;
<?php } else { ?>
<font color="red">BAD</font>&nbsp;&nbsp;
<?php } ?>
<input type="hidden" name="email_modifier" value='<?php echo $temail['email'];?>'>
<input style="background-color:red;height:23px;font-size:10px;font-weight:bold;width:65px" value="MODIFIER" type="submit">&nbsp;&nbsp;<?php echo date('d/m/Y H:j:s',strtotime($temail['date']));?>
</form>
</center>
<div>
</div>
</div>