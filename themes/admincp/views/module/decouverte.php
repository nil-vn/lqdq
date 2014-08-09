<?php if($count <= 0 || $model == null):?>

<div style="text-align:center">
	<div><strong>Aucune annonce découverte en attente d'activation.</strong></div>
	<span onclick="javascript:history.back(1)"> << Fiche précédente</span>
</div>
<?php else: ?>
	<div class="row" style="margin:0 auto">
	<div class="span8">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons"></span> <?php echo $count;?> ANNONCE(S) DECOUVERTE(S) A TRAITER</h5>
			</div>
			<div class="widget-content">
				<div class="widget-box">
						<?php
							$mypostvillec = getUserMeta($model->user->metas,'mypostville');
							if($mypostvillec != '')
							{
								$mypostvilleS = explode('_',$model->user->metas->mypostville);
								$mypostvilleS = $mypostvilleS[count($mypostvilleS)-1].' '.$mypostvilleS[0];
							}else{
								$mypostvilleS = '';
							}
						?>
						<div class="immobilierHomeDiv"><strong><span class="color-icons user_co"></span> FICHE CLIENT REFERENCE <?php echo $model->user->ID;?></strong></div>
						<div class="cls"></div>
						<form class="form-horizontal well" id="saveUserForm">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_first_name">Nom:</label>
									<div class="controls">
										<input readonly="true" name="WpUserMeta[first_name]" value="<?php echo getUserMeta($model->user->metas,'first_name');?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_first_name">
										<?php if(trim(getUserMeta($model->user->metas,'first_name')) != ''):?>
											<span><a href="#">(Vérif Google)</a></span>
										<?php endif;?>
										
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_last_name">Prénom:</label>
									<div class="controls">
										<input readonly="true" name="WpUserMeta[last_name]" value="<?php echo getUserMeta($model->user->metas,'last_name');?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_last_name">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_email">E-mail: </label>
									<div class="controls">
										<input  name="WpUser[user_email]" value="<?php echo $model->user->user_email;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_email">
										<?php if(trim($model->user->user_email) != ''):?>
											<span class="help-inline"><a target="_blank" class="btn" href="<?php echo PIUrl::createUrl('/home/searchAnnonce?profile='.trim($model->user->user_email));?>">Voir</a></span>
											<?php $urlE = "https://www.google.fr/search?q=%22".str_replace('.','+',trim($model->user->user_email))."%22+OR+%22".str_replace('.','-',trim($model->user->user_email))."%22+OR+%22".trim($model->user->user_email)."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
											<a target="_blank" href="<?php echo $urlE;?>">(Vérif Google)</a>
										<?php endif;?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_address">Adresse:</label>
									<div class="controls">
										<input readonly="true" name="WpUserMeta[address]" value="<?php echo getUserMeta($model->user->metas,'address');?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_address">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="my_postal_code">CodePostal:</label>
									<div class="controls">
										<input readonly="true" name="WpUserMeta[mypostcode]" value="<?php echo getUserMeta($model->user->metas,'mypostcode'); ?>" type="text" class="input-xlarge text-tip" id="my_postal_code">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Ville:</label>
									<div class="controls">
										<input readonly="true" name="WpUserMeta[mypostcode]" value="<?php echo $mypostvilleS; ?>" type="text" class="input-xlarge text-tip" id="my_postal_code">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_landline">Téléphone (fixe) : </label>
									<div class="controls">
										<?php $fixe = getUserMeta($model->user->metas,'landline');?>
										<input readonly="true" name="WpUserMeta[landline]" value="<?php echo $fixe;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_landline">
										<?php if(trim($fixe) != ''):?>
											<span class="help-inline"><a target="_blank" class="btn" href="<?php echo PIUrl::createUrl('/home/searchAnnonce?profile='.trim($fixe));?>">Voir</a></span>
											<?php $urlF = "https://www.google.fr/search?q=%22".str_replace('.','+',trim($fixe))."%22+OR+%22".str_replace('.','-',trim($fixe))."%22+OR+%22".trim($fixe)."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
											<a target="_blank" href="<?php echo $urlF;?>">(Vérif Google)</a>
										<?php endif;?>
									</div>
								</div>
								
								<div class="control-group">
									<label class="control-label" for="WpUserMeta_mobile_phone">Téléphone (portable) : </label>
									<div class="controls">
										<?php $mobile_phone = isset($model->user->metas->mobile_phone) ? $model->user->metas->mobile_phone : '';?>
										<input readonly="true" name="WpUserMeta[mobile_phone]" value="<?php echo $mobile_phone;?>" type="text" class="input-xlarge text-tip" id="WpUserMeta_mobile_phone">
										<?php if(trim($mobile_phone) != ''):?>
											<span class="help-inline"><a target="_blank" class="btn" href="<?php echo PIUrl::createUrl('/home/searchAnnonce?profile='.trim($mobile_phone));?>">Voir</a></span>
											<?php $urlP = "https://www.google.fr/search?q=%22".str_replace('.','+',trim($mobile_phone))."%22+OR+%22".str_replace('.','-',trim($mobile_phone))."%22+OR+%22".trim($mobile_phone)."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
											<a target="_blank" href="<?php echo $urlP;?>">(Vérif Google)</a>
										<?php endif;?>
									</div>
								</div>
							</fieldset>
						</form>
						
						<div class="widget-box" class="">
							<div class="widget-head">
								<h5> <span class="color-icons vcard_co"></span> FICHE ANNONCE REFERENCE BTK<?php echo $model->id;?> </h5>
							</div>
							<form method="POST" class="form-horizontal well">
								<fieldset>
									<div class="control-group">
										<label class="control-label" for="">Type de bien :</label>
										<div class="controls">
											<?php $mobile_phone = isset($model->user->metas->mobile_phone) ? $model->user->metas->mobile_phone : '';?>
											<?php $listCategory = ""; if(!empty($myCategory)) foreach($myCategory as $category):?>
													<?php
														if($category->parent_id == 0)
															$listCategory = $category->category_name.' / '.$listCategory;
														else{
															$listCategory = $listCategory.$category->category_name." / ";
														}
													?>
												<?php endforeach;?>
												<input readonly="true" name="WpUserMeta[mobile_phone]" value="<?php $listCategory = trim($listCategory); echo rtrim($listCategory, "/");?>" type="text" class="input-xlarge text-tip">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="">Adresse:</label>
										<div class="controls">
											<input readonly="true" name="Property[address]" type="text" class="input-xlarge text-tip"  value="<?php echo $model->address;?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="">Code postal:</label>
										<div class="controls">
											<input readonly="true" name="Property[postal_code]" value="<?php echo $model->postal_code;?>" type="text" class="input-xlarge text-tip">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="property_villes">Ville :</label>
										<div class="controls">
											<?php
												if($model->city != '')
												{
													$mypostville = explode('_',$model->city);
													$mypostville = $mypostville[count($mypostville)-1];
												}else{
													$mypostville = '';
												}
											?>
											<input readonly="true" value="<?php echo $mypostville;?>" type="text" class="input-xlarge text-tip" id="property_postal_code">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="">Pays :</label>
										<div class="controls">
											<input readonly="true" name="" value="fr" type="text" class="input-xlarge text-tip">
										</div>
									</div>
									
									<?php
										if(!empty($arrField))
											foreach($arrField as $field):
											if($field->htmlvar_name == 'qualite') continue;
											$label = $field->field_name;
											$class = "";
											if($field->is_require){
												$class = "isRequired";
											}
											if($field->type != 1){
										?>
											<div class="control-group">
												<label class="control-label" for="property_<?php echo str_replace('[]','',$field->htmlvar_name);?>"><?php echo $label;?></label>
												<div class="controls">
													<input readonly="true" name="<?php echo $field->id."_".$field->htmlvar_name;?>" value="<?php echo $model->getMetaValue($field->htmlvar_name) != '' ? $model->getMetaValue($field->htmlvar_name) : 0;?>" type="text" class="input-xlarge text-tip <?php echo $class;?>" id="property_<?php echo $field->htmlvar_name;?>" >
													<?php
														if($field->htmlvar_name == 'prix' || $field->htmlvar_name == 'montant_bouquet' || $field->htmlvar_name == 'montant_rente')
															echo '<span class="help-inline">€</span>';
														elseif($field->htmlvar_name == 'surface' || $field->htmlvar_name == 'surface_terrain')
															echo '<span class="help-inline">m²</span>';
													?>
													
												</div>
											</div>
										<?php } endforeach;?>
										
										<div class="control-group">
											<label class="control-label">Descriptif:</label>
											<div class="controls">
												<textarea readonly="true" name="" style="min-height:150px" class="input-xlarge" rows="3"><?php echo $model->description;?></textarea>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<a onclick="window.open('<?php echo PIUrl::createUrl('/?property_id='.$model->id);?>','_blank')" target="_blank" class="btn">Ouvrir l'annonce pour modification</a>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<a href="<?php echo PIUrl::createUrl('/module/decouverteUpdate',array('property_id'=>$model->id,'type'=>1,'next_id'=>$next->id));?>" class="btn" id="btnValidateDecouverte">Valider l'annonce découverte</a>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<a href="<?php echo PIUrl::createUrl('/module/decouverteUpdate',array('property_id'=>$model->id,'type'=>0,'next_id'=>$next->id));?>" id="btnRefuserDecover" class="btn">Refuser l'annonce</a>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<a href="<?php echo PIUrl::createUrl('module/decouverte',array('id'=>$next->id));?>" class="">Fiche suivante >></a>
											</div>
										</div>
								</fieldset>
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons photo_co"></span> Photos - Ajouter des photos</h5>
			</div>
			<div class="widget-content">
				<div class="widget-box">
					<div class="tooltip-demo well">
					<div class="row-fluid">
						<?php if(!empty($model->photos)):?>
				            <ul class="thumbnails thumbnails-admin">
								<?php foreach($model->photos as $photo):?>
								  <li class="span3">
					                <a href="<?php echo $photo->getPhoto();?>" class="thumbnail fancybox-img">
					                  <img data-src="holder.js/50x50" alt="50x50" style="width: 50px; height: 50px;" src="<?php echo $photo->getPhoto(100,100);?>">
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
	</div>
</div>
<?php endif;?>
<script>
	$(document).ready(function(){
		$().ready(function(){ $("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"}); });
		$("#btnValidateDecouverte").click(function(){
			showloadPage();
		});
		$("#btnRefuserDecover").click(function(){
			var _this = $(this);
			alertify.set({ labels: {
				ok		: "OK",
				cancel	: "Cancel"
			}});
			alertify.prompt("<b>Veuillez indiquer la raison de désactivation de cette annonce:(ex: annonce située à l'étranger)</b>", function (e, str) {
				if (e) {
					if(str == ''){
						alert('Vous devez entrer un commentaire.');
						_this.trigger('click');
					}else{
						showloadPage();
						var link = _this.attr('href')+'&commg='+str;
						window.location.href = link;
					}
				}
			}, "");
			return false;
		});
	});
</script>