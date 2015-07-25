<?php
/* @var $this MeacOfficeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Meac Offices',
);

$this->menu=array(
	array('label'=>'Create MeacOffice','url'=>array('create')),
	array('label'=>'Manage MeacOffice','url'=>array('admin')),
);
?>

<h1>Meac Offices</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>