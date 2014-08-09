$('document').ready(function(){
	drawStats($('#nb').val(), $('#delai').val(),'premium',function(){
		drawStats($('#nb-abonnement').val(), $('#delai-abonnement').val(),'abonnement',null);
	});


	$('.stats-select').change(function(){
		drawStats($('#nb').val(), $('#delai').val(),'premium',null);
	});
	$('.stats-select-abonnement').change(function(){
		drawStats($('#nb-abonnement').val(), $('#delai-abonnement').val(),'abonnement',null);
	});
});

function drawStats(nb, delai, type,callback){
	if(type == 'abonnement'){
		urlLink = 'statsDataPremiumAbonnement';
		renderTo = 'graph-container-premium-abonnement';
		seriesName = ['CA Total','Nb abo 1€','Nb abo 46,80€','Nb abo 134,40€','Nb abo 22,40€','Nb abo 28,00€'];
	}else if(type == 'premium'){
		urlLink = 'statsDataPremium';
		renderTo = 'graph-container-premium';
		seriesName = ['CA Total','Cumul abo 1€','Cumul abo 46,80€','Cumul abo 134,40€','Cumul abo 22,40€','Cumul abo 28,00€','Cumul abo 84,00€'];
	}else
		return true;
	$.ajax({
		url: baseUrl + 'module/'+ urlLink + '?nb=' + nb + '&delai=' + delai,
		type: 'GET',
		dataType: 'json',
		success: function(res)
		{
			if (res.code != 200) return;
			categories = [];
			
			series = [];
			for (var i = 0; i < seriesName.length; i++) {
				series.push({
					name:seriesName[i],
					data:[]
				});
			};
			$.each(res.stats, function(index, val) {
				categories[categories.length] = val.x;
				arrDatas = [val.y,val.y2,val.y3,val.y4,val.y5,val.y6,val.y7];
				for (var i = 0; i < series.length; i++) {
					series[i].data[series[i].data.length] = parseInt(arrDatas[i]);
				};
			});

			options = {
				chart: {
					renderTo: renderTo,
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
			if(callback)
				callback();
		}
	});
}