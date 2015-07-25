<?php
/* @var $this IndicatorUnitController */
/* @var $model IndicatorUnit */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Units'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List IndicatorUnit', 'url'=>array('index')),
	array('label'=>'Create IndicatorUnit', 'url'=>array('create')),
	array('label'=>'View IndicatorUnit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IndicatorUnit', 'url'=>array('admin')),
);
?>

     <?php echo TbHtml::pageHeader('', 'View Indicator Unit' . $model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>