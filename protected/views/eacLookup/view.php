<?php
/* @var $this EacLookupController */
/* @var $model EacLookup */
?>

<?php
$this->breadcrumbs=array(
	'Eac Lookups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EacLookup', 'url'=>array('index')),
	array('label'=>'Create EacLookup', 'url'=>array('create')),
	array('label'=>'Update EacLookup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EacLookup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EacLookup', 'url'=>array('admin')),
);
?>

<h1>View EacLookup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'type',
		'description',
		'eams_central_id',
	),
)); ?>