<?php
/* @var $this IndicatorUnitController */
/* @var $data IndicatorUnit */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abbrev')); ?>:</b>
	<?php echo CHtml::encode($data->abbrev); ?>
	<br />


</div>