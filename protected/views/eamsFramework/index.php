<?php
/* @var $this EamsFrameworkController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eams Frameworks',
);

$this->menu=array(
	array('label'=>'Create EamsFramework','url'=>array('create')),
	array('label'=>'Manage EamsFramework','url'=>array('admin')),
);
?>

<h1>Eams Frameworks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>