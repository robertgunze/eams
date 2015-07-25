<?php
/* @var $this EamsFactsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eams Facts',
);

$this->menu=array(
	array('label'=>'Create EamsFacts','url'=>array('create')),
	array('label'=>'Manage EamsFacts','url'=>array('admin')),
);
?>

<h1>Eams Facts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>