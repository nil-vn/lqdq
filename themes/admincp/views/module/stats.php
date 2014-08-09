<script src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/highcharts/js/highcharts.js"></script>
<script src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/highcharts/js/modules/exporting.js"></script>
<select class="stats-select" name="stat" id="stat">
	<option value="annonce_depot">Dépôt d'annonce</option>
	<option value="annonce_enligne">Annonce en ligne</option>
	<option value="annonce_prelevement">Prélevements</option>
	<option value="annonce_souscription">Souscription abonnement</option>
	<option value="passerelle_depot">Passerelles dépôt</option>
	<option value="passerelle_enligne">Passerelles enligne</option>
</select>
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
<div id="graph-container" style="min-width: 310px; height: 350px; margin: 0 auto"></div>
<hr/>
<div>
	<h3>En ligne actuellement</h3>
	<ul>
		<li>
			<?php echo $nb_premium; ?> ANNONCES PREMIUMS en ligne (<a href="<?php echo Yii::app()->createUrl('/module/stats_premium'); ?>" target="_blank">+ de détails</a>)
		</li>
		<li>
			<?php echo $nb_privilege; ?> ANNONCES PRIVILEGES en ligne (<a href="<?php echo Yii::app()->createUrl('/privileges'); ?>" target="_blank">+ de détails</a>)
		</li>
		<li>
			<?php echo $nb_gratuite; ?> ANNONCES GRATUITES en ligne
		</li>
		<li>
			<?php echo $nb_decouverte; ?> ANNONCES DECOUVERTES en ligne
		</li>
		<li>
			<?php echo $nb_agence; ?> ANNONCES AGENCE en ligne
		</li>
		<li>
			<a href="<?php echo Yii::app()->createUrl('/'); ?>" target="_blank">Satistiques offres promotionnelles</a>
		</li>
	</ul>
</div>


<script type="text/javascript">
function drawStats(stat, nb, delai)
{
	$.ajax({
		url: '<?php echo Yii::app()->createUrl('/module/statsData'); ?>' + '?stat=' + stat + '&nb=' + nb + '&delai=' + delai,
		type: 'GET',
		dataType: 'json',
		success: function(res)
		{
			if (res.code != 200) return;
			categories = [];
			series = [];
			series[0] = {
				name: 'Total',
				data: []
			};
			series[1] = {
				name: 'Annonce de vente',
				data: []
			};
			series[2] = {
				name: 'Annonce de location',
				data: []
			};
			$.each(res.stats, function(index, val) {
				categories[categories.length] = val.x;
				series[0].data[series[0].data.length] = parseInt(val.y);
				series[1].data[series[1].data.length] = parseInt(val.y2);
				series[2].data[series[2].data.length] = parseInt(val.y3);
			});

			options = {
				chart: {
					renderTo: 'graph-container',
					type: 'spline'
				},
				title: {
					text: '',
					x: -20 //center
				},
				xAxis: {
					categories: categories
				},
				yAxis: {
					title: {
						text: 'Annonce'
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}],
					min: 0
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle',
					borderWidth: 0
				},
				credits: {
					enabled: false
				},
				series: series
			};

			var chart = new Highcharts.Chart(options);
		}
	});
}

$('document').ready(function(){
	drawStats($('#stat').val(), $('#nb').val(), $('#delai').val());

	$('.stats-select').change(function(){
		drawStats($('#stat').val(), $('#nb').val(), $('#delai').val());
	});
});

</script>