<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_annonce')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_annonce), array('view', 'id_annonce'=>$data->id_annonce)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hebdomadaire')); ?>:</b>
	<?php echo CHtml::encode($data->hebdomadaire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provenance')); ?>:</b>
	<?php echo CHtml::encode($data->provenance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nb_semaine')); ?>:</b>
	<?php echo CHtml::encode($data->nb_semaine); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_creation')); ?>:</b>
	<?php echo CHtml::encode($data->date_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_peremption')); ?>:</b>
	<?php echo CHtml::encode($data->date_peremption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('montant_ttc')); ?>:</b>
	<?php echo CHtml::encode($data->montant_ttc); ?>
	<br />
</div>