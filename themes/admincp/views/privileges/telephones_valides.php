<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/privilege/filter.js"></script>
<br>
<h3>Nombre de téléphones traités par jour sur les 10 derniers jours:</h3>
<style type="text/css" media="screen"> #ver-minimalist { font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif; font-size: 12px; width: 480px; text-align: right; border-collapse: collapse; margin: 30px 30px 30px 15px; color: #333; } table { border-collapse: collapse; border-spacing: 0; } #ver-minimalist th { font-weight: normal; font-size: 14px; border-bottom: 2px solid #6678b1; border-right: 30px solid #fff; border-left: 30px solid #fff; color: #039; padding: 8px 2px; } #ver-minimalist td { border-right: 30px solid #fff; border-left: 30px solid #fff; color: #669; padding: 12px 2px 0; }    </style>
<table id="ver-minimalist" class="table table-bordered">
	<thead>
    <tr>
    <th scope="col">[dbo].[f_get_date_round_day]([d])</th>
    <th scope="col">count(*)</th>
    </tr>
    </thead>
    <tbody>
		<?php
		$arrUserMeta = CHtml::listData($model,'telephone','date');
		foreach ($arrUserMeta as $key => $value) {
			$arrUserMeta[$key] = date('Y-m-d',strtotime($value));
		}
		$arrDates = array_count_values($arrUserMeta);
		foreach($arrDates as $key => $value) {
		?>
    <tr>
    <td><?php echo date('Y-m-d',strtotime($key));?></td>
    <td><?php echo $value;?></td>
    </tr>
		<?php }?>
    </tbody>
</table>
<br><br>
<h3>30 derniers numeros traités:</h3>
<style type="text/css" media="screen"> #ver-minimalist { font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif; font-size: 12px; width: 480px; text-align: right; border-collapse: collapse; margin: 30px 30px 30px 15px; color: #333; } table { border-collapse: collapse; border-spacing: 0; } #ver-minimalist th { font-weight: normal; font-size: 14px; border-bottom: 2px solid #6678b1; border-right: 30px solid #fff; border-left: 30px solid #fff; color: #039; padding: 8px 2px; } #ver-minimalist td { border-right: 30px solid #fff; border-left: 30px solid #fff; color: #669; padding: 12px 2px 0; }    </style>
<table id="ver-minimalist" class="table table-bordered">
    <thead>
    <tr>
    <th scope="col">[d]</th>
    <th scope="col">[telephone]</th>
    <th scope="col">[isvalide]</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($model as $data) {?>
    <tr>
    <td><?php echo $data['date'];?></td>
			<td><?php echo $data['telephone'];?></td>
    <td><?php echo $data['isvalide'];?></td>
    </tr>
		<?php }?>
    </tbody>
</table>