<style>
	.form-horizontal .controls {margin-left: 234px;}
	.form-horizontal .control-label {width: 215px;}
	.btn.sub{width: 100%;}
	.firstTable th{text-align: center;font-size:11px;line-height:12px}
	.firstTable td{text-align: center;}
	.valideno td{background:#ccc!important;}
	.widget-content th{display: table-cell!important;vertical-align: middle!important;}
</style>
<div class="" style="width:950px;margin:0 auto;">
	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo-admin.gif" />
	<div class="nonboxy-widget">
		<div class="widget-head">
			<h5> <span class="color-icons"></span> CONFIGURATION DES OFFRES PROMOTIONNELLES</h5>
		</div>
		<p class="help-block" style="color:red">Toute modification sur la date de récursivité d'une offre sera prise en compte lors de l'envoi de l'offre précédente.</p>
		<p class="help-block" style="color:red">Il est impossible d'insérer ou modifier une nouvelle offre à la place d'une offre comportant le même numéro d'offre (ce numéro correspond à l'ordre de démarchage)</p>
		
		<div class="widget-content">
			<table class="table-default items table table-striped table-bordered firstTable">
			<thead>
				<th style="width: 20px;">Numero offre</th>
				<th style="width: 125px;">Titre</th>
				<th style="width: 350px;">Descriptif interne</th>
				<th style="width: 51px;">Attente entre les offres</th>
				<th>Validité offre</th>
				<th>Montant TTC</th>
				<th>Active</th>
				<th colspan="2"></th>
				<th style="width: 51px;">Nombre d'annonces concernées</th>
			</thead>
			<tbody>
			<?php if(!empty($model)) foreach($model as $item):?>
				<tr <?php if($item['valide'] == 0) echo 'class="valideno"';?>>
					<td><?php echo $item['num_demarchage'];?></td>
					<td><?php echo $item['titre'];?></td>
					<td><textarea class="offerCom" id="txtCom<?php echo $item['num_demarchage'];?>" style="width:98%"><?php echo $item['com'];?></textarea><button uuid="<?php echo $item['num_demarchage'];?>" class="btn sub saveComOffer">OK</button></td>
					<td><?php echo $item['recursivite']; ?>J</td>
					<td><?php echo $item['validite_offre']; ?></td>
					<td><?php echo $item['montant_ttc']/100; ?></td>
					<td><?php echo $item['valide'] == 1 ? 'OUI' : 'NON'; ?></td>
					<td><a href="<?php echo PIUrl::createUrl('/module/configOfferVisuEdit',array('id'=>$item['num_demarchage']));?>"><span class="color-icons add_co"></span></a></td>
					<td><a onclick="return confirm('Voulez vous vraiment supprimer cette offre car cela peut provoquer des bogues pour les clients ayant souscrit à cette offre ?')" href="<?php echo PIUrl::createUrl('/module/configOfferVisuDel',array('id'=>$item['num_demarchage']));?>"><span class="color-icons cross_co"></span></a></td>
					<td><a href="javascript:void(0)"><?php echo $item['num_demarchage'];?></span></a></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<div style="text-align:center">
			<button class="btn" onclick="window.location.href='<?php echo PIUrl::createUrl('/module/configOfferVisuAdd'); ?>'" type="button">Creer une nouvelle offre</button>
		</div>
		</div>
	</div>
	
	<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons"></span> CONFIGURATION DES CONDITIONS GENERALES</h5>
			</div>
			<div class="widget-content">
				<table class="table-default items table table-striped table-bordered firstTable">
					<thead>
						<th style="width:200px">Numéro d'offre correspondant</th>
						<th>Conditions générales</th>
						<th colspan="2"></th>
					</thead>
					<tbody>
					<?php if(!empty($offerGenerales)) foreach($offerGenerales as $item1):?>
						<tr>
							<td><?php echo $item1['num_demarchage'];?></td>
							<td><textarea disabled="disabled" style="width:95%;height:100px"><?php echo $item1['condition'];?></textarea></td>
							<td style="width:20px"><a class="btnEditGenarel" href="<?php echo PIUrl::createUrl('/module/configOfferVisuModifiGenerale',array('id'=>$item1['id_cg']));?>"><span class="color-icons add_co"></span></a></td>
							<td style="width:20px"><a onclick="return confirm('Voulez vous vraiment supprimer cette condition generale car cela peut provoquer des bogues pour les clients voulant souscrire à cette offre ?')" href="<?php echo PIUrl::createUrl('module/configOfferVisuDelGenerale',array('id'=>$item1['id_cg']));?>"><span class="color-icons cross_co"></span></a></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
	</div>
	
	
	<div class="nonboxy-widget">
			<div class="widget-head">
				<h5> <span class="color-icons"></span> <?php echo empty($offerGenerales) ? "Aucune condition générale existante pour les offres promotionnelles..." : "CREER DES CONDITIONS GENERALES";?></h5>
			</div>
			<div class="widget-content">
				<form class="form-horizontal well" action="<?php echo PIUrl::createUrl('/module/configOfferVisuAddGenerale');?>" method="POST">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="my_postal_code">Numéro d'offre concerné : </label>
							<div class="controls">
								<input name="num_demarchage" style="width:100%" type="text" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Conditions générales de vente: </label>
							<div class="controls">
								<textarea name="condition" style="width:100%"></textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button class="btn" type="submit">Creer</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
	</div>
	
	
	
	<button type="button" href="<?php echo PIUrl::createUrl('/module/configs'); ?>" class="btn btn-warning BTNVretour">Retour</button>
</div>
<script>
	$(document).ready(function(){
		$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
		$(".BTNVretour, .btnEditGenarel").click(function(){
			window.parent.$.fancybox.close();
			window.parent.$.fancybox.open({
				type: 'iframe',
				width:667,
				href: $(this).attr('href')
			});
		});
		$('.offerCom').live('focus',function(){
			$(this).css('color','red');
		});
		$(".saveComOffer").live('click',function(){
			var _this = $(this);
			var id = $(this).attr('uuid');
			var com = $('#txtCom'+id).val();
			$('#txtCom'+id).css('color','#000');
			$.post(webroot+'/module/configOfferVisuAddCom',{'id':id,'com':com},function(res){
				if(res.error === true){
					alert(res);
				}
			});
		});
	});
</script>