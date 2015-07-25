<?php
/* @var $this MdaController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Mdas',
);

$this->menu=array(
	array('label'=>'Create Mda','url'=>array('create')),
	array('label'=>'Manage Mda','url'=>array('admin')),
);
?>

<h1>Mdas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>