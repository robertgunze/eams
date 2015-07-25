<?php
/* @var $this EacFactsController */
/* @var $data EacFacts */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protocol_id')); ?>:</b>
	<?php echo CHtml::encode($data->protocol_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protocol_details')); ?>:</b>
	<?php echo CHtml::encode($data->protocol_details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protocol_provision_id')); ?>:</b>
	<?php echo CHtml::encode($data->protocol_provision_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protocol_provision_description')); ?>:</b>
	<?php echo CHtml::encode($data->protocol_provision_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_field_code')); ?>:</b>
	<?php echo CHtml::encode($data->data_field_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_field_desc')); ?>:</b>
	<?php echo CHtml::encode($data->data_field_desc); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('indicator_id')); ?>:</b>
	<?php echo CHtml::encode($data->indicator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicator_description')); ?>:</b>
	<?php echo CHtml::encode($data->indicator_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_collection_guidelines')); ?>:</b>
	<?php echo CHtml::encode($data->data_collection_guidelines); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numeric_data')); ?>:</b>
	<?php echo CHtml::encode($data->numeric_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alphanumeric_data')); ?>:</b>
	<?php echo CHtml::encode($data->alphanumeric_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_updated')); ?>:</b>
	<?php echo CHtml::encode($data->date_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	*/ ?>

</div>