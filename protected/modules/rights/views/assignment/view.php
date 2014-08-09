<ul class="breadcrumb" id="breadcrumb">

	<li><span class="badge badge-success"><strong><?php echo Rights::t('core', 'Assignments'); ?></strong></span> -</li>
	<li><span class=""><?php echo Rights::t('core', 'Here you can view which permissions has been assigned to each user.'); ?></span></li>
</ul>
<div class="row">
	<div class="span12">
		<div class="widget-content">
		<div class="widget-box">
			
			<?php $this->widget('bootstrap.widgets.TbGridView', array(
			    'dataProvider'=>$dataProvider,
			    'template'=>"{items}\n{pager}",
			    'emptyText'=>Rights::t('core', 'No users found.'),
			    'htmlOptions'=>array('class'=>'grid-view assignment-table'),
			    'itemsCssClass' => 'table-default items table table-striped table-bordered',
				'columns'=>array(
		    		array(
		    			'name'=>'name',
		    			'header'=>Rights::t('core', 'Name'),
		    			'type'=>'raw',
		    			'htmlOptions'=>array('class'=>'name-column'),
		    			'value'=>'$data->getAssignmentNameLink()',
		    		),
		    		array(
		    			'name'=>'assignments',
		    			'header'=>Rights::t('core', 'Roles'),
		    			'type'=>'raw',
		    			'htmlOptions'=>array('class'=>'role-column'),
		    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
		    		),
					array(
		    			'name'=>'assignments',
		    			'header'=>Rights::t('core', 'Tasks'),
		    			'type'=>'raw',
		    			'htmlOptions'=>array('class'=>'task-column'),
		    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
		    		),
					array(
		    			'name'=>'assignments',
		    			'header'=>Rights::t('core', 'Operations'),
		    			'type'=>'raw',
		    			'htmlOptions'=>array('class'=>'operation-column'),
		    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
		    		),
			    )
			)); ?>
		</div>
		</div>
	</div>
</div>