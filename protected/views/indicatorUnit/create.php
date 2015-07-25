<?php
/* @var $this IndicatorUnitController */
/* @var $model IndicatorUnit */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Units'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IndicatorUnit', 'url'=>array('index')),
	array('label'=>'Manage IndicatorUnit', 'url'=>array('admin')),
);
?>

<h1>Create IndicatorUnit</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>