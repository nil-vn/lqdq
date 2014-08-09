<ul class="breadcrumb" id="breadcrumb">
	<li><span class="badge badge-success"><strong><?php echo UserModule::t("List User"); ?></strong></span></li>
</ul>
<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
?>
<div class="row">
	<div class="span12">
		<div class="widget-content">
			<div class="widget-box">
				<?php $this->widget('bootstrap.widgets.TbGridView', array(
					'dataProvider'=>$dataProvider,
					'itemsCssClass' => 'table-default items table table-striped table-bordered',
					'columns'=>array(
						array(
							'name' => 'username',
							'type'=>'raw',
							'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
						),
						'create_at',
						'lastvisit_at',
					),
				)); ?>
			</div>
		</div>
	</div>
</div>
