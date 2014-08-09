<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
	$total = $this->getTotalPrivilegeDesactiver();
?>
<?php
$filter ='
<form class="filter" name="form" method="get" action="">
	Reference annonce: 
	<input name="id" type="text" maxlength="9">
	&nbsp;
	Classer par
	<select name="order">
	  <option value="post_property_id ASC">Référence annonce croissant</option>
	  <option value="post_property_id DESC">Référence annonce décroissant</option>
	  <option value="insertion_date DESC">Date décroissante</option>
	  <option value="insertion_date ASC">Date croissante</option>
	</select>
	&nbsp;
	Afficher seulement
	<select name="filter">
		<option value="1">Tout afficher</option>
		<option value="status=0 and (datediff(now(),rappel_date)>=0 OR rappel_date is null)">En attente traitement</option>
		<option value="status=3">Contrôlé (supprimé)</option>
	</select>
	<input name="" type="submit" value="OK"><br><br>
	
	<div align="left">
	<font size="2"><b>NB : </b></font><font size="2" color="green"><b>Compromis ou Promesse signée = Considéré comme vendu</b></font><br><br>
	
	<font color="blue" size="2">- <u>PROCEDURE ANNONCE DESACTIVIEE</u> :<br>
	
	&nbsp;&nbsp;&nbsp;-> L\'objectif de cette procédure est de savoir si éventuellement l\'annonce a été désactivée frauduleusement par le vendeur et si elle serait éventuellement en réalité vendue(par immobilier.fr) Dans ce cadre on utilisera principalement les VTFE[par tel(<font color=red>Toujours utiliser une voix de femme</font>)/par écrit].<br><br>
	
	-> Lorsque l\'annonce arrive dans le tableau on regarde 3 points sur l\'annonce :<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Présence acquéreur.<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Raison de la désactivation(important).<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Présence de doublon et donc d\'éventuel acquéreurs sur ce doublon.<br><br>
	
	&nbsp;&nbsp;&nbsp;- 1er cas - Si pas d\'acquéreur alors on supprime du tableau, on regarde si il existe un doublon et si oui on le désactive. Si acquéreur sur le doublon se reporter au 2ème cas.<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> <i>On met en commentaire "Sur l\'annonce et sur doublon / Zéro Acq = Contrôle OK".</i><br><br>
	
	&nbsp;&nbsp;&nbsp;- 2éme cas - Présence d\'acquéreur(s).<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> <i>Utilisation d\'un VTFE par mail(Gilbert)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> Inscrire dans le commentaire "Envoi VTFE par mail"<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> Mettre un rappel à 6 jours si pas de nouvelle.</i><br><br>
	
	&nbsp;&nbsp;&nbsp;- 3éme cas - Présence du commentaire "envoi VTFE par mail" lors du retour de l\'annonce(apres 6 jours).<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> <i>Utilisation d\'un appel VTFE<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A) Si réponse se reporter à la rubrique "action en fonction des réponses"<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B) Si pas de réponse faire 2 appels dans la journée puis en l\'absence de réponse le soir alors mettre en rappel au lendemain(Indiquer à chaque fois dans le commentaire "Appel sans réponse").<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C) Si l\'on arrive pas à contacter le vendeur pendant 8 jours consécutif alors mettre l\'annonce en VENDU et mettre dans le commentaire "Vendeur injoignable".</i><br><br>
	
	-> Action en fonction des réponses :<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> Si le retour VTFE donne une confirmation de l\'absence de vente alors on classe l\'annonce et on inscrit "Désactivation confirmée annonce classée / Prenom" et retirer du tableau.<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> Si le retour VTFE donne que le bien est vendu on classe l\'annonce en vendu et on inscrit "Fausse désactivation risque de vente frauduleuse / Prénom"<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> Si le retour du VTFE appel téléphonique laisse un doute à l\'opérateur on classe l\'annonce en vendu et on inscrit "Doute sur la réalité de la désactivation à approfondir.</i><br><br>
	
	</font></div> 
	
</form>
';
$this->widget('TableWidget', array(
        'caption' => 'Privil&egrave;ge desactiv&eacute;e',
		'headers' => array('Ref. annonce','Statut','Date insertion','Acquereur','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_desactiver_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces en cours de traitement',
		'total'=>$total,
)); 
?>