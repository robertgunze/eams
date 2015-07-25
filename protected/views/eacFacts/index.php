<?php
/* @var $this EacFactsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eac Facts',
);

$this->menu=array(
	array('label'=>'Create EacFacts','url'=>array('create')),
	array('label'=>'Manage EacFacts','url'=>array('admin')),
);
?>

<h1>Eac Facts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>