<ul class="breadcrumb" id="breadcrumb">

	<li><span class="badge badge-success"><strong><?php echo Rights::t('core', 'Operations'); ?></strong></span> -</li>
	<li><span class=""><?php echo Rights::t('core', 'An operation is a permission to perform a single operation, for example accessing a certain controller action.'); ?></span></li>
</ul>
<p class="well">
	<?php echo Rights::t('core', 'An operation is a permission to perform a single operation, for example accessing a certain controller action.'); ?><br />
	<?php echo Rights::t('core', 'Operations exist below tasks in the authorization hierarchy and can therefore only inherit from other operations.'); ?>
</p>
<button class="btn">
	<?php echo CHtml::link(Rights::t('core', 'Create a new operation'), array('authItem/create', 'type'=>CAuthItem::TYPE_OPERATION), array(
		'class'=>'add-operation-link',
	)); ?>
</button>
<div class="row">
	<div class="span12">
		<div class="widget-content">
			<div class="widget-box">
				<?php $this->widget('bootstrap.widgets.TbGridView', array(
				    'dataProvider'=>$dataProvider,
				    'template'=>'{items}',
				    'emptyText'=>Rights::t('core', 'No operations found.'),
				    'htmlOptions'=>array('class'=>'grid-view operation-table sortable-table'),
					'itemsCssClass' => 'table-default items table table-striped table-bordered',
				    'columns'=>array(
				    	array(
			    			'name'=>'name',
			    			'header'=>Rights::t('core', 'Name'),
			    			'type'=>'raw',
			    			'htmlOptions'=>array('class'=>'name-column'),
			    			'value'=>'$data->getGridNameLink()',
			    		),
			    		array(
			    			'name'=>'description',
			    			'header'=>Rights::t('core', 'Description'),
			    			'type'=>'raw',
			    			'htmlOptions'=>array('class'=>'description-column'),
			    		),
			    		array(
			    			'name'=>'bizRule',
			    			'header'=>Rights::t('core', 'Business rule'),
			    			'type'=>'raw',
			    			'htmlOptions'=>array('class'=>'bizrule-column'),
			    			'visible'=>Rights::module()->enableBizRule===true,
			    		),
			    		array(
			    			'name'=>'data',
			    			'header'=>Rights::t('core', 'Data'),
			    			'type'=>'raw',
			    			'htmlOptions'=>array('class'=>'data-column'),
			    			'visible'=>Rights::module()->enableBizRuleData===true,
			    		),
			    		array(
			    			'header'=>'&nbsp;',
			    			'type'=>'raw',
			    			'htmlOptions'=>array('class'=>'actions-column'),
			    			'value'=>'$data->getDeleteOperationLink()',
			    		),
				    )
				)); ?>
			</div>
		</div>
	</div>
</div>
<p class="info"><?php echo Rights::t('core', 'Values within square brackets tell how many children each item has.'); ?></p>