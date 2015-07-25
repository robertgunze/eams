<?php
/* @var $this EacStatusLogController */
/* @var $model EacStatusLog */
?>

<?php
$this->breadcrumbs=array(
	'Eac Status Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EacStatusLog', 'url'=>array('index')),
	array('label'=>'Create EacStatusLog', 'url'=>array('create')),
	array('label'=>'Update EacStatusLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EacStatusLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EacStatusLog', 'url'=>array('admin')),
);
?>

<h1>View EacStatusLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'status_id',
		'remarks',
		'create_user_id',
		'date_created',
		'update_user_id',
		'date_updated',
	),
)); ?>