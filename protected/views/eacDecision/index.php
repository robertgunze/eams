<?php
/* @var $this EacDecisionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eac Decisions',
);

$this->menu=array(
	array('label'=>'Create EacDecision','url'=>array('create')),
	array('label'=>'Manage EacDecision','url'=>array('admin')),
);
?>

<h1>Eac Decisions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>