<?php
/* @var $this IndicatorUnitController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Units',
);

$this->menu=array(
	array('label'=>'Create IndicatorUnit','url'=>array('create')),
	array('label'=>'Manage IndicatorUnit','url'=>array('admin')),
);
?>

<h1>Indicator Units</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>