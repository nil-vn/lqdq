<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<?php
$filter = '
<form class="filter" name="form" method="get" action="'.PIUrl::createUrl('privileges/privilege_maj').'">
	<select name="nonMajOp" style="width:170px">
		<option value="1">Non MAJ OP et CLIENT</option>
		<option value="2">Non MAJ OP</option>
	</select>
	<a href="javascript:alert(\'Non MAJ OP et CLIENT:\nSignifie que l\\\'annonce n\\\'a pas été mise à jour ni par le client ni par un opérateur durant au moins 30J\n\nNon MAJ OP:\nSignifie que l\\\'annonce n\\\'a pas été mise à jour par un opérateur durant au moins 30J\')">(?)</a>
	Reference annonce: 
	<input name="id" type="text" style="width:150px" maxlength="9" value="">
	Classer par
	<select name="order">
		<option value="post_property_id ASC">Référence annonce croissant</option>
		<option value="post_property_id DESC">Référence annonce décroissant</option>
		<option value="insertion_date ASC">Date insertion croissante</option>
		<option value="insertion_date DESC">Date insertion décroissante</option>

		<option value="postProperty.created ASC">Date MAJ croissante</option>
		<option value="postProperty.created DESC">Date MAJ décroissante</option>
	</select>
	Afficher seulement
	<select name="filter" style="width:120px">
		<option value="1" selected="">Tout afficher</option>
		<option value="t.status=0">en attente</option>
		<option value="t.status=1">injoignable</option>
	</select>
	<input name="" type="submit" value="OK">
</form>
';
?>
<div align="left">
	<font color="blue" size="2">- <u>PROCEDURE</u> :<br>
		<br>
		SCV = Sans Contact Vendeur.<br>
		VTFE = Client Fictif pour MAJ.
		<br><br>
		&nbsp;&nbsp;&nbsp;- 1er cas "Annonce ayant <u>aucun client</u>" ou 1 client arrivé depuis <b><font color="red">plus</font> de 30 jours :</b> <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt; <i>On envoi le mail "Merci de mettre à jour votre annonce" puis on inscrit dans les commentaires "Demande d'actualisation <font color="red"><b>SCV</b></font> par opérateur / prenom"</i> et sortir l'annonce du tableau en cliquant sur le sens interdit(Suppr), mais on n'actualise pas l'annonce.<br><br>
		
		&nbsp;&nbsp;&nbsp;- 2eme cas "Annonce ayant recu au moins 1 client depuis <b><font color="red">moins</font> de 30 jours" :</b> <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt; <i>On fait un appel sur le vendeur pour la MAJ et on ne met à jour que si on a parlé au vendeur, et on en profite pour faire un point sur la suite de l'ACQ envoyé, si aucune nouveauté on actualise l'annonce et on inscrit dans les commentaires "actualisé <font color="red"><b>avec contact vendeur</b></font> par opérateur / prenom" et sortir l'annonce du tableau en cliquant sur le sens interdit(Suppr).<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-Si on arrive pas à joindre le vendeur alors faire 2 appels par jour dont un impérativement après 18h(en France), si toujours pas de contact alors on maintien l'annonce dans le tableau pendant 8 jour en appelant chaque jour et en indiquant dans le commentaire "appel sans réponse" si c'est le cas, après 8 jours sans contact appliquer le 4ème cas.</i><br><br>
		
		&nbsp;&nbsp;&nbsp;- 3eme cas : <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt; <i>Lorsque l'on constate que l'annonce n'a pas été mise à jour par un opérateur <font color="red"><b>lors des 2 derniers contrôles</b></font>, on envoi le mail "Dernière demande avant désactivation" puis on inscrit dans les commentaires "Demande d'actualisation  <font color="red"><b>SCV</b></font> par opérateur / prenom" et sortir l'annonce du tableau en cliquant sur le sens interdit(Suppr), mais on n'actualise pas l'annonce.</i><br><br>
		
		&nbsp;&nbsp;&nbsp;- 4eme cas : <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt; <i>Lorsque l'annonce a recu le mail "Dernière demande avant désactivation" lors du dernier contrôle alors on envoi un VTFE par mail, puis on inscrit dans les commentaires "Envoi <font color="red"><b>VTFE SCV</b></font> opérateur / prenom"</i> et sortir l'annonce du tableau en cliquant sur le sens interdit(Suppr), mais on n'actualise pas l'annonce.<br><br>
		
		&nbsp;&nbsp;&nbsp;- 5eme cas : <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&gt; <i>Lorsque l'annonce a recu un VTFE lors du dernier contrôle et qu'il n'y a pas eu de réponse alors on envoi un mail à Jérome pour lui demander si on peut désactiver l'annonce et on inscrit dans les commentaires "Pas de retour VTFE on demande à Jérome son avis sur la désactivation ! / Prénom", et sortir l'annonce du tableau en cliquant sur le sens interdit(Suppr). Si Jérome confirme la suppression par retour de mail alors procéder à la désactivation et inscrire dans les commentaires : "<font color="red"><b>Désactivé</b></font> par opérateur suite à l'accord de Jérome / prenom"</i><br>
	</font>
</div>
<?php $this->widget('TableWidget', array(
        'caption' => 'Fiche privilège(pas l\'annonce) non mise à jour par un opérateur depuis +30 jours',
		'headers' => array('Ref. annonce','Statut','Date insertion','Acquéreur(s)','Actions'),
		'filter'=>$filter,
		'model' => $model,
		'row' => 'code/privilege_maj_row',
		'item_count'=>$item_count,
        'page_size'=>PAGE_SIZE,
        'pages'=>$pages,
		'select'=>$select,
		'resultCaption'=>'annonces',
)); ?>