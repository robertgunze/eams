<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
?>

<?php
$this->breadcrumbs=array(
	'Eac Decisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EacDecision', 'url'=>array('index')),
	array('label'=>'Manage EacDecision', 'url'=>array('admin')),
);
?>

<h1>Create EacDecision</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>