<?php
/* @var $this EamsFrameworkTypeController */
/* @var $model EamsFrameworkType */
?>

<?php
$this->breadcrumbs=array(
	'Eams Framework Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EamsFrameworkType', 'url'=>array('index')),
	array('label'=>'Manage EamsFrameworkType', 'url'=>array('admin')),
);
?>

<h1>Create EamsFrameworkType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>