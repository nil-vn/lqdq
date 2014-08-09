<div class="widget-head">
	<h5> <span class="color-icons lock_co"></span> Identifiants de connexion </h5>
</div>
<form method="POST" class="form-horizontal well" id="saveMemberForm" action="<?php echo PIUrl::createUrl('/home/changeUserMember');?>">
	<fieldset>
		<input type="hidden" name="WpUserSave[ID]" value="<?php echo $model->user->ID;?>"/>
		<input type="hidden" name="WpUserSave[property_id]" value="<?php echo $model->id;?>"/>
		<div class="control-group">
			<label class="control-label" for="WpUserSave_user_email"> E-mail *</label>
			<div class="controls">
				<input name="WpUserSave[user_email]" value="<?php echo $model->user->user_email;?>" readonly="true" type="text" class="input-xlarge text-tip" id="WpUserSave_user_email" data-original-title="E-mail">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="WpUser_old_pass">Mot de passe *</label>
			<div class="controls">
				<input name="WpUserSave[old_pass]" type="text" class="input-xlarge text-tip old_pass" id="WpUserSave_old_pass" data-original-title="Mot de passe">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="WpUser_new_pass"> Nouveau mot de passe</label>
			<div class="controls">
				<input name="WpUserSave[new_pass]" type="text" class="input-xlarge text-tip new_pass" id="WpUserSave_new_pass" data-original-title="Nouveau mot de passe">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="WpUser_comfirm_new_pass">Confirmation nouveau mot de passe</label>
			<div class="controls">
				<input name="WpUserSave[comfirm_new_pass]" type="text" class="input-xlarge text-tip comfirm_new_pass" id="WpUserSave_comfirm_new_pass" data-original-title="Confirmation nouveau mot de passe">
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn"><i class='color-icons disk_co'></i>Modifier le mot de passe</button>
			</div>
		</div>
	</fieldset>
</form>