<?php
/* @var $this IndicatorDataSourceController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Data Sources',
);

$this->menu=array(
	array('label'=>'Create IndicatorDataSource','url'=>array('create')),
	array('label'=>'Manage IndicatorDataSource','url'=>array('admin')),
);
?>

<h1>Indicator Data Sources</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>