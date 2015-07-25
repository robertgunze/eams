<?php
/* @var $this IndicatorController */
/* @var $model Indicator */
?>

<?php
$this->breadcrumbs=array(
	'Indicators'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Indicator', 'url'=>array('index')),
	array('label'=>'Create Indicator', 'url'=>array('create')),
	array('label'=>'View Indicator', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Indicator', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'Update Indicator'.$model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>