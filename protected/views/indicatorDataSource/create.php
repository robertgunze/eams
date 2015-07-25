<?php
/* @var $this IndicatorDataSourceController */
/* @var $model IndicatorDataSource */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Data Sources'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IndicatorDataSource', 'url'=>array('index')),
	array('label'=>'Manage IndicatorDataSource', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'Create Indicator Data Source'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>