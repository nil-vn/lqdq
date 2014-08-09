<script src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/highcharts/js/highcharts.js"></script>
<script src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/stats/stats_premium.js"></script>
<script type="text/javascript">
	baseUrl = '<?php echo Yii::app()->createUrl('/'); ?>';
</script>
<p>
<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/logo-admin.gif');?>
</p>

<select class="stats-select" name="nb" id="nb" style="width:100px">
	<?php for ($nb = 2; $nb <= 12; $nb++) : ?>
	<option value="<?php echo $nb; ?>"><?php echo $nb; ?></option>
	<?php endfor; ?>
</select>
<select class="stats-select" name="delai" id="delai">
	<option value="d">Jours</option>
	<option value="w">Semaine</option>
	<option value="m">Mois</option>
	<option value="y">Année</option>
</select>
<div id="graph-container-premium" style="min-width: 310px; height: 350px; margin: 0 auto"></div>

<select class="stats-select-abonnement" name="nb-abonnement" id="nb-abonnement" style="width:100px">
	<?php for ($nb = 2; $nb <= 12; $nb++) : ?>
	<option value="<?php echo $nb; ?>"><?php echo $nb; ?></option>
	<?php endfor; ?>
</select>
<select class="stats-select-abonnement" name="delai-abonnement" id="delai-abonnement">
	<option value="d">Jours</option>
	<option value="w">Semaine</option>
	<option value="m">Mois</option>
	<option value="y">Année</option>
</select>
<div id="graph-container-premium-abonnement" style="min-width: 310px; height: 350px; margin: 0 auto"></div>

<!-- PREMIUM CB -->
<fieldset><legend>Premium en cours (CB)</legend></fieldset>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'	=>	$abonnementPremiumData,
	'columns'		=>	array(
		'id_annonce',
		array('name'=>'hebdomadaire','value'=>'$data->hebdomadaire==0?"NON":"OUI"'),
		'provenance',
		'nb_semaine',
		array('name'=>'date_creation','value'=>'substr($data->date_creation,0,10)'),
		array('name'=>'date_peremption','value'=>'substr($data->date_peremption,0,10)'),
		array('name'=>'montant_ttc','value'=>'$data->montant_ttc/100')
	)
)); ?>

<!-- PREMIUM CHEQUE -->
<fieldset><legend>Premium en cours (CHEQUE)</legend></fieldset>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'	=>	$abonnementPremiumDataCheck,
	'columns'		=>	array(
		'id_annonce',
		array('name'=>'hebdomadaire','value'=>'$data->hebdomadaire==0?"NON":"OUI"'),
		'provenance',
		array('name'=>'nb_semaine','header'=>'Durée', 'value'=>'$data->nb_semaine ." semaine(s)"'),
		array('name'=>'montant_ttc','header'=>'Montant en €','value'=>'$data->montant_ttc/100')
	)
)); ?>

<fieldset><legend>Bon de commande (CHEQUE EN ATTENTE)</legend></fieldset>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'	=>	$abonnementPremiumDataCheckAttente,
	'columns'		=>	array(
		'post_property_id',
		array('name'=>'date_creation','value'=>'substr($data->date_creation,0,10)'),
		'provenance',
		array('name'=>'nb_jours','value'=>'$data->nb_jours ."  jours"'),
		array('name'=>'montant_ttc','value'=>'$data->montant_ttc/100'),
		array('name'=>'visu_client','value'=>'$data->visu_client==0?"NON":"OUI"'),
	)
)); ?>

<fieldset><legend>Premium d&eacute;sactiv&eacute; </legend></fieldset>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'	=>	$abonnementPremiumDataDeactive,
	'columns'		=>	array(
		'id_annonce',
		array('name'=>'date_peremption','value'=>'substr($data->date_peremption,0,10)'),
		array('name'=>'date_desabonnement','value'=>'substr($data->date_desabonnement,0,10)'),
		array('name'=>'nb_semaine','value'=>'$data->nb_semaine ." semaine(s)"'),
		array('name'=>'montant_ttc','value'=>'$data->montant_ttc/100'),
		array('name'=>'comm_desabonnement','value'=>'$data->comm_desabonnement==""?"":"Info"')
	)
)); ?>