<!-- CORPS DE LA PAGE -->
<table style="margin:0 auto;" border="0" cellspacing="0" cellpadding="0" width="730px" class="compte">
<tr>
	<td>
		<?php
		if (!empty($data['msg'])) { ?>
			<br />
			<p class="alert"><?php echo $msg;?></p>
		<?php }?>
	</td>
</tr>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" onSubmit='return verifier()' name="form">
<input name="post" type="hidden" value="1" />
<input name="id" type="hidden" value="<?php echo $data['id'];?>"/>
<input name="hash" type="hidden" value="<?php echo $data['hash'];?>" />			
<tr>
	<td>		
             
             <br />
             <br />

             <p class="info">
                L'abonnement sera r&eacute;sili&eacute; suite &agrave; la validation de ce formulaire.                              
              </p>
         
             <br />
             
             <div id="div_question" align="center" 
             style=" background-color:#FCFEEC; width:100%; color:#444; font-size:16px; 
             border-top: 2px solid #A2C76F; border-bottom: 2px solid #A2C76F; 
             padding-top:8px; padding-bottom:8px;">
             
                 Souhaitez-vous laisser l'annonce en ligne jusqu'&agrave; la fin de la p&eacute;riode de diffusion
                 <br />
                 d&eacute;j&agrave; pay&eacute;e, soit jusqu'au <strong><?php echo $data['date_peremption'];?></strong> ?             
             
                 <br />
                 <br />
          
                 <center>  
                    <strong style="font-style:italic">           
                        <label>
                        <input type="radio" name="mode" id="mode" value="0">OUI
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                        <input type="radio" name="mode" id="mode" value="1">NON
                        </label>
                    </strong>
                    <br />
                    <br />
                    <font style="color:#060; font-size:10px; font-weight:bold">Dans les deux cas tous les paiements seront imm&eacute;diatement arr&ecirc;t&eacute;s.</font>
                 </center>
             	
                
            </div>              		                
            			
			<br />
            <br />
		
			<div id="div_question2" align="center" style="width:100%; color:#333333; font-size:14px;">
            
                <strong>Merci de nous indiquer la raison pour laquelle vous souhaitez mettre fin &agrave; votre abonnement :</strong> 
                <br />
                <br />               
                Le client souhaite se d&eacute;sabonner et d&eacute;sactiver son annonce pour la raison suivante :					
                <br />
                <br />                     
            
            </div>
             
            <div style="padding-left:200px; font-size:14px;">
             
				<label>
                <input type="radio" name="raison" id="raison" value="J'ai vendu grâce à Immobilier.fr" onclick="choixchanged(this);">Vendu gr&acirc;ce &agrave; Immobilier.fr
                </label>
                <br />
                <label>
				<input type="radio" name="raison" id="raison" value="J'ai vendu par un autre biais" onclick="choixchanged(this);">Vendu par un autre biais
                </label>
                <br />
                <label>
				<input type="radio" name="raison" id="raison" value="Je ne souhaite plus vendre" onclick="choixchanged(this);">Ne souhaite plus vendre
                </label>
                <br />
                <label>
				<input type="radio" name="raison" id="raison" value="Je reporte la mise en vente pour plus tard" onclick="choixchanged(this);">Reporte la mise en vente pour plus tard
                </label>
                <br />
                <label>
				<input type="radio" name="raison" id="raison" value="Je ne suis pas satisfait de vos services" onclick="choixchanged(this);">Pas satisfait de nos services
                </label>
                <br />
                <label>
				<input type="radio" name="raison" id="raison" value="Autre" onclick="choixchanged(this);">Autre raison
                </label>
                <br />
					
                <br />
                <br />
                
                <label>
				Commentaire:<br><textarea name="commentaire" id="commentaire"></textarea>
                </label>
                <br />
                <br />

                <label>
				<input type="checkbox" name="with_mail" id="with_mail" value="1">Avec email client
                </label>
                <br />
					
			</div>
				
			
			<!--
                <div id="commentaire" align="center" style="width:100%; background-color:#FFF; border-top:2px #C0C0C0 dotted; color:#333333;">
                    <br />
                    <strong style="color:#060;">Vous pouvez nous laisser un commentaire d&eacute;taill&eacute; sur la raison de votre d&eacute;sabonnement : </strong>
                    <br />
                    <textarea id="COMM_CLIENT" name="COMM_CLIENT" cols="70" rows="5"></textarea>
                    <br />
                    <br />
                </div>
			--> 
                 
                 
                 
			<div align="center" style="width:100%; background-color:#EEE; border-top:2px #FFF dotted; color:#333333">
				<br />
				<input type="submit" name="Submit" value="Résilier l'abonnement >>" />
				<br />
				<br />
		  	</div>
		
		<br />
		<br />
		
	</td>
</tr>
</form>		
</table>
<script language="javascript">
function verifier(){
	var mode = document.forms["form"]["mode"].value;
	var raison = document.forms["form"]["raison"].value;
	//var commentaire = document.forms["form"]["commentaire"].value;
    if (mode == null || mode == "") {
        alert("Veuillez indiquer si vous souhaitez laisser votre annonce en ligne jusqu'à la fin de la période de diffusion payée, en sélectionnant OUI ou NON.");
        scroll.toElement($('div_question'));
        return false;
    }
    if (raison == null || raison == "") {
        alert("Veuillez indiquer la raison pour laquelle vous souhaitez mettre fin à votre abonnement.");
        //scroll.toElement($('div_question2'));
        return false;
    }
    if (commentaire.value.length < 10) {
        alert("Veuillez saisir un minimum de 10 charactères dans la cellule commentaire.");
        return false;
    }
}
</script>