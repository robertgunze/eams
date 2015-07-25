<?php
/* @var $this IndicatorController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Indicators',
);

$this->menu=array(
	array('label'=>'Create Indicator','url'=>array('create')),
	array('label'=>'Manage Indicator','url'=>array('admin')),
);
?>

<h1>Indicators</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>