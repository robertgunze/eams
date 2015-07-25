<?php
/* @var $this EamsFrameworkTypeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eams Framework Types',
);

$this->menu=array(
	array('label'=>'Create EamsFrameworkType','url'=>array('create')),
	array('label'=>'Manage EamsFrameworkType','url'=>array('admin')),
);
?>

<h1>Eams Framework Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>