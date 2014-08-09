<div class="widget-content">
	<div class="widget-box">
		<?php
			$this->widget('bootstrap.widgets.TbGridView', array(
				'type'=>'striped bordered',
				'dataProvider' => $listProperyByUser->search(),
				//'filter' => $listProperyByUser,
				'htmlOptions'=>array('style'=>'padding-top:0'),
				'summaryText' => 'Affichage {start}-{end} de {count} résultats.',
				'emptyText'=>'Pas de résultats trouvés.',
				'itemsCssClass' => 'table-default items',
				'columns' => array(
					array(
						'header' => 'ID Annonce',
						'type' => 'raw',
						'value' => 'CHtml::link(CHtml::encode($data->id),array("/?property_id=$data->id"),array("target"=>"_parent"))'
					),
					array(
						'header' => 'Type',
						'type' => 'html',
						'value' => '$data->type_property == 1 ? "<span class=\"label label-info\">Vente</span>" : "<span class=\"label label-inverse\">Location</span>"'
					),
					array(
						'header' => 'Statut',
						'type' => 'html',
						'value' => array($this,'renderStatus'),
					),
				),
			));
		?>
	</div>
</div>
<script language="JavaScript">
$(document).ready(function(){
	var breadcrumb = window.parent.document.getElementById('breadcrumb');
	$(".widget-content").ajaxStop(function(){
		var iframe = window.parent.document.getElementById('iframeSame');
		$(iframe).height($(this).height());
		$(iframe).width($(breadcrumb).width()+30);
	});
});
	
</script>