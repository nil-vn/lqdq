<div class="row-fluid main-profile update_form_content">
		<div class="container top-profile">
		<?php $paymentPackage =  isset($model->property->payment) ? $model->property->payment->package : '';?>
			<h2>BTK<?php echo $model->property->id;?> <span>"<?php echo $paymentPackage;?>"</span></h2>
			<?php $listCategory = ""; if(!empty($model->property->categories)) foreach($model->property->categories as $category):?>
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
				$city = $model->property->city; $location = "";
				if($city !== '' && $city !== 0){
					$city = explode('_',$city);
					$location = $code= $city[0].', '.$city[1];
				}
			?>
			<h3><?php echo $location;?></h3>
			<span><?php echo $model->property->getMetaValue('prix') != ''? number_format($model->property->getMetaValue('prix')).' €' : '';?></span>
		</div>
		<div class="container content-profile update_form">
			<div class="form_show">
			<form class="form-horizontal" id="update_acquereursForm" name="myForm" action="<?php echo PIUrl::createUrl('/module/UpdateAquereurs',array('id'=>$model->id));?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">Provenance <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[provenance]" id="WpListCustomer_provenance">
							<option value="" <?php if($model->provenance == '') echo 'selected="selected"'?>>Faites un choix</option>
							<option value="AUTRE" <?php if($model->provenance == 'AUTRE') echo 'selected="selected"'?>>Autre</option> 
							<option value="LAVIEIMMOBILIERE" <?php if($model->provenance == 'LAVIEIMMOBILIERE') echo 'selected="selected"'?>>La vie immobilière</option> 
							<option value="LEBONCOIN" <?php if($model->provenance == 'LEBONCOIN') echo 'selected="selected"'?>>Leboncoin</option>
							<option value="LESTERRAINS" <?php if($model->provenance == 'LESTERRAINS') echo 'selected="selected"'?>>Les terrains.com</option>
							<option value="LOGICIMMO" <?php if($model->provenance == 'LOGICIMMO') echo 'selected="selected"'?>>Logicimmo</option>
							<option value="EUROPE1" <?php if($model->provenance == 'EUROPE1') echo 'selected="selected"'?>>Europe 1</option>
							<option value="EVROVILLA" <?php if($model->provenance == 'EVROVILLA') echo 'selected="selected"'?>>Evrovilla</option>
							<option value="FRANCETELEVISION" <?php if($model->provenance == 'FRANCETELEVISION') echo 'selected="selected"'?>>France television</option>
							<option value="SITE" <?php if($model->provenance == 'SITE') echo 'selected="selected"'?>>immobilierdev.com</option>
							<option value="MACABANE" <?php if($model->provenance == 'MACABANE') echo 'selected="selected"'?>>Ma-cabane</option>
							<option value="ONVOUSLOGE" <?php if($model->provenance == 'ONVOUSLOGE') echo 'selected="selected"'?>>Onvousloge</option> 
							<option value="ORANGE" <?php if($model->provenance == 'ORANGE') echo 'selected="selected"'?>>Orange</option>                        
							<option value="PARUVENDU" <?php if($model->provenance == 'PARUVENDU') echo 'selected="selected"'?>>Paruvendu</option>
							<option value="PRETALOUER" <?php if($model->provenance == 'PRETALOUER') echo 'selected="selected"'?>>Prêt à louer</option>
							<option value="REPIMMO" <?php if($model->provenance == 'REPIMMO') echo 'selected="selected"'?>>Repimmo</option>
							<option value="TOPANNONCE" <?php if($model->provenance == 'TOPANNONCE') echo 'selected="selected"'?>>Top annonce</option>
							<option value="TROVIT" <?php if($model->provenance == 'TROVIT') echo 'selected="selected"'?>>Trovit</option>
							<option value="VIVASTREET" <?php if($model->provenance == 'VIVASTREET') echo 'selected="selected"'?>>Vivastreet</option>
							<option value="YAHOO" <?php if($model->provenance == 'YAHOO') echo 'selected="selected"'?>>Yahoo</option>
							<option value="YAKAZ" <?php if($model->provenance == 'YAKAZ') echo 'selected="selected"'?>>Yakaz</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Type <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[type]" id="WpListCustomer_type">
							<option value="1" <?php if($model->type==1) echo 'selected="selected"';?>>Une agence</option>
							<option value="0" <?php if($model->type==0) echo 'selected="selected"';?>>Un particulier</option>
							<option value="2" <?php if($model->type==2) echo 'selected="selected"';?>>Un professionnel</option>
							<option value="3" <?php if($model->type==3) echo 'selected="selected"';?>>Un investisseur (SCI, ...)</option>
							<option value="4" <?php if($model->type==4) echo 'selected="selected"';?>>Un marchand de biens/Promoteur</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Genre </label>
					<div class="controls">
						<select name="WpListCustomer[customer_gender]" id="WpListCustomer_customer_gender">
							<option value="Mme, Mr" <?php if($model->customer_gender=='Mme, Mr') echo 'selected="selected"';?>>Mme, Mr</option>
							<option value="Mr" <?php if($model->customer_gender=='Mr') echo 'selected="selected"';?>>Mr</option>
							<option value="Mme" <?php if($model->customer_gender=='Mme') echo 'selected="selected"';?>>Mme</option>
							<option value="Mlle" <?php if($model->customer_gender=='Mlle') echo 'selected="selected"';?>>Mlle</option>
						</select>  
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_last_name">Nom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_last_name]" type="text" value="<?php echo $model->customer_last_name;?>" class="input-xlarge " id="WpListCustomer_customer_last_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_first_name">Prénom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_first_name]" type="text" value="<?php echo $model->customer_first_name;?>" class="input-xlarge" id="WpListCustomer_customer_first_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_tel">Téléphone fixe</label>
					<div class="controls">
						<input name="WpListCustomer[customer_tel]" type="text" value="<?php echo $model->customer_tel;?>" class="input-xlarge" id="WpListCustomer_customer_tel" style="width: 60%;">
						<?php if(trim($model->customer_tel) != ''):?>
							<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$model->customer_tel)."%22+OR+%22".str_replace('.','-',$model->customer_tel)."%22+OR+%22".$model->customer_tel."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
							<span class="help-inline"><a rel="<?php echo trim($model->customer_tel);?>" id="WpListCustomer_customer_tel_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
							<div class="cls"></div>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_phone">Téléphone portable</label>
					<div class="controls">
						<input name="WpListCustomer[customer_phone]" type="text" value="<?php echo $model->customer_phone;?>" class="input-xlarge" id="WpListCustomer_customer_phone" style="width: 60%;">
						<?php if(trim($model->customer_phone) != ''):?>
							<?php $url = "https://www.google.fr/search?q=%22".str_replace('.','+',$model->customer_phone)."%22+OR+%22".str_replace('.','-',$model->customer_phone)."%22+OR+%22".$model->customer_phone."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
							<span class="help-inline"><a rel="<?php echo trim($model->customer_phone);?>" id="WpListCustomer_customer_phone_link" target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
							<div class="cls"></div>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_email">E-mail <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_email]" type="text" value="<?php echo $model->customer_email;?>" class="input-xlarge" id="WpListCustomer_customer_email" style="width: 60%;">
						<?php if(trim($model->customer_email) != ''):?>
							<?php $url = "https://www.google.fr/search?q=%22".$model->customer_email."%22&hl=fr&rls=GGLD,GGLD:2007-31,GGLD:fr&filter=0";?>
							<span class="help-inline"><a target="_blank" href="<?php echo $url;?>"><img src="<?php echo Yii::app()->theme->baseUrl.'/img/google.gif'?>"/></a></span>
							<div class="cls"></div>
						<?php endif;?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Commentaire envoyé au client vendeur :
					</label>
					<div class="controls">
						<label class="" for="WpListCustomer_customer_message"></label>
						<textarea name="WpListCustomer[customer_message]" rows="5" id="WpListCustomer_customer_message" class="input-xlarge"><?php echo $model->customer_message;?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Commentaire interne (immobilierdev.com)</label>
					<div class="controls">
						<label class="" for="WpListCustomer_internal_message"></label>
						<textarea name="WpListCustomer[internal_message]" rows="5" id="WpListCustomer_internal_message" class="input-xlarge"><?php echo $model->internal_message;?></textarea>
					</div>
				</div>
				<div class="span12">
					<button  type="button" value="" class="btn btn-return-site">
						<span class="color-icons arrow_undo_co"></span>Retour liste
					</button>
					<button  type="submit" value="" class="btn btn-click-update">
						<span class="color-icons disk_co"></span> Modifier
					</button>
					<?php if($model->checkIsBlacklistValide() != 1):?>
					<button type="submit" rel="<?php echo $model->id;?>" type="button" value="" class="btn btn-Blacklister">
						<span class="color-icons lock_co"></span>Blacklister
					</button>
					<button  type="button" value="" class="btn btn-ProposerBlacklist">
						<span class="color-icons error_co"></span>Proposer (Blacklist)
					</button>
					<?php endif;?>
				</div>
			</fieldset>
			<div id="ProposerBlacklistForm" style="display:none;margin-top:10px;border-top: 2px dashed #808080;padding-top:10px">
				<input type="hidden" name="proposer_blacklist_field" id="proposer_blacklist_field" value="0"/>
				<input type="hidden" name="list_customer_id" id="list_customer_id" value="<?php echo $model->id;?>"/>
				<input type="hidden" name="post_property_id" value="<?php echo $model->property->id;?>"/>
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
<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		if($("#WpListCustomer_customer_tel").val().length == 10){
			$("#WpListCustomer_customer_tel").val(str_split_phone($("#WpListCustomer_customer_tel").val(),2,'.'));
		}if($("#WpListCustomer_customer_phone").val().length == 10){
			$("#WpListCustomer_customer_phone").val(str_split_phone($("#WpListCustomer_customer_phone").val(),2,'.'));
		}
		
		$(".btn-click-blacklist").live('click',function(){
			update_acquer();
		});
	});
	function update_acquer(){
	var _form = $("#update_acquereursForm");
	if(checkError(_form)){
		$.ajax({
			type:'POST',
			url:_form.attr('action'),
			data:_form.serialize(),
			success:function(res){
				hideLoadPage();
				if($(window.parent.document).find("#acquereursForm").length == 0){
					if(res.property == window.parent.jQuery("#countAllListCustomer").attr('rel')){
						var count = parseInt(window.parent.jQuery("#countAllListCustomer").html());
						window.parent.jQuery("#countAllListCustomer").html(count+1);
					}
				}
				var CountAcqNew = parseInt(window.parent.jQuery(".menuCountAcqNew").text());
				window.parent.jQuery(".menuCountAcqNew").html(CountAcqNew-1);
				window.location.href = webroot+'/module/voirAcq?id='+ res.nextId;
				_form.find('button[type="submit"]').removeAttr('disabled');
			}
		});
	}
	return false;
}
</script>