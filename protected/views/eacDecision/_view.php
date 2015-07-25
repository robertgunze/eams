<?php
/* @var $this EacDecisionController */
/* @var $data EacDecision */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eams_central_id')); ?>:</b>
	<?php echo CHtml::encode($data->eams_central_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('decision_reference')); ?>:</b>
	<?php echo CHtml::encode($data->decision_reference); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('decision_date')); ?>:</b>
	<?php echo CHtml::encode($data->decision_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('budgetary_implications')); ?>:</b>
	<?php echo CHtml::encode($data->budgetary_implications); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_frame')); ?>:</b>
	<?php echo CHtml::encode($data->time_frame); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('performance_indicators')); ?>:</b>
	<?php echo CHtml::encode($data->performance_indicators); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsibility_center')); ?>:</b>
	<?php echo CHtml::encode($data->responsibility_center); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meeting_no')); ?>:</b>
	<?php echo CHtml::encode($data->meeting_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sectoral_council_id')); ?>:</b>
	<?php echo CHtml::encode($data->sectoral_council_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('implementation_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->implementation_status_id); ?>
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