<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<center>
	<table class="table table-bordered">
		<tr>
			<td style="text-align:center;vertical-align:middle">
				<form method="post" enctype="application/x-www-form-urlencoded" action="">
				<select name="myQueryId" style="width:610px;">
					<option value="">-- Selectionner un query --</option>
					<?php echo $this->fillOption($myQueryId);?>
				</select><br>
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="nbres" value="10">
				<input type="submit" style="width:180px;" value="Voir le tableau">
				</form>
			</td>
			<td style="text-align:center;vertical-align:middle">
				<form method="post" enctype="application/x-www-form-urlencoded" action="">
				<?php if($myQuery=='') {?>
				<textarea name="myQuery" style="width:505px;height:250px; color:lightgrey" onfocus="if(this.value.indexOf('ex:')>=0){ this.value=''; this.style.color='black' }">ex: SELECT top 10 id,id hu,id hu2 from annonce with(nolock)</textarea><br>
				<?php } else {?>
				<textarea name="myQuery" style="width:505px;height:250px" onfocus=""><?php echo $myQuery;?></textarea><br>
				<?php } ?>
				<input type="hidden" name="page" value="1">
				<input type="hidden" name="nbres" value="10">
				<input type="hidden" name="dosave" value="0">
				<input type="hidden" name="descriptif" value="">
				<input type="submit" style="width:180px;" value="Voir le tableau">
				<input type="button" style="width:180px;" value="Enregistrer le tableau" onclick="var z=prompt('Merci de remplir le descriptif de la requete.',''); if(z!=null && z!='') { this.form.dosave.value=1; this.form.descriptif.value=z; this.form.submit(); }">
				</form>
			</td>
		</tr>
	</table>
</center>
<?php echo $table;?>
<?php 

if(Yii::app()->user->hasFlash('register')):?>
        <div class="flash-error">
                <?php echo Yii::app()->user->getFlash('register'); ?>
                <?php
                
                Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 5000).fadeOut("slow");',
                CClientScript::POS_READY
);
        ?>
        </div>
<?php endif; ?>