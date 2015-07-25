<?php
/* @var $this EacStatusLogController */
/* @var $model EacStatusLog */
?>

<?php
$this->breadcrumbs=array(
	'Eac Status Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EacStatusLog', 'url'=>array('index')),
	array('label'=>'Manage EacStatusLog', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('','Status Update'); ?>
<div class="well" style="background-color:#F9F9F9;color:#56AD56;">	
	<p><strong>Decision Description:</strong><br /><span style="color:#777777;"><?php echo $decision->description?></span></p>
	<p><strong>Decision Reference:</strong><?php echo $decision->decision_reference?></p>
</div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>