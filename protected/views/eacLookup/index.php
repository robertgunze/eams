<?php
/* @var $this EacLookupController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eac Lookups',
);

$this->menu=array(
	array('label'=>'Create EacLookup','url'=>array('create')),
	array('label'=>'Manage EacLookup','url'=>array('admin')),
);
?>

<h1>Eac Lookups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>