<div>
	<h2>Index stats [<?php echo "$month/$year"; ?>]</h2>
	<div>
		<div>Indexing day: <strong><span id="js-current-d">1</span></strong></div>
		<div>Total days: <strong><span><?php echo $endDay; ?></span></strong></div>
	</div>
</div>

<script>
$('document').ready(function(){
	var urlInsertStats = '<?php echo Yii::app()->createUrl('/module/insertStats'); ?>?date=<?php echo "{$year}-{$month}-"; ?>';
	function index(day)
	{
		$('#js-current-d').html(day);
		$.ajax({
			url: urlInsertStats + day,
			success: function(res)
			{
				if (day < <?php echo $endDay; ?>) {
					index(day + 1);
				} else {
					$('#js-current-d').html(day + ' [OK]');
				}
			}
		});
	}
	index(<?php echo $beginDay; ?>);
});
</script>