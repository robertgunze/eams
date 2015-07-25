<?php
/* @var $this IndicatorDataSourceController */
/* @var $model IndicatorDataSource */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Data Sources'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List IndicatorDataSource', 'url'=>array('index')),
	array('label'=>'Create IndicatorDataSource', 'url'=>array('create')),
	array('label'=>'View IndicatorDataSource', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IndicatorDataSource', 'url'=>array('admin')),
);
?>

    <?php echo TbHtml::pageHeader('', 'View Indicator Data Source' . $model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>