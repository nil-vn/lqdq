<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/privilege/privilege.css" rel="stylesheet">
<script>
$(function () {
	$("#sel").change(function () {
		window.location.href = webroot+'/privileges/'+ $(this).attr('value');
	});
});
</script>
<?php $action = Yii::app()->controller->action->id;?>
<div class="well form-inline">
Selectionner le tableau à afficher :
<select id="sel" name="sel" style="width:270px">

  <option value="">-- Selectionner un tableau --</option>

  <option value="privilege_mandat">REGISTRE DES MANDATS(privilege)</option>
  <option value="premium">REGISTRE REPERTOIRE LOI 02/01/1970</option>
  
  <optgroup label="ACQUEREUR --------------------"></optgroup>
  <option <?php if($action == 'acquereurs_rappel') echo 'selected="selected"';?>value="acquereurs_rappel">RAPPEL CLIENT</option>

  <optgroup label="ANNONCE --------------------"></optgroup>
  <option value="annonce_controle">CONFORME / NON CONFORME</option>
  <option value="annonce_controle_horsligne">CONTROLE ANNONCE HORS LIGNE</option>
  
  <optgroup label="BLACKLIST --------------------"></optgroup>
  <option value="acquereurs_blacklist">Blacklist client acquéreur</option>
  <option value="annonces_blacklist">Blacklist client vendeur</option>

  <optgroup label="DECOUVERTE --------------------"></optgroup>
  <option value="decouvertes_controle">Découverte » CONTROLE</option> 
  <option value="decouverte_sansacquereur">Découverte » SANS ACQUEREUR</option>
  <option value="decouverte_liste">Découverte » Liste</option>

  <optgroup label="PREMIUM --------------------"></optgroup>
  <option value="premium_controle">Premium » PRISE EN MAIN</option>
  <option value="premium_6mois">Premium &gt; 6 MOIS</option>
  <option value="premium_liste">Premium » Liste</option>

  <optgroup label="PRIVILEGE --------------------"></optgroup>
  <option value="privilege_priseenmain_verifier">Privilège » PRISE EN MAIN A CONTROLER</option>
  <option value="privilege_controle">Privilège » CONTROLE</option>
  <option value="controle_descriptif">Privilège » CONTROLE DU DESCRIPTIF</option>
  <option value="privilege_desactiver">Privilège » » DESACTIVEE</option>
  <option value="privilege_vendu">Privilège » VENDU</option>
  <option value="privilege_vendu_immo">Privilège » VENDU PAR IMMOBILIER</option>
  <option value="privilege_maj">Privilège » NON MISE A JOUR</option>
  <option value="privilege_priseenmain">Privilège » PRISE EN MAIN</option>
  <option value="privilege_reveil">Privilège » REACTIVEE</option>
  <option value="privilege_contrat_op">Privilège » CONTRATS ENVOYES PAR OP</option>

  <optgroup label="TELEPHONES --------------------"></optgroup>
  <option value="telephones_valides">Statistiques TELEPHONES</option>

  <optgroup label="LOCATION --------------------"></optgroup>
  <option value="location_attente">Location attente activation</option>

  <optgroup label="CA  --------------------"></optgroup>
  <option value="ca_premium">CA PREMIUM</option>

  <optgroup label="Erreurs liste  --------------------"></optgroup>
  <option value="erreur_liste">Liste des erreurs</option>

  <optgroup label="PASSERELLES  --------------------"></optgroup>
  <option value="listeAnnoncesPasserelles">DIFFUSION</option>

  <optgroup label="CUSTOM  --------------------"></optgroup>
  <option value="custom">CUSTOM TAB</option>
</select>
<input name="" type="button" id="ajaxUpdate" class="btn btn-default" value="Actualiser"/>
</div>
<div id="table_content">
	<?php 
		$this->renderPartial($view,$params);
	?>
</div>