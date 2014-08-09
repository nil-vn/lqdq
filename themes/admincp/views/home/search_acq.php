<div class="widget-box">
	<div class="tooltip-demo well" style="text-align:center">
		<h4 style="margin-bottom:5px">Ce tableau liste les clients inscrits en tant qu'acquereur "<?php echo $get;?>" </h4>
		<span class="label label-success">En ligne</span> 
		<span class="label label-important"> Désactivé/Supprimé</span> 
		<span class="label label-info">Autre statut </span>
	</div>
</div>
<?php if(!empty($model)):?>
<div class="label_top">Liste des Clients inscrit pour cet élément : "<?php echo $get;?>"</div>
<?php $this->widget('CLinkPager',array(
					'pages'=>$pages,
					'maxButtonCount'=>15,
					'header'=>'',
					'nextPageLabel'=>'Suiv >',
					'prevPageLabel'=>'< Prec',
					'firstPageLabel'=>'<< Les plus récents',
					'lastPageLabel'=>'Les plus ancien >>',
					'selectedPageCssClass'=>'active',
					'htmlOptions'=>array('class'=>'pagination')
					)
); ?>
<table class="table-default items table table-striped table-bordered search-acq-table">
<thead>
<tr>
	<th>id_acquereur</th><th>id_annonce</th><th>type_a</th><th>type_m</th><th>envoye </th><th>controle </th>
	<th>type_acquereur </th><th>genre </th><th>nom </th><th>Prenom </th><th>adresse</th><th>cp</th>
	<th>ville</th><th>tel</th><th>portable</th><th>email</th><th style="width:200px;float: right;">message_client</th><th>message_interne</th>
	<th>date_inscription</th><th>date_envoi</th><th>ip</th><th>visualisation</th><th>date_visualisation</th>
	<th>provenance</th><th>date_rappel</th><th>date_lecture</th><th>operateur</th>
</tr>
</thead>
<tbody>
<?php foreach($model as $mes):?>
	<tr>
		<td><?php echo $mes->id;?></td>
		<td><a target="_parent" class="badge <?php echo $mes->getClassByPropertyStatus();?>" href="<?php echo PIUrl::createUrl('/?property_id='.$mes->post_property_id);?>"><?php echo $mes->post_property_id;?></a></td>
		<td><?php echo $mes->post_property_type;?></td>
		<td><?php echo $mes->type_m;?></td>
		<td><?php echo $mes->envoye;?></td>
		<td><?php echo $mes->controle;?></td>
		<td><?php echo $mes->type;?></td>
		<td><?php echo $mes->customer_gender;?></td>
		<td><?php echo $mes->customer_last_name;?></td>
		<td><?php echo $mes->customer_first_name;?></td>
		<td><?php echo $mes->customer_address;?></td>
		<td><?php echo $mes->customer_code_postal;?></td>
		<td><?php echo $mes->customer_ville;?></td>
		<td><?php echo $mes->customer_tel;?></td>
		<td><?php echo str_replace(' ','',$mes->customer_phone);?></td>
		<td><?php echo $mes->customer_email;?></td>
		<td><?php echo $mes->customer_message;?></td>
		<td><?php echo $mes->internal_message;?></td>
		<td><?php if(!empty($mes->customer_registration_date)) echo date(Yii::app()->params['datetime'],strtotime($mes->customer_registration_date));?></td>
		<td><?php if(!empty($mes->created)) echo date(Yii::app()->params['datetime'],strtotime($mes->created));?></td>
		<td><?php echo $mes->customer_ip;?></td>
		<td><?php echo $mes->visualization;?></td>
		<td><?php if(!empty($mes->date_visualization)) echo date(Yii::app()->params['datetime'],strtotime($mes->date_visualization));?></td>
		<td><?php echo $mes->provenance;?></td>
		<td><?php if(!empty($mes->date_reminder)) echo date(Yii::app()->params['datetime'],strtotime($mes->date_reminder));?></td>
		<td><?php if(!empty($mes->reading_time)) echo date(Yii::app()->params['datetime'],strtotime($mes->reading_time));?></td>
		<td><?php echo $mes->operator;?></td>
	</tr>
<?php endforeach;?>
</tbody>
</table>
<?php $this->widget('CLinkPager',array(
					'pages'=>$pages,
					'maxButtonCount'=>15,
					'header'=>'',
					'nextPageLabel'=>'Suiv >',
					'prevPageLabel'=>'< Prec',
					'firstPageLabel'=>'<< Les plus récents',
					'lastPageLabel'=>'Les plus ancien >>',
					'selectedPageCssClass'=>'active',
					'htmlOptions'=>array('class'=>'pagination')
					)
); ?>
<?php else:?>
	<div style="margin-top:10px;text-align:center">Pas de résultats trouvés.</div>
<?php endif; ?>
<script>
$(document).ready(function(){
	$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
});
</script>
<style>.pagination .hidden{display: none;}</style>