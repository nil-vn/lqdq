<?php
if ($msg!='') {
	echo $msg;
}
$forcage_lbc = $this->getForcage('spir',$_GET['id']);
$forcage_pv = $this->getForcage('paruvendu',$_GET['id']);
$forcage_sl = $this->getForcage('seloger',$_GET['id']);
?>
<h4>&nbsp;-&nbsp;Diffusion LBC : 
<?php
if ($forcage_lbc==1)
	echo '<font color="Green">DIFFUSION FORCEE</font>';
else if ($forcage_lbc==0)
	echo '<font color="Red">DIFFUSION INTERDITE</font>';
else
	echo '<font>PAS DE FORCAGE</font>';
?> </h4><br/>
<h4>&nbsp;-&nbsp;Diffusion PV : 
<?php
if ($forcage_pv==1)
	echo '<font color="Green">DIFFUSION FORCEE</font>';
else if ($forcage_pv==0)
	echo '<font color="Red">DIFFUSION INTERDITE</font>';
else
	echo '<font>PAS DE FORCAGE</font>';
?> </h4><br/>
<h4>&nbsp;-&nbsp;Diffusion SL(seloger) : 
<?php
if ($forcage_sl==1)
	echo '<font color="Green">DIFFUSION FORCEE</font>';
else if ($forcage_sl==0)
	echo '<font color="Red">DIFFUSION INTERDITE</font>';
else
	echo '<font>PAS DE FORCAGE</font>';
?> </h4><br/>
<form method="post" onsubmit="if(this.passerelle.value=='') {alert('Merci d\e choisir une passerelle'); return false;}if(this.commentaire.value=='') {alert('Merci d\'entrer un commentaire'); return false;}">
	<h3>Forcage diffusion LBC/PV/SL de l'annonce <?php echo $_GET['id'];?></h3><br/>
	<select name="passerelle">
		<option value="">Passerelle</option>
		<option value="paruvendu">ParuVendu</option>
		<option value="spir">LeBonCoin</option>
		<option value="seloger">SeLoger</option>
	</select><br/>
	<select name="action">
		<option value="1">Forcer la diffusion</option>
		<option value="0">Interdire la diffusion</option>
		<option value="2">Annuler forcage</option>
	</select><br/>
	Commentaire:<br>
	<textarea name="commentaire" style="width:500px; height:50px"></textarea><br><br>
	<input type="submit" class="btn" value="Valider le forcage" style="width:500px">
</form>