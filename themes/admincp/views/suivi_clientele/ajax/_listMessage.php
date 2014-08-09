<?php 
if (isset($messageList)) {
?>
<select id="idmessage" name="idmessage" class="input" style="width:auto">
    <option value="0">Veuillez selectionner un message</option>
    <?php foreach ($messageList as $message)  {
	?>
		<option value="<?php echo $message['id_message'];?>"><?php echo $message['titre'];?></option>
	<?php } ?>
</select>
	<?php if (count($messageList)<=0) { ?>
		<a href="<?php echo PIUrl::createUrl('suivi_clientele/categorie');?>" target="_blank"><input name="" type="button" value="Ajouter une catégorie" class="btn"/></a>
	<?php } ?>
<?php } ?>