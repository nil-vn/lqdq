<?php if($count <= 0 || $tab_decouverte_controle == null):?>
<div style="text-align:center">
	<div><strong>Aucune annonce découverte en attente d'activation.</strong></div>
</div>
<?php else: ?>
	<?php $userMetas = $model->user->metas;?>
	<div class="row" style="margin:0 auto">
	<div class="span8">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons"></span> CONTROLE ANNONCE DECOUVERTES - <span style="text-transform: lowercase;color: brown;">(Reste <?php echo $count;?> annonces à controler)</span></h5>
			</div>
			<div class="widget-content">
				<div class="widget-box">
						
						<div class="immobilierHomeDiv"><strong><span class="color-icons user_co"></span> Annonce de <?php echo $model->type_property == 1? 'vente' : 'location';?> Découverte  <?php echo $model->getStatus();?> <a target="_blank" href="<?php echo PIUrl::createUrl('/?property_id='.$model->id);?>">(Ouvrir l'annonce complète)</a></strong></div>
						<div class="cls"></div>
						<form method="POST" class="form-horizontal well" id="decouverteFicheFrom" name="decouverteFicheFrom">
							<input name="WpPostProperty[id]" type="hidden" value="<?php echo $model->id;?>">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="WpPostProperty_prix">Prix :</label>
									<div class="controls">
										<input name="WpPostProperty[prix]" value="<?php echo $model->prix;?>" type="text" class="input-xlarge text-tip" id="WpPostProperty_prix">
										<span>Euros</span>
										
									</div>
								</div>
								
								<?php if($model->hasField('surface_terrain')):?>
								<div class="control-group">
									<label class="control-label" for="WpPostProperty_surface_terrain">Surf Terrain : </label>
									<div class="controls">
										<?php $fieldValue = $model->getMetaValue('surface_terrain');?>
										<input name="WpPostProperty[surface_terrain]" value="<?php echo $fieldValue != '' ? $fieldValue : 0;?>" type="text" class="input-xlarge text-tip" id="WpPostProperty_surface_terrain">
										<span>M2</span>
									</div>
								</div>
								<?php endif;?>
								
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_landline">Fixe :</label>
									<div class="controls">
										<?php $fixe = getUserMeta($userMetas,'landline');?>
											<input name="WpUserMeta[landline]" value="<?php echo $fixe;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_landline" data-original-title="Fixe">
											<?php if(trim($fixe) != ''):?>
												<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$fixe)."%22+OR+%22".str_replace('.','-',$fixe)."%22+OR+%22".$fixe."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
												<span class="help-inline"><a rel="<?php echo trim($fixe);?>" id="WpListCustomer_customer_tel_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
												<div class="cls"></div>
											<?php endif;?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_mobile_phone">Portable :</label>
									<div class="controls">
										<?php $mobile_phone = getUserMeta($userMetas,'mobile_phone');?>
										<input name="WpUserMeta[mobile_phone]" value="<?php echo $mobile_phone;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_mobile_phone" data-original-title="Portable">
										<?php if(trim($mobile_phone) != ''):?>
											<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$mobile_phone)."%22+OR+%22".str_replace('.','-',$mobile_phone)."%22+OR+%22".$mobile_phone."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
											<span class="help-inline"><a rel="<?php echo trim($mobile_phone);?>" id="WpListCustomer_customer_phone_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
											<div class="cls"></div>
										<?php endif;?>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_email">Email : </label>
									<div class="controls">
										<?php $userEmail = $model->user->user_email;?>
										<input name="WpUserMeta[email]" value="<?php echo $userEmail;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_email">
										<?php if(trim($userEmail) != ''):?>
											<?php $url = "https://www.google.fr/search?q=%22".$userEmail."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
											<span class="help-inline"><a target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
											<div class="cls"></div>
										<?php endif;?>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="WpPostProperty_description">Descriptif : </label>
									<div class="controls">
										<textarea id="WpPostProperty_description" style="width: 100%;" rows="5" class="input-xlarge" name="WpPostProperty[description]"><?php echo $model->description;?></textarea>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="WpUserComment_comment">Commentaire client : </label>
									<div class="controls">
										<?php $userComment = $model->user->comment;?>
										<textarea id="WpUserComment_comment" style="width: 100%;" rows="3" class="input-xlarge" name="WpUserComment[comment]"><?php echo $userComment !== null ? $userComment->comment : '';?></textarea>
									</div>
								</div>
							</fieldset>
						</form>
						
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons photo_co"></span> Photos - <a target="_blank" href="<?php echo PIUrl::createUrl('/module/setEditPhotos',array('id'=>$model->id));?>">Ajouter des photos</a></h5>
			</div>
			<div class="widget-content">
				<div class="widget-box">
					<div class="tooltip-demo well">
					<div class="row-fluid">
						<?php $photos = $model->photos; if(!empty($photos)):?>
				            <ul class="thumbnails thumbnails-admin">
								<?php foreach($photos as $photo):?>
								  <li class="span3" style="width:60px!important;height:60px!important;">
					                <a style="width:50px!important;height:50px!important;" href="<?php echo $this->baseHostPlugin.'/photos/'.$photo->name;?>" class="thumbnail fancybox-img">
					                  <img data-src="holder.js/50x50" alt="50x50" style="width:50px!important;height:50px!important;" src="<?php echo $this->baseHostPlugin.'/photos/thumbnail/'.$photo->name;?>">
					                </a>
					              </li>
								<?php endforeach;?>
				            </ul>
						<?php else:?>
							Aucune photo enregistrée sur cette annonce
						<?php endif;?>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-wid-wrap">
			<div class="dashboard-wid-content"> <a href="javascript:void(0)" onClick="document.decouverteFicheFrom.submit();"> <i class="dashboard-icons-colors plus_sl"></i> <span class="dasboard-icon-title">ENREGISTRE L'ANNONCE <br />ET<br />PASSE A L'ANNONCE SUIVANTE</span> </a> </div>
		</div>
		<span style="text-align:center;width: 100%;float: left;margin-bottom:10px;">OR</span>
		<div style="clear:both;"></div>
		<div class="dashboard-wid-wrap">
			<div class="dashboard-wid-content"> <a href="javascript:void(0)" onclick="location.replace('?delid=<?php echo $model->id;?>');"> <i class="dashboard-icons-colors busy_sl"></i> <span class="dasboard-icon-title">SUPPRIMER L'ANNONCE</span> </a> </div>
		</div>
	</div>
</div>
<?php endif;?>
<script>
	$(document).ready(function(){
		$().ready(function(){ $("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"}); });
		
	});
</script>