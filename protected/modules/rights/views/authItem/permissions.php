<div id="permissions"><div id="permissions">
<ul class="breadcrumb" id="breadcrumb">

	<li><span class="badge badge-success"><strong><?php echo Rights::t('core', 'Permissions'); ?></strong></span> -</li>
	<li><span class=""><?php echo Rights::t('core', 'Here you can view and manage the permissions assigned to each role.'); ?></span></li>
</ul>
<p class="well">
	<?php echo Rights::t('core', 'Here you can view and manage the permissions assigned to each role.'); ?><br />
	<?php echo Rights::t('core', 'Authorization items can be managed under {roleLink}, {taskLink} and {operationLink}.', array(
		'{roleLink}'=>CHtml::link(Rights::t('core', 'Roles'), array('authItem/roles')),
		'{taskLink}'=>CHtml::link(Rights::t('core', 'Tasks'), array('authItem/tasks')),
		'{operationLink}'=>CHtml::link(Rights::t('core', 'Operations'), array('authItem/operations')),
	)); ?>
</p>
<button class="btn">
	<?php echo CHtml::link(Rights::t('core', 'Generate items for controller actions'), array('authItem/generate'), array(
		'class'=>'generator-link',
	)); ?>
</button>

<div class="row">
	<div class="span12">
		<div class="widget-content">
			<div class="widget-box">
				<?php $this->widget('bootstrap.widgets.TbGridView', array(
					'dataProvider'=>$dataProvider,
					'template'=>'{items}',
					'emptyText'=>Rights::t('core', 'No authorization items found.'),
					'htmlOptions'=>array('class'=>'grid-view permission-table'),
					'itemsCssClass' => 'table-default items table table-striped table-bordered',
					'columns'=>$columns,
				)); ?>
			</div>
		</div>
	</div>
</div>
	<p class="info">*) <?php echo Rights::t('core', 'Hover to see from where the permission is inherited.'); ?></p>
</div></div>
	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Rights::t('core', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>
