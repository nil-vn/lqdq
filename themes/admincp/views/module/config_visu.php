<style>
	.form-horizontal .controls {margin-left: 234px;}
	.form-horizontal .control-label {width: 215px;}
</style>
<div class="">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo-admin.gif" />
	<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons"></span> CONFIGURATION DES DEMARCHAGES</h5>
			</div>
			<div class="widget-content">
				<table class="table-default items table table-striped table-bordered">
				<thead>
					<th>Numero démarchage</th>
					<th>Titre</th>
					<th>Descriptif interne</th>
					<th>Id_mail</th>
					<th>Date création</th>
					<th>Nombre d'annonces concernées</th>
					<th>Envoyer les mails</th>
				</thead>
				<tbody>
					<?php if(!empty($model)) foreach($model as $item):?>
					<tr>
						<td><?php echo $item['id_demarchage2'];?></td>
						<td><?php echo $item['demarchage2'];?></td>
						<td><?php echo $item['descriptif'];?></td>
						<td><?php echo $item['id_mail'];?></td>
						<td><?php echo date(Yii::app()->params['datetime'],strtotime($item['d']));?></td>
						<td>Nombre de pièce(s)</td>
						<td>Nombre de pièce(s)</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			</div>
			<button type="button" onclick="window.location.href='<?php echo PIUrl::createUrl('/module/configs');?>'" class="btn btn-warning">Retour</button>
		</div>
</div>
<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		var focused=true;
		function onFocusReload() {
			if (window.addEventListener) {
				window.addEventListener("blur", function(){focused=false;}, false);
				window.addEventListener("focus", function(){if(!focused){ javascript:window.location.reload() }}, false);
			} else if (document.addEventListener) {
				document.addEventListener("blur", function(){focused=false;}, false);
				document.addEventListener("focus", function(){if(!focused){ javascript:window.location.reload() }}, false);
			} else if (window.attachEvent) {
				window.attachEvent("onblur", function(){focused=false;}, false);
				window.attachEvent("onfocus", function(){if(!focused){ javascript:window.location.reload() }}, false);
			}
		}
		onFocusReload();
	});</script>