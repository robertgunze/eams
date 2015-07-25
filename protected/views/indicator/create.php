<?php
/* @var $this IndicatorController */
/* @var $model Indicator */
?>

<?php
$this->breadcrumbs=array(
	'Indicators'=>array('admin'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List Indicator', 'url'=>array('index')),
//	array('label'=>'Manage Indicator', 'url'=>array('admin')),
//);
?>


<?php echo TbHtml::pageHeader('', 'Create Indicator'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
