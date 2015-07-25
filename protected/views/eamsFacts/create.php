<?php
/* @var $this EamsFactsController */
/* @var $model EamsFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eams Facts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EamsFacts', 'url'=>array('index')),
	array('label'=>'Manage EamsFacts', 'url'=>array('admin')),
);
?>

<h1>Create EamsFacts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>