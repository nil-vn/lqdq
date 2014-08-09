<?php
	$profile = $_GET['profile']."%";
	if(isset($_GET['like']))
		$profile = '%'.$profile;
	$label = 'Liste des Clients inscrit pour cet élément : "'.$profile.'"';
?>
<div class="widget-box">
	<div class="tooltip-demo well" style="text-align:center">
		<p>Il est aussi possible de chercher <strong><?php echo $_GET['profile'];?></strong> dans la <a target="_blank" href="<?php echo PIUrl::createUrl('/home/searchAcq?email='.$_GET['profile']);?>">Base Acquéreurs</a> </p>
		<span class="label label-success">En ligne</span> 
		<span class="label label-warning">Hors Ligne</span> 
		<span class="label label-important"> Désactivé/Supprimé</span> 
		<span class="label label-info">Autre statut </span>
	</div>
</div>
<div class="label_top"><?php echo $label;?></div>
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
<table class="table-default items table table-bordered search-acq-table">
<thead>
<tr>
<th>Nom</th><th>Prenom</th><th>Email</th><th>Password</th><th>Tel1</th><th>Tel2</th><th>Reference</th><th>Date de depot</th><th>Type annonce</th><th>Type mandat</th><th>Statut</th></tr>
</thead>
<tbody>
<?php if(!empty($model)) foreach($model as $item):?>
<tr class="<?php echo $item->getClassByPropertyStatus();?>">
	<td><?php echo $item->userSearch->first_name;?></td>
	<td><?php echo $item->userSearch->last_name;?></td>
	<td><?php echo $item->userSearch->user_email;?></td>
	<td><?php echo isset($modelPass[$item->user_id])?$modelPass[$item->user_id]:'';?></td>
	<td><?php echo $item->userSearch->landline;?></td>
	<td><?php echo $item->userSearch->mobile_phone;?></td>
	<td style="text-align:center"><a target="_parent" class="badge <?php echo $item->getClassByPropertyStatus();?>" href="<?php echo PIUrl::createUrl('/?property_id='.$item->id);?>"><?php echo $item->id;?></a></td>
	<td><?php echo $item->created != '0000-00-00 00:00:00' ? date(Yii::app()->params['datetime'],strtotime($item->created)) : '';?></td>
	<td><?php echo $item->type_property == 1 ? 'Vente' : 'Location'?></td>
	<td><?php echo $item->getPaymentLabel();?></td><td><?php echo $item->getStatus(false);?></td>
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
<script>
$(document).ready(function(){
	$("html").niceScroll({cursorcolor:"#bbb",cursorwidth:"7px"});
});
</script>
<style>.pagination .hidden{display: none;}</style>