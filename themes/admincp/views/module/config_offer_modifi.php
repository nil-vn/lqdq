<style>
	.form-horizontal .controls {margin-left: 309px;}
	.form-horizontal .control-label {width: 302px;}
	.btn.sub{width: 100%;}
	.firstTable th{text-align: center;font-size:11px;line-height:12px}
	.firstTable td{text-align: center;}
	.valideno td{background:#ccc!important;}
	.widget-content th{display: table-cell!important;vertical-align: middle!important;}
	p.title_dontknow{line-height:6px; font-size:11px}
	p.title_dontknow strong{color:red}
	.input-xlarge {width: 481px;}
	.form-horizontal .control-label {text-align: left;}
</style>
<div class="" style="width:800px;margin: 0 auto;">
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'saveOfferForm',
		'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo-admin.gif" />
	<div class="nonboxy-widget">
	<?php echo $form->errorSummary($model); ?>
		<div class="widget-head">
			<h5> <span class="color-icons"></span> <?php echo $model->isNewRecord ? 'CREATION' : 'modifiée';?> NOUVELLE OFFRE PROMOTIONNELLE</h5>
		</div>
		<div class="widget-content">
			<p style="color:red;font-weight:bold;">Tous les champs sont obligatoires: </p>
			
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="Offre_num_demarchage">Numéro de l'offre (position)</label>
						<div class="controls">
							<?php echo $form->textField($model,'num_demarchage',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Statut de l'offre:</label>
						<div class="controls">
						<?php echo $form->dropDownList($model,'valide',array('1'=>'Activée','0'=>'Désactivée')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="Offer_valide">Titre de l'offre (mail)</label>
						<div class="controls">
							<?php echo $form->textField($model,'titre',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="Offer_titre_page">Titre de l'offre (page de souscription)</label>
						<div class="controls">
							<?php echo $form->textField($model,'titre_page',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="Offer_message_objet">Objet de l'e-mail</label>
						<div class="controls">
							<?php echo $form->textField($model,'message_objet',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="Offer_image">URL de l'image cliquable associée à l'offre (Mail)</label>
						<div class="controls">
							<?php echo $form->textField($model,'image',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="Offer_image_page">URL de l'image associée à l'offre (Page souscription)</label>
						<div class="controls">
							<?php echo $form->textField($model,'image_page',array('class'=>'input-xlarge')); ?>
						</div>
					</div>
					<label style="width: 324px;" class="control-label" for="Offer_presentation"> Présentation de l'offre après péremption offre précédente </label>
					<?php echo $form->textArea($model,'presentation',array('class'=>'input-xlarge','style'=>'width:100%;height: 100px;','row'=>5)); ?>
					
					<p style="margin-top:10px" class="title_dontknow"><strong style="color:#000">Message html de l'e-mail </strong></p>
					<p style="margin-bottom:15px" class="title_dontknow">options à inserer dans le texte : </p>
					<p class="title_dontknow"><strong>&lt;idannonce&gt;</strong> reference de l'annonce	</p>
					<p class="title_dontknow"><strong>&lt;detailannonce&gt;</strong> bref détail de l'annonce</p>
					<p class="title_dontknow"><strong>&lt;clientnom&gt;</strong> nom du client </p>
					<p class="title_dontknow"><strong>&lt;url&gt;</strong> pour indiquer l'url de validation de l'offre	</p>
					<p class="title_dontknow"><strong>&lt;image&gt;</strong> URL de l'image cliquable associée à l'offre	</p>
					<p class="title_dontknow"><strong>&lt;echeance&gt;</strong> pour indiquer la date d'echeance de l'offre </p>
					<p class="title_dontknow"><strong>&lt;statut&gt;</strong> pour indiquer le statut de l'annonce (ex: Votre annonce est actuellement Hors Ligne !) </p>
					<?php echo $form->textArea($model,'message_html',array('class'=>'input-xlarge','style'=>'width:100%;height: 140px;','row'=>8)); ?>
					
					<p>Message texte de l'e-mail </p>
					<p>mêmes options que pour le html</p>
					<?php echo $form->textArea($model,'message_texte',array('class'=>'input-xlarge','style'=>'width:100%;height: 140px;','row'=>8)); ?>
				
				</fieldset>
				
			
		</div>
	</div>
	<?php if(!$model->isNewRecord):?>
	<div class="" style="margin-left: 0;width:100%">
        <div class="widget-block">
          <div class="widget-head">
            <h5><i class="black-icons list_images"></i> Visualisation du mail (liens non fonctionnels)</h5>
          </div>
          <div class="widget-content" style="padding:5px">
		  <?php
		  	$image_url = '<a href=""><img src="'.$model->image.'" border="0"></a>';
			$modelRecursivite = $model->recursivite;
			$html_message = $model->message_html;
			$html_message = str_replace('<echeance>',date(Yii::app()->params['date'],strtotime(date('Y-m-d H:i:s') . " + $modelRecursivite day")),$html_message);
			$html_message = str_replace('<url>','#',$html_message);
			$html_message = str_replace('<image>',$image_url,$html_message);
			$html_message.= '<p><br><br><center><font size="-2">Si vous ne souhaitez plus recevoir d\'offres par mail de la part d\'immobilier.fr, veuillez cliquer ici</font></center></p>';
			echo $html_message;
		  ?>
            
          </div>
        </div>
      </div>
	  <div style="clear:both"></div>
	  <?php endif;?>
	  <div class="nonboxy-widget">
		<div class="widget-head">
			<h5> <span class="color-icons"></span> PARAMETRES NOUVELLE OFFRE PROMOTIONNELLE</h5>
		</div>
		<div class="widget-content">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="Offre_recursivite">Recursivite du demarchage en jours (Ex: 8 pour 8 jours de delai entre les relances)</label>
					<div class="controls">
						<?php echo $form->textField($model,'recursivite',array('class'=>'input-xlarge')); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="Offre_validite_offre">Validite de l'offre en jours (0=illimité)</label>
					<div class="controls">
						<?php echo $form->textField($model,'validite_offre',array('class'=>'input-xlarge')); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="Offre_montant_ttc">Montant TTC de l'offre (en €uro)</label>
					<div class="controls">
						<?php echo $form->textField($model,'montant_ttc',array('class'=>'input-xlarge','value'=>$model->montant_ttc != '' ? $model->montant_ttc/100 : '')); ?>
						
					</div>
				</div>
				<div class="form-actions">
						<button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'Enregistrer' : 'Modifier';?></button>
						<button type="button" href="<?php echo PIUrl::createUrl('/module/configOfferVisu');?>" class="btn btn-warning BTNVretour">Retour</button>
				</div>
			</fieldset>
		</div>
	</div>
<?php $this->endWidget(); ?>
</div>
<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		$(".BTNVretour").click(function(){
			window.location.href = $(this).attr('href');
		});
	});
</script>