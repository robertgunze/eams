<?php
/* @var $this EamsFactsController */
/* @var $data EamsFacts */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('framework_ind_id')); ?>:</b>
	<?php echo CHtml::encode($data->framework_ind_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_id')); ?>:</b>
	<?php echo CHtml::encode($data->time_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_ref_date')); ?>:</b>
	<?php echo CHtml::encode($data->data_ref_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indicator_value')); ?>:</b>
	<?php echo CHtml::encode($data->indicator_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />


</div>