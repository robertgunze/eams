<?php
/* @var $this EacStatusLogController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eac Status Logs',
);

$this->menu=array(
	array('label'=>'Create EacStatusLog','url'=>array('create')),
	array('label'=>'Manage EacStatusLog','url'=>array('admin')),
);
?>

<h1>Eac Status Logs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>