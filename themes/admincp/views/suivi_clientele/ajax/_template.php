<?php
$id_contact = $template['id_contact'];
$contactList = ReponseContact::model()->findAll(array('order' => 'prenom'));
?>
<?php echo CHtml::beginForm(); ?>
<div><strong>Expéditeur :</strong></div>
<div>
	<input type="hidden" value="<?php echo $message_id;?>" name="message_id" />
    <select id="contact" name="contact" class="input" style="width:250px">
		<?php foreach($contactList as $contact) { ?>
			<option value="<?php echo $contact['id_contact'];?>" <?php if ($contact['id_contact']==$id_contact) {echo 'selected="selected"';} ?>><?php echo $contact['prenom'];?> - <?php echo $contact['service'];?></option>
		<?php } ?>
    </select>
</div>
<div style="color:green">
    <input name="libre" type="checkbox" value="1" onclick=""> Cochez cette case pour envoyer un mail libre (Aucune sauvegarde)
</div>
<div>
    <strong>Destinataire :</strong>
</div>
<div>
    <input id="destinataire" name="destinataire" type="text" size="100" maxlength="200" value="<?php echo $_SESSION['mailTo'];?>">
</div>
<div>
    <strong>Titre :</strong>
</div>
<div>
    <input id="titre" name="titre" type="text" size="100" maxlength="200" value="<?php echo $template['titre'];?>">
</div>
<div>
    <strong>Objet :</strong>
</div>
<div>
    <input id="objet" name="objet" type="text" size="100" maxlength="200" 
		<?php if (isset($_SESSION['post_property_id']) && $_SESSION['post_property_id']>0) { ?>
			value="Annonce réf. <?php echo $_SESSION['post_property_id'];?> //<?php echo $template['objet'];?>" 
		<?php } else {?>
			value="<?php echo $template['objet'];?>" 
		<?php } ?> 
	/>
</div>
<div>
    <strong>Contenu :</strong>
</div>
<div>
    <textarea id="contenu" name="contenu" cols="90" rows="10"><?php echo $template['contenu'];?></textarea>
</div>
<br>-- Pied de page par defaut :
<br>--------------------------------------
<br>Service clients - http://www.immobilier.fr
<br><br>serviceclients@immobilier.fr
<br>--------------------------------------
<br><br>
<div>
    <strong>Copier ici le message original du client (Optionnel) [<font color="red">Attention cela apparait dans le mail au client</font>]:</strong>
</div>
<div>
    <textarea id="original" name="original" cols="90" rows="5"></textarea>
</div>
<div>
	<input name="" class="btn btn-default" type="button" value="  Editer le message  " class="input" onclick="location.replace('<?php echo PIUrl::createUrl('suivi_clientele/message_editer', array('id'=>$template['id_message'])); ?>')">&nbsp;&nbsp;<input name="id_annonce" value="" type="hidden">
	<?php echo CHtml::ajaxSubmitButton('Envoyer le message ', PIUrl::createUrl('suivi_clientele/sendmail'), array('type'=>'POST','success'=>'js: function(data) {
                        alertify.alert("Email has been sent successfully!");
                    }'),array(
		'class'=>'btn btn-default',
		'id'=>'sendMail',
		)); 
	?>
</div>
<?php echo CHtml::endForm(); ?>