<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="tdgris">
	<tr class="titreorange">
		<td width="50%" colspan="">
			<?php
			//if ($nbSMS > 0) {
				echo $nbSMS;
			//}
			?>
			SMS ENVOYES AU PROPRIETAIRE DE L'ANNONCE REFERENCE <?php echo $id;?>
		<br>
		<br>
		</td>
	</tr>
	<?php
	if (!empty($log_sms)) { ?>
		<tr>
			<td>Numero du destinataire: <em><?php echo $numero;?></em></td>
		</tr>
		<?php
		foreach ($log_sms as $key => $value) {
			if ($cl = "fondvert") {
				$cl = "";
			} else {
				$cl = "fondvert";
			}?>
			<tr>
				<td></td>
			</tr>
			<tr <?php if($value->return_code !== "000") { echo "style=\"color:red\"";}?>>
				<td height="20" class="<?php echo $cl; ?>">
				<br>
				<?php echo $value->return_detail;?>
				<br>
				<?php
				if (strlen($value->id_smsbox) > 0) { ?>
					<strong>N°identification SMS: <em><?php echo $value->id_smsbox;?></em></strong>
				<?php }?>
				<br>
				<?php
				if (!empty($value->contenu)) { ?>
					Contenu du SMS:
					<br>
					<textarea name="" cols="90" rows="5" class="input" readonly="readonly"><?php echo $value->contenu;?></textarea>
				<?php }?>
				<br>
				Re&ccedil;u le: <strong>
				<?php
				if (strlen($value->date_relance) > 0) {
					echo $value->date_relance;
				} else {
					echo $value->date_envoi;
				}?>
				</strong>
				<hr noshade="noshade">
			</td>
			</tr>
			<tr class="titreorange">
			<td height="2" colspan=""></td>
			</tr>
			<?php
		}
	} else { ?>
		<tr>
			<td height="20" class="fondvert"> Aucun sms ...</td>
		</tr>
	<?php }?>
</table>