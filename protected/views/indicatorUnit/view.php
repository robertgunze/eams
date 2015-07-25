<?php
/* @var $this IndicatorUnitController */
/* @var $model IndicatorUnit */
?>

<?php
$this->breadcrumbs=array(
	'Indicator Units'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List IndicatorUnit', 'url'=>array('index')),
	array('label'=>'Create IndicatorUnit', 'url'=>array('create')),
	array('label'=>'Update IndicatorUnit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IndicatorUnit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IndicatorUnit', 'url'=>array('admin')),
);
?>
<?php echo TbHtml::pageHeader('', 'View Indicator Unit' . $model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'unit',
		'abbrev',
	),
)); ?>