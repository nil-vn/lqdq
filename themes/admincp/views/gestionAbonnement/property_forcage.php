<style>
#wd-wrapper{width: 600px;margin: 10px auto;}
.wd-content .wd-validate-forcage{width: 100%;}
.wd-content .wd-validate-forcage p strong{display: inline-block;font-size: 16px;}
.wd-content .wd-validate-forcage h4{font-size: 18px;margin:15px 0;}
.wd-content .wd-validate-forcage p strong.cl-red{color: #ff0000;}
.wd-content .wd-validate-forcage select{display: block;}
.wd-content .wd-validate-forcage p.txt-area textarea{display: block;width: 98%;}
</style>
<script></script>
<div id="wd-wrapper" class="well">
	<div class="wd-content">
	<?php if(Yii::app()->user->hasFlash('success_forcage')): ?>
		<?php echo Yii::app()->user->getFlash('success_forcage'); ?>
	<?php endif;?>
	
	
	<?php if(!empty($property->id)):?>
	<form name="PropertyForcageForm" id="PropertyForcageForm" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
		<div class="wd-validate-forcage">
			<p>
				<strong> - Diffusion LBC :</strong>
				<?php
					if($data['FORCAGE_LBC'] == 1)
						echo '<strong style="text-color:green">DIFFUSION INTERDITE</strong>';
					elseif($data['FORCAGE_LBC'] == 2)
						echo '<strong>PAS DE FORCAGE</strong>';
					else
						echo '<strong class="cl-red">DIFFUSION INTERDITE</strong>';
				?>
			</p>
			<p>
				<strong> - Diffusion PV :</strong>
				<?php
					if($data['FORCAGE_PV'] == 1)
						echo '<strong style="text-color:green">DIFFUSION INTERDITE</strong>';
					elseif($data['FORCAGE_PV'] == 2)
						echo '<strong>PAS DE FORCAGE</strong>';
					else
						echo '<strong class="cl-red">DIFFUSION INTERDITE</strong>';
				?>
			</p>
			<p>
				<strong> - Diffusion SL(seloger) :</strong>
				<?php
					if($data['FORCAGE_SL'] == 1)
						echo '<strong style="text-color:green">DIFFUSION INTERDITE</strong>';
					elseif($data['FORCAGE_SL'] == 2)
						echo '<strong>PAS DE FORCAGE</strong>';
					else
						echo '<strong class="cl-red">DIFFUSION INTERDITE</strong>';
				?>
			</p>
			<h4>Forcage diffusion LBC/PV/SL de l'annonce <?php echo $property->id;?></h4>
			<select name="Forcage[passerelle]" id="passerelle">
				<option value="">Passerelle</option>
				<option value="paruvendu">ParuVendu</option>
				<option value="spir">LeBonCoin</option>
				<option value="seloger">SeLoger</option>
			</select>
			<select name="Forcage[action]" id="action">
				<option value="1">Forcer la diffusion</option>
				<option value="0">Interdire la diffusion</option>
				<option value="2">Annuler forcage</option>
			</select>
			<p class="txt-area">
				<span>Commentaire :</span>
				<textarea name="Forcage[commentaire]" rows="3" id="commentaire"></textarea>
			</p>
			<button class="btn" type="submit">Valider le forcage</button>
		</div><!-- end wd-validate-forcage -->
	</form>
	<?php else:?>
		<h3 style="color:red">Une erreur est survenue, merci de r&eacute;essayer plus tard.</h3>
	<?php endif;?>
	</div>
</div>
<script>$().ready(function(){ $("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"}); });</script>