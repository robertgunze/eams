<?php
/* @var $this LoginController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Logins',
);

$this->menu=array(
	array('label'=>'Create Login','url'=>array('create')),
	array('label'=>'Manage Login','url'=>array('admin')),
);
?>

<h1>Logins</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>