<?php
	if (isset($_GET['dd'])) {
		$dd = $_GET['dd'];
	} else {
		$dd = date(Yii::app()->params['date'],strtotime('-6 month',strtotime(str_replace('/','-',date(Yii::app()->params['date'])))));
	}
	if (isset($_GET['df'])) {
		$df = $_GET['df'];
	} else {
		$df = date(Yii::app()->params['date']);
	}
?>
<form name="form" id="form" method="get" action="">
	Afficher les facture du 
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'dd',
			'id' => 'dd',
			// additional javascript options for the date picker plugin
			'options' => array(
				'format'=>'dd/mm/yyyy',
				'showAnim' => 'fold',
			),
			'htmlOptions' => array(
				'style' => 'height:20px;'
			),
			'language' => 'fr',
			'value' => $dd,
		));
	?>
	au 
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'df',
			'id' => 'df',
			// additional javascript options for the date picker plugin
			'options' => array(
				'format'=>'dd/mm/yyyy',
				'showAnim' => 'fold',
			),
			'htmlOptions' => array(
				'style' => 'height:20px;'
			),
			'language' => 'fr',
			'value' => $df,
		));
	?>
	<button id="recharger" type="submit" class="btn btn-default">Recharger</button>
	<a href="javascript:void(0);" style="width:151px;text-align:left" class="export_premium btn btn-default"><span class="text_content">Telecharger le fichier CSV</span></a>

</form>