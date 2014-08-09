<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/action.js"></script>
<hr/>
<span style="display:inline-block;width:700px;vertical-align:top"><h3>Statistiques des 24 derniers mois:</h3></span>
<span style="display:inline-block;width:250px;vertical-align:top; text-align:right;">Le <?php echo date(Yii::app()->params['datetime']);?></span>
<div>
<table id="ver-minimalist" style="font-weight:bold; font-size:10pt; text-align:left;">
<tr><td colspan=2>Explication :</td></tr>
<tr><td width="280">&nbsp;&nbsp;&nbsp;- NB   = Nombre</td><td>- TG5  = Transacs G5 reporté au 5 du mois suivant</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;- TNA  = Transacs Nouveaux Abonn&eacute;s</td><td>- TE   = Transacs en Erreur</td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;- TG   = Transacs Global</td><td>&nbsp;</td></tr>
</table>
</div>
<?php
	$headers = array('mois','#','Nb TNA','CA TTC TNA','#','Nb TG','CA TTC TG','#','Nb TG5','#','Nb TE','TTC TE');
	$select = array('DATE_FORMAT(dt,"%d-%m-%Y")',"'",'nb_transactions_nouveaux_abo','montant_transactions_nouveaux_abo','\'','nb_transactions_global_abo','montant_transactions_global_abo','\'','nb_transactions_G5','\'','nb_transactions_ERREUR','montant_transactions_ERREUR');
	echo $this->sql_to_html(24,'t_stats_daily','','',$headers,$select);
?>
<hr/>
<h3>ID_annonce des 15 dernieres erreurs G5:</h3>
<?php
	$headers = array('Date','post_property_id','Montant_Euro','code_reponse','comment','ref');
	$select = array('jdate','post_property_id','montant/100','code_reponse','comment','ref');
	echo $this->sql_to_html(15,'t_transacs_stats',"code_reponse in ('00151','00006','00001')",'id desc',$headers,$select);
?>
<hr/>
<h3>ID_annonce des 15 dernieres erreurs AUTRES:</h3>
<?php
	$headers = array('Date','post_property_id','Montant_Euro','code_reponse','comment','ref');
	$select = array('jdate','post_property_id','montant/100','code_reponse','comment','ref');
	echo $this->sql_to_html(15,'t_transacs_stats',"code_reponse not in ('00000','00151','00006','00001')",'id desc',$headers,$select);
?>
<hr/>
<h3>Abo premium CB en cours:</h3>
<hr/>
<h3>(A verifier!)Prévisionnel des reconductions (soustraction des peremption soustraite du total):</h3>
