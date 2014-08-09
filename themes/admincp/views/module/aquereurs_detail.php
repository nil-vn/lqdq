<?php //dump($listCustomerNext);?>
<div class="row-fluid main-profile">
<style>
	.filter-acq-attent{margin-top:10px}
	.filter-acq-attent label{width:250px!important;text-align: left!important}
	.filter-acq-attent select{width: 85%!important}
	.filter-acq-attent .control-group {margin-bottom: 5px;}
	.div-property-detail-right{float:right;width: 420px;margin-left: 30px;margin-top: 25px;}
	.div-property-detail-left{float:left}
	.div-property-detail-left .well,.div-property-detail-right .well,.well-acq{padding: 2px;margin-bottom: 0px;float: left;}
	.well-acq{margin-left:10px}
</style>
<?php 

if(isset($_GET['attente']) && $_GET['attente'] == 1):?>
<?php $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
	<form class="form-horizontal filter-acq-attent">
		<fieldset>
			<div class="control-group">
				<label class="control-label">Accès rapide Acq:</label>
				<div class="controls">
					<select name="" class="acq-attente-filter">
						<option>Par Acq nom</option>
						<?php $i = 1; if(!empty($Anothers))  foreach($Anothers as $another):?>
							<?php 
								if(isset($another->property->city)){
									$city = explode('_',$another->property->city); $city = $city[1];
								}else{
									$city = '';
								}
							?>
							<option value="<?php echo $another->id;?>">
								<?php echo $i.': ACQ: '
									.$another->customer_first_name.' '
									.$another->customer_last_name.$space.'BTK';
									if(isset($another->property)){
										echo $another->property->id.' '
										.$another->property->getParentCategory().' '
										.$another->property->getMetaValue('surface');
									}
									//.$another->property->id.' '
									//.$another->property->getParentCategory().' '
									//.$another->property->getMetaValue('surface')
									echo 'm²&nbsp;&nbsp;('.$city.')';
								?>
							</option>
						<?php $i++; 
						endforeach;?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Accès rapide Bien: </label>
				<div class="controls">
					<select name="" class="acq-attente-filter">
					<option>Par annonce détail</option>
					<?php $i = 1; if(!empty($Anothers)) foreach($Anothers as $another):?>
						<?php 
							if(isset($another->property->city)){
								$city = explode('_',$another->property->city); $city = $city[1];
							}else{
								$city = '';
							}
						?>
						<option value="<?php echo $another->id;?>">
							<?php 
								echo $i.': BTK';
								if(isset($another->property)){
									echo $another->property->id.' '
									.$another->property->getParentCategory().' '
									.$another->property->getMetaValue('surface');
								}
								echo 'm²&nbsp;&nbsp;('.$city.')'.$space
								.'ACQ: '.$another->customer_first_name.' '
								.$another->customer_last_name;
							?>
						</option>
					<?php $i++; endforeach;?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Accès rapide Id_annonce asc: </label>
				<div class="controls">
					<select name="" class="acq-attente-filter">
					<option>Par id_annonce ascendant</option>
					<?php $i = 1; if(!empty($Anothers)) foreach($Anothers as $another):?>
						<?php 
							if(isset($another->property->city)){
								$city = explode('_',$another->property->city); $city = $city[1];
							}else{
								$city = '';
							}
						?>
						<option value="<?php echo $another->id;?>">
							<?php 
								echo $i.': BTK';
								if(isset($another->property)){
									echo $another->property->id.' '
									.$another->property->getParentCategory().' '
									.$another->property->getMetaValue('surface');
								}
								echo 'm²&nbsp;&nbsp;('.$city.')'.$space.'ACQ: '
								.$another->customer_first_name.' '.$another->customer_last_name;
							?></option>
					<?php $i++; endforeach;?>
					</select>
				</div>
			</div>
		</fieldset>
	</form>
<?php endif;?>
<?php //CVarDumper::dump($listCustomer,10,true); exit;  
if(!empty($listCustomer) && !$check_blacklist):?>
	<?php if(isset($_GET['wb'])) {?>
		<div style="text-align:center;">
			<h2 style="color:red">Acq blacklistés uniquement</h2>
		</div>
	<?php }?>
	<?php $paymentPackage = isset($listCustomer->property->payment) ? $listCustomer->property->payment->package : ''; ?>
		<div class="container top-profile">
			<div class="div-property-detail">
				<div class="div-property-detail-left">
					<h2>BTK<?php echo $listCustomer->property->id; /*echo $listCustomer->property->id;*/?> <span><?php echo $paymentPackage;?></span></h2>
					<?php $listCategory = ""; if(!empty($listCustomer->property->categories)) foreach($listCustomer->property->categories as $category):?>
						<?php
							if($category->parent_id == 0)
								$listCategory = $category->category_name.' / '.$listCategory;
							else{
								$listCategory = $listCategory.$category->category_name." / ";
							}
						?>
					<?php endforeach;?>
					<h3><?php $listCategory = trim($listCategory); echo rtrim($listCategory, "/");?></h3>
					<?php
						// $city = $listCustomer->property->city; $location = "";
						// if($city !== '' && $city !== 0){
						// 	$city = explode('_',$city);
						// 	$location = $code= $city[0].', '.$city[1];
						// }
						$city = $listCustomer->property->city; $location = "";
						if($city !== '' && $city !== 0){
							$city = explode('_',$city);
							$location = $code= $city[0].', '.$city[1];
						}
					?>
					<h3><?php echo $location;?></h3>
					<p><?php echo $listCustomer->property->getMetaValue('prix') != ''? number_format($listCustomer->property->getMetaValue('prix')).'€' : '';?></p> 
				</div>
				<div class="div-property-detail-right">
					<?php  
						if(!empty($userFixe)){
							echo "<p><span class='color-icons telephone_co'></span>".$userFixe."</p>";
							$this->renderPartial('/home/btn_validate_phone',array('model'=>$listCustomer->property,'phone'=>$validateFixe,'type'=>1,'phoneNumber'=>$userFixe));
						}
						
						if(!empty($usermobile_phone)){
							echo "<p><span class='color-icons telephone_co'></span>".$usermobile_phone."</p>";
							$this->renderPartial('/home/btn_validate_phone',array('model'=>$listCustomer->property,'phone'=>$validatePortable,'type'=>2,'phoneNumber'=>$usermobile_phone));
						}
					?>
				</div>
				<div class="cls"></div>
			</div>
			<div class="acq-update">
				<button onclick="window.open('<?php echo PIUrl::createUrl("/?property_id=".$listCustomer->post_property_id)/*$listCustomer->property->id)*/;?>','_blank');" type="button" value="" class="btn">
					<span class="color-icons magnifier_co"></span>Voir annonce
				</button>
				<?php if($listCustomer->controle !=3):?>
				<?php $idAttenteFirst = $attenteFirst!=null ? $attenteFirst->id : '0-0';?>
				<button onclick="window.open('<?php echo PIUrl::createUrl("/module/voirAcq?id=".$idAttenteFirst."&attente=1");?>','_self')" type="button" value="" class="btn">
					<span class="color-icons alarm_co"></span>En attente (<?php echo $countAttente;?>)
				</button>
				
				<?php $firstIdBackList = $blackListFirst !== null ?$blackListFirst->id : '0-0';?>
				<button onclick="window.open('<?php echo PIUrl::createUrl("/module/voirAcq?id=".$firstIdBackList."&wb=1");?>','_self')" <?php if(isset($_GET['wb']) && $_GET['wb'] ==1) echo  'disabled="disabled"';?> type="button" value="" class="btn">
					Blacklisté uniquement (<?php echo $counBlacklist;?>)
				</button>
				<?php $firstIdSanBackList = $sanBlackListFirst !== null ? $sanBlackListFirst->id : '0-0';?>
				<button onclick="window.open('<?php echo PIUrl::createUrl("/module/voirAcq?id=".$firstIdSanBackList);?>','_self')" <?php if(!isset($_GET['wb']) || (isset($_GET['wb']) && $_GET['wb'] !=1)) echo  'disabled="disabled"';?> type="button" value="" class="btn">
					Acq (sán Blacklisté) (<?php echo $counSanBlacklist;?>)
				</button>
				<?php endif;?>
				<?php
				$url = "";
				if(!empty($listCustomerNext)){
					$url = PIUrl::createUrl('/module/voirAcq?id='.$listCustomerNext['id']);
					if(isset($_GET['attente'])){
						$url.= "&attente=1";
					}elseif(isset($_GET['wb'])){
						$url.= "&wb=1";
					}
				?>
				<span class="follow_cust"><a style="font-size:15px;font-weight:bold" href="<?php echo $url;?>">Client Suivent</a></span>
				<?php }?>
			</div>
		</div>
		<div class="container content-profile">
			<span class="cl-green">Aucune donnée blacklistée, veuillez vérifier les numéros de telephone à l'aide des bouton "Google"...</span>
			<?php if(!empty($doublesBacklist)):?>
				<div class="span8">
					<span class="cl-red">Client blacklisté :</span>
					<select id="Doublon_detecte_acq" name="myContact" style="width:461px;">
						<?php
						foreach($doublesBacklist as $bl){
							$option = "<option>";
							if($bl['customer_last_name'] != '')
								$option.= $bl['customer_last_name'];
							if($bl['customer_tel'] != '')
								$option.= ", tel: ".$bl['customer_tel'];
							if($bl['customer_phone'] != '')
								$option.= ", tel2 : ".$bl['customer_phone'];
							if($bl['customer_email'] != '')
								$option.= ", ".$bl['customer_email'];
							$option.= "</option>";
							echo $option;
						}
						?>
					</select>
				</div>
			<?php endif;?>
			
			<?php if(!empty($doubles)):?>
				<div class="span8">
					<span class="cl-red">Doublon détecté :</span>
					<select id="Doublon_detecte_acq" name="myContact" style="width:388px;">
						<option selected="selected"> Voir le/les doublons détectés</option>
						<?php
						foreach($doubles as $double){
							if($double->envoye ==1 && $double->controle ==1)
								echo '<option value="'.$double->post_property_id.'">'.$double->post_property_id.' -> Envoyé le '.date(Yii::app()->params['datetime'],strtotime($double->date_sending)).'</option>';
							else if($double->envoye ==0 && $double->controle ==1)
								echo '<option value="'.$double->post_property_id.'">'.$double->post_property_id.' -> Découverte en attente d\'envoi</option>';
							elseif($double->envoye ==0 && $double->controle ==2)
								echo '<option value="'.$double->post_property_id.'">'.$double->post_property_id.' -> Supprimé</option>';
							elseif($double->envoye ==0 && $double->controle ==3)
								echo '<option value="'.$double->post_property_id.'">'.$double->post_property_id.' -> En attente</option>';
							//else
								//echo '<option value="">Erreur: information manquante, contact non valide.</option>';
						}
						?>
					</select>
					<button id="btn-Doublon_detecte_acq" type="button" value="" class="btn btn-voir">
						<span class="color-icons magnifier_co"></span>Voir
					</button>
				</div>
			<?php endif;?>
			<span class="cl-datetime">Inscrit le : <?php echo date(Yii::app()->params['datetime'],strtotime($listCustomer->created));?></span>
			<div class="container content-profile update_form">
			<div class="form_show">
			<!-- <form class="form-horizontal" id="update_acquereursForm" name="myForm" ref="<?php echo $listCustomer->id ;?>" action=""> -->
			<form class="form-horizontal" ref="<?php echo $listCustomer->id; ?>" id="update_acquereursForm" name="myForm" action="<?php echo PIUrl::createUrl('/module/UpdateAquereurs',array('id'=>$listCustomer->id));?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">Provenance <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[provenance]" id="WpListCustomer_provenance">
							<option value="AUTRE" <?php if($listCustomer->provenance == 'AUTRE') echo 'selected="selected"'?>>Autre</option> 
							<option value="LAVIEIMMOBILIERE" <?php if($listCustomer->provenance == 'LAVIEIMMOBILIERE') echo 'selected="selected"'?>>La vie immobilière</option> 
							<option value="LEBONCOIN" <?php if($listCustomer->provenance == 'LEBONCOIN') echo 'selected="selected"'?>>Leboncoin</option>
							<option value="LESTERRAINS" <?php if($listCustomer->provenance == 'LESTERRAINS') echo 'selected="selected"'?>>Les terrains.com</option>
							<option value="LOGICIMMO" <?php if($listCustomer->provenance == 'LOGICIMMO') echo 'selected="selected"'?>>Logicimmo</option>
							<option value="EUROPE1" <?php if($listCustomer->provenance == 'EUROPE1') echo 'selected="selected"'?>>Europe 1</option>
							<option value="EVROVILLA" <?php if($listCustomer->provenance == 'EVROVILLA') echo 'selected="selected"'?>>Evrovilla</option>
							<option value="FRANCETELEVISION" <?php if($listCustomer->provenance == 'FRANCETELEVISION') echo 'selected="selected"'?>>France television</option>
							<option value="SITE" <?php if($listCustomer->provenance == 'SITE') echo 'selected="selected"'?>>immobilierdev.com</option>
							<option value="MACABANE" <?php if($listCustomer->provenance == 'MACABANE') echo 'selected="selected"'?>>Ma-cabane</option>
							<option value="ONVOUSLOGE" <?php if($listCustomer->provenance == 'ONVOUSLOGE') echo 'selected="selected"'?>>Onvousloge</option> 
							<option value="ORANGE" <?php if($listCustomer->provenance == 'ORANGE') echo 'selected="selected"'?>>Orange</option>                        
							<option value="PARUVENDU" <?php if($listCustomer->provenance == 'PARUVENDU') echo 'selected="selected"'?>>Paruvendu</option>
							<option value="PRETALOUER" <?php if($listCustomer->provenance == 'PRETALOUER') echo 'selected="selected"'?>>Prêt à louer</option>
							<option value="REPIMMO" <?php if($listCustomer->provenance == 'REPIMMO') echo 'selected="selected"'?>>Repimmo</option>
							<option value="TOPANNONCE" <?php if($listCustomer->provenance == 'TOPANNONCE') echo 'selected="selected"'?>>Top annonce</option>
							<option value="TROVIT" <?php if($listCustomer->provenance == 'TROVIT') echo 'selected="selected"'?>>Trovit</option>
							<option value="VIVASTREET" <?php if($listCustomer->provenance == 'VIVASTREET') echo 'selected="selected"'?>>Vivastreet</option>
							<option value="YAHOO" <?php if($listCustomer->provenance == 'YAHOO') echo 'selected="selected"'?>>Yahoo</option>
							<option value="YAKAZ" <?php if($listCustomer->provenance == 'YAKAZ') echo 'selected="selected"'?>>Yakaz</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Type <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[type]" id="WpListCustomer_type">
							<option value="1" <?php if($listCustomer->type==1) echo 'selected="selected"';?>>Une agence</option>
							<option value="0" <?php if($listCustomer->type==0) echo 'selected="selected"';?>>Un particulier</option>
							<option value="2" <?php if($listCustomer->type==2) echo 'selected="selected"';?>>Un professionnel</option>
							<option value="3" <?php if($listCustomer->type==3) echo 'selected="selected"';?>>Un investisseur (SCI, ...)</option>
							<option value="4" <?php if($listCustomer->type==4) echo 'selected="selected"';?>>Un marchand de biens/Promoteur</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Genre </label>
					<div class="controls">
						<select name="WpListCustomer[customer_gender]" id="WpListCustomer_customer_gender">
							<option value="Mme, Mr" <?php if($listCustomer->customer_gender=='Mme, Mr') echo 'selected="selected"';?>>Mme, Mr</option>
							<option value="Mr" <?php if($listCustomer->customer_gender=='Mr') echo 'selected="selected"';?>>Mr</option>
							<option value="Mme" <?php if($listCustomer->customer_gender=='Mme') echo 'selected="selected"';?>>Mme</option>
							<option value="Mlle" <?php if($listCustomer->customer_gender=='Mlle') echo 'selected="selected"';?>>Mlle</option>
						</select>  
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_last_name">Nom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_last_name]" maxlength="50" type="text" value="<?php echo $listCustomer->customer_last_name;?>" class="input-xlarge " id="WpListCustomer_customer_last_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_first_name">Prénom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_first_name]" maxlength="50" type="text" value="<?php echo $listCustomer->customer_first_name;?>" class="input-xlarge " id="WpListCustomer_customer_first_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_tel">Téléphone fixe</label>
					<div class="controls">
						<input style="float:left" name="WpListCustomer[customer_tel]" type="text" maxlength="15" value="<?php echo $listCustomer->customer_tel;?>" class="input-xlarge " id="WpListCustomer_customer_tel">
						<?php if(strlen($listCustomer->customer_tel) > 1):?>
							<?php if($paymentPackage != "Découverte"){
								$this->renderPartial('btn_validate_phone_acq',array('phone'=>WpTTelephones::model()->findByPk($listCustomer->customer_tel),'type'=>1,'phoneNumber'=>$listCustomer->customer_tel));
							}?>
							<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$listCustomer->customer_tel)."%22+OR+%22".str_replace('.','-',$listCustomer->customer_tel)."%22+OR+%22".$listCustomer->customer_tel."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
							<span class="help-inline"><a rel="<?php echo trim($listCustomer->customer_tel);?>" id="WpListCustomer_customer_tel_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
							<div class="cls"></div>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_phone">Téléphone portable</label>
					<div class="controls">
						<input style="float:left" name="WpListCustomer[customer_phone]" type="text" maxlength="15" value="<?php echo $listCustomer->customer_phone;?>" class="input-xlarge " id="WpListCustomer_customer_phone">
						<?php if(strlen($listCustomer->customer_phone) > 1):?>
							<?php if($paymentPackage != "Découverte"){
								$this->renderPartial('btn_validate_phone_acq',array('phone'=>WpTTelephones::model()->findByPk($listCustomer->customer_phone),'type'=>2,'phoneNumber'=>$listCustomer->customer_phone));
							}?>
							<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$listCustomer->customer_phone)."%22+OR+%22".str_replace('.','-',$listCustomer->customer_phone)."%22+OR+%22".$listCustomer->customer_phone."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
							<span class="help-inline"><a rel="<?php echo trim($listCustomer->customer_phone);?>" id="WpListCustomer_customer_phone_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
							<div class="cls"></div>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_email">E-mail <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_email]" type="text" maxlength="50" value="<?php echo $listCustomer->customer_email;?>" class="input-xlarge " id="WpListCustomer_customer_email">
						<?php if(strlen($listCustomer->customer_email) > 1):?>
						<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$listCustomer->customer_email)."%22+OR+%22".str_replace('.','-',$listCustomer->customer_email)."%22+OR+%22".$listCustomer->customer_email."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
						<span class="help-inline"><a rel="<?php echo trim($listCustomer->customer_email);?>" id="WpListCustomer_customer_phone_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Commentaire envoyé au client vendeur :
					</label>
					<div class="controls">
						<label class="" for="WpListCustomer_customer_message"></label>
						<textarea name="WpListCustomer[customer_message]" rows="5" id="WpListCustomer_customer_message" class="input-xlarge "><?php echo $listCustomer->customer_message;?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Commentaire interne (immobilierdev.com)</label>
					<div class="controls">
						<label class="" for="WpListCustomer_internal_message"></label>
						<textarea name="WpListCustomer[internal_message]" rows="5" id="WpListCustomer_internal_message" class="input-xlarge "><?php echo $listCustomer->internal_message;?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="checkbox">
					<input type="checkbox" name="is_send_mail" value="1">
					Envoyer une demande par mail pour compléter les coordonnées</label>
				</div>
				<div class="span12">
					<button  type="button" value="" class="btn btn-click-Envoyer">
						<span class="color-icons email_open_co"></span>Envoyer
					</button>
					<?php if(isset($_GET['attente']) && $_GET['attente'] == 1):?>
		
					<?php else:?>
					<button  type="button" value="" class="btn btn-click-Attente">
						<span class="color-icons alarm_co"></span>Attente
					</button>
					<?php endif;?>
					<button  type="button" value="" class="btn btn-click-Supprimer">
						<span class="color-icons cross_co"></span>Supprimer
					</button>
					
					<?php if(WpListCustomer::model()->checkIsBlacklistValide($listCustomer->customer_tel,$listCustomer->customer_phone,$listCustomer->customer_email) != 1):?>
					<?php if(!isset($_GET['wb'])){?>
					<button type="button" rel="<?php echo $listCustomer->id;?>" type="button" value="" class="btn btn-Blacklister">
						<span class="color-icons lock_co"></span>Blacklister
					</button>
					<?php }?>
					<button  <?php echo (!isset($_GET['wb'])) ? '': 'disabled="disabled"';?> type="button" value="" class="btn btn-ProposerBlacklist">
						<span class="color-icons error_co"></span>Proposer (Blacklist)
					</button>
					<?php endif;?>
				</div>
			</fieldset>
			<div id="ProposerBlacklistForm" style="display:none;margin-top:10px;border-top: 2px dashed #808080;padding-top:10px">
				<input type="hidden" name="nextId" id="" value="<?php echo !empty($listCustomerNext) ? $listCustomerNext['id'] : '0-0';?>"/>
				<input type="hidden" name="proposer_blacklist_field" id="proposer_blacklist_field" value="0"/>
				<input type="hidden" name="list_customer_id" id="list_customer_id" value="<?php echo $listCustomer->id;?>"/>
				<input type="hidden" name="post_property_id" value="<?php echo $listCustomer->property->id; /*$listCustomer->property->id;*/?>"/>
					<fieldset>
						<div class="control-group">
							<select name="type_client" id="type_client">
								<option value="">Déclarer ce client comme :</option>
								<option value="Professionnel de l'immobilier">Déclarer comme professionnel de l'immobilier</option>
								<option value="Client indélicat">Déclarer comme client indélicat</option>
								<option value="Autre">Autre</option>
							</select>
						</div>
						<div class="control-group">
							<label class="" for="listCustomerComment">Commentaire interne (immobilierdev.com)</label>
							<textarea name="listCustomerComment" rows="5" id="listCustomerComment" class="input-xlarge"></textarea>
						</div>
						<button  type="button" value="" class="btn btn-click-blacklist">Valider</button>
						<button  type="button" value="" class="btn btn-hide-form">Annuler</button>
					</fieldset>
			</div>
			</form>
			</div>
		</div>
		</div>
<?php else:?>
	<?php if(isset($_GET['attente']) && $_GET['attente'] == 1):?>
		
	<?php else:?>
		<div style="text-align:center;">
			<h2 style="color:red">Aucun client acquereur.</h2>
			<?php $idAttenteFirst = $attenteFirst!=null ? $attenteFirst->id : '0-0'?>
			<button onclick="window.open('<?php echo PIUrl::createUrl("/module/voirAcq?id=".$idAttenteFirst."&attente=1");?>','_self')" type="button" value="" class="btn">
				<span class="color-icons alarm_co"></span>En attente (<?php echo $countAttente;?>)
			</button>
			<?php $firstIdBackList = $blackListFirst !== null ?$blackListFirst->id : '0-0';?>
			<button onclick="window.open('<?php echo PIUrl::createUrl("/module/voirAcq?id=".$firstIdBackList."&wb=1");?>','_self')" type="button" value="" class="btn">
				Blacklisté unquiquement (<?php echo $counBlacklist;?>)
			</button>
		</div>
	<?php endif;?>
<?php endif;?>
</div>

<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		if($("#WpListCustomer_customer_tel").val().length == 10){
			$("#WpListCustomer_customer_tel").val(str_split_phone($("#WpListCustomer_customer_tel").val(),2,'.'));
		}if($("#WpListCustomer_customer_phone").val().length == 10){
			$("#WpListCustomer_customer_phone").val(str_split_phone($("#WpListCustomer_customer_phone").val(),2,'.'));
		}
	});
</script>