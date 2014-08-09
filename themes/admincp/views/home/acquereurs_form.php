<div id="acquereursForm" style="width:660px;margin:0 auto;">
<?php if($model !== null && $model->is_validate ==1 && $model->status == 0):?>
	<div style="text-align:center">
		<h3>NOUVELLE "FICHE CLIENT ACHETEUR" </h3>
		<p class="annonces_select">Annonces sélectionnées : </p>
		<h4>-> ANNONCE REFERENCE <?php echo $model->id?></h4>
	</div>
	<div class="nonboxy-widget well" style="text-align:center">
		<div class="widget-head">
			<h5>Contrôle immobilierdev.com</h5>
		</div>
		<div class="widget-content">
			<div class="widget-box">
				<form class="form-horizontal" id="acquereursFormSMS">
					<fieldset>
					<div class="control-group">
						<select name="from">
							<option value="DUPRES;Pierre;pierre.dupres@gmail.com" selected="selected">Pierre DUPRES</option>
							<option value="LEFORT;Alexandre;alexforte231@gmail.com">Alexandre LEFORT</option>
							<option value="BERGER;Sandrine;sandrineberger1@gmail.com">Sandrine BERGER</option>
							<option value="LE MOAL;Loïc;llemoal29@gmail.com">Loic LE MOAL</option>
							<option value="HEURARD;Jacques;jackrard@gmail.com">Jacques HEURARD</option>
						</select>
					</div>
					<div class="control-group">
						<button disabled="" class="btn btn-large">Envoyer mail + SMS de contrôle</button>
					</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="nonboxy-widget well">
		<div class="widget-head" style="text-align:center">
			<h5>1- Informations client acheteur</h5>
		</div>
		<div class="widget-content">
			<p style="text-align:center"><strong>Les champs <span class="label-required">*</span> sont obligatoires.</strong></p>
			<div class="widget-box">
			<form class="form-horizontal acquereursForm" method="POST" action="<?php echo $_SERVER['REQUEST_URI'];?>">
				<input type="hidden" name="WpListCustomer[post_property_id]" value="<?php echo $model->id;?>"/>
				<input type="hidden" name="WpListCustomer[post_property_type]" value="<?php echo $model->type_property;?>"/>
				<input type="hidden" name="WpListCustomer[type_m]" value="<?php echo $model->payment_id;?>"/>
				<fieldset>
				<div class="control-group">
					<label class="control-label">Provenance <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[provenance]" id="WpListCustomer_provenance">
							<option value="" selected="selected">Faites un choix</option>
							<option value="AUTRE">Autre</option> 
							<option value="LAVIEIMMOBILIERE">La vie immobilière</option> 
							<option value="LEBONCOIN">Leboncoin</option>
							<option value="LESTERRAINS">Les terrains.com</option>
							<option value="LOGICIMMO">Logicimmo</option>
							<option value="EUROPE1">Europe 1</option>
							<option value="EVROVILLA">Evrovilla</option>
							<option value="FRANCETELEVISION">France television</option>
							<option value="SITE">immobilierdev.com</option>
							<option value="MACABANE">Ma-cabane</option>
							<option value="ONVOUSLOGE">Onvousloge</option> 
							<option value="ORANGE">Orange</option>                        
							<option value="PARUVENDU">Paruvendu</option>
							<option value="PRETALOUER">Prêt à louer</option>
							<option value="REPIMMO">Repimmo</option>
							<option value="TOPANNONCE">Top annonce</option>
							<option value="TROVIT">Trovit</option>
							<option value="VIVASTREET">Vivastreet</option>
							<option value="YAHOO">Yahoo</option>
							<option value="YAKAZ">Yakaz</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Type <span class="label-required">*</span></label>
					<div class="controls">
						<select name="WpListCustomer[type]" id="WpListCustomer_type">
							<option value="">-- Sélection --</option>
							<option value="1">Une agence</option>
							<option value="0" selected="selected">Un particulier</option>
							<option value="2">Un professionnel</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">Genre </label>
					<div class="controls">
						<select name="WpListCustomer[customer_gender]" id="WpListCustomer_customer_gender">
							<option value="Mme, Mr">Mme, Mr</option>
							<option value="Mr">Mr</option>
							<option value="Mme" selected>Mme</option>
							<option value="Mlle">Mlle</option>
						</select>  
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_last_name">Nom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_last_name]" type="text" class="input-xlarge " id="WpListCustomer_customer_last_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_first_name">Prénom <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_first_name]" type="text" class="input-xlarge" id="WpListCustomer_customer_first_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_tel">Téléphone fixe</label>
					<div class="controls">
						<input name="WpListCustomer[customer_tel]" type="text" class="input-xlarge" id="WpListCustomer_customer_tel">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_phone">Téléphone portable</label>
					<div class="controls">
						<input name="WpListCustomer[customer_phone]" type="text" class="input-xlarge" id="WpListCustomer_customer_phone">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="WpListCustomer_customer_email">E-mail <span class="label-required">*</span></label>
					<div class="controls">
						<input name="WpListCustomer[customer_email]" type="text" class="input-xlarge" id="WpListCustomer_customer_email">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Exemple :
						<font color="red">Ce client a pas mal hésité et a surement donné un faux nom !</font>
					</label>
					<div class="controls">
						<label class="" for="WpListCustomer_internal_message"> <font color="red">Commentaire interne (Immobilier.fr):</font></label>
						<textarea name="WpListCustomer[internal_message]" rows="5" id="WpListCustomer_internal_message" class="input-xlarge"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input501">Exemple :
						<font color="#06C">Ce client est très intéressé, le rappeler le soir à partir de 18h, il est inquiet de l'exposition du bien.</font>
					</label>
					<div class="controls">
						<label class="" for="WpListCustomer_customer_message"> <font color="#06C">Commentaire pour le client vendeur :</font></label>
						<textarea name="WpListCustomer[customer_message]" rows="5" id="WpListCustomer_customer_message" class="input-xlarge"></textarea>
					</div>
				</div>
				<div class="control-group" style="text-align:center">
					<p><strong>Envisagez-vous de recourir à un crédit ?</strong></p>
					<p>Ce client recherche un crédit -> transmettre à crédit.fr</p>
					<div style="margin-left: 265px;">
					<label class="radio radio-acq-credit">
						<input type="radio" value="1" name="WpListCustomer[recours_credit]" class="acq-credit-check"> OUI
					</label>
					<label class="radio radio-acq-credit">
						<input type="radio" checked="" value="0" name="WpListCustomer[recours_credit]" class="acq-credit-check"> NON
					</label>
					<div class="cls"></div>
					</div>
				</div>
				<div id="credit_acq" style="display:none">
					<div class="control-group">
						<label class="control-label">Nature du projet <span class="label-required">*</span></label>
						<div class="controls">
							<select name="WpListCustomer[NatureProjet]" id="WpListCustomer_NatureProjet">
								<option value="1" selected>Crédit Immobilier - Neuf</option>
								<option value="2">Crédit Immobilier - Ancien</option>
								<!-- <option value="3">Crédit Immobilier - Travaux</option> -->
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="WpListCustomer_cp">Code postal <span class="label-required">*</span></label>
						<div class="controls">
							<input name="WpListCustomer[cp]" type="text" class="input-xlarge vallies_acq" id="WpListCustomer_cp">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Ville <span class="label-required">*</span></label>
						<div class="controls">
							<select name="WpListCustomer[credit_ville]" id="acq_villes">
								<option id="acq_villes_title" value="0">Veuillez sélectionner votre ville</option>
							</select>
							<span class="help-inline" id="loading-villes-acq" style="display:none;">
								<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/loading.gif">
							</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="WpListCustomer_credit_some">Somme <span class="label-required">*</span></label>
						<div class="controls">
							<input name="WpListCustomer[credit_some]" type="text" class="input-xlarge" id="WpListCustomer_credit_some">
						</div>
					</div>
				</div>
				<div class="control-group" style="text-align:center">
					<p><strong>Après validation du formulaire, un email sera envoyé au client vendeur.</strong></p>
					<input type="submit" class="btn btn-large"value="Enregistrer" />
				</div>
			</fieldset>
			</form>
			</div>
		</div>
	</div>
<?php else:?>
	<div class="well" style="text-align:center;margin-top:10px">
		<h4 style="padding:5px;color:#000;">MERCI DE SELECTIONNER UNE ANNONCE DECOUVERTE, PRIVILEGE OU PREMIUM VALIDE.  </h4>
		<p style="color:red">Veuillez saisir une référence annonce valide (ex: 127891). </p>
		<form class="form-horizontal" method="GET" action="<?php echo PIUrl::createUrl('home/acquereurs/');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="input501">Votre référence :</label>
					<div class="controls" style="text-align: left;">
						<input name="property_id" type="text" class="input-xlarge input-xlarge-valider" id="property_id_find">
						<input type="submit" class="btn btn-large" value="Valider" id="property_id_find">
					</div>
				</div>
				<div class="control-group">
					<button id="btn-return-url-acq" class="btn btn-large">RETOUR</button>
				</div>
			</fieldset>
		</form>
	</div>
<?php endif;?>
</div>
<script>
$().ready(function(){ $("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"}); });
</script>