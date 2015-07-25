<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
?>

<?php
$this->breadcrumbs=array(
	'Eac Decisions'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List EacDecision', 'url'=>array('index')),
	array('label'=>'Create EacDecision', 'url'=>array('create')),
	array('label'=>'View EacDecision', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EacDecision', 'url'=>array('admin')),
);
?>

    <?php echo TbHtml::pageHeader('', 'Update EAC Decision'.$model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>