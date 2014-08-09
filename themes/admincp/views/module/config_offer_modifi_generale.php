
<div class="" style="width:650px;margin:0 auto;">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo-admin.gif" />
	<div class="nonboxy-widget">
		<div class="widget-head">
			<h5> <span class="color-icons"></span> CREATION NOUVELLE OFFRE PROMOTIONNELLE</h5>
		</div>
		<div class="widget-content">
			<p style="color:red;font-weight:bold;">Tous les champs sont obligatoires: </p>
			<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'saveOfferGeneraleForm',
			)); ?>
			<fieldset>
					<div class="control-group">
						<div class="controls">
							<label class="control-label" for="Offre_num_demarchage">Type de mandat concerné par les conditions générales</label>
							<?php echo $form->textField($model,'num_demarchage',array('class'=>'input-xlarge')); ?>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="control-label" for="Offre_num_demarchage">Texte des "Conditions générales"</label>
							<?php echo $form->textArea($model,'condition',array('class'=>'input-xlarge','style'=>'width:100%;height: 140px;','row'=>8)); ?>
						</div>
					</div>
					<div class="form-actions">
						<button class="btn btn-primary" type="submit">Modifier</button>
						<button type="button" href="<?php echo PIUrl::createUrl('/module/configOfferVisu');?>" class="btn btn-warning BTNVretour">Retour</button>
					</div>
			</fieldset>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<?php if(Yii::app()->user->hasFlash('returnUrl')):?>
	<script>
		/*$(document).ready(function(){
				var url = '<?php echo Yii::app()->user->getFlash("returnUrl"); ?>';
				window.parent.$.fancybox.close();
				window.parent.$.fancybox.open({
					type: 'iframe',
					width:950,
					href: url
				});
		});*/
	</script>
<?php endif; ?>
<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		$(".BTNVretour").click(function(){
			window.parent.$.fancybox.close();
			window.parent.$.fancybox.open({
				type: 'iframe',
				width:950,
				href: $(this).attr('href')
			});
		});
	});
</script>