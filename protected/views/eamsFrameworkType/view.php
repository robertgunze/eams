<?php
/* @var $this EamsFrameworkTypeController */
/* @var $model EamsFrameworkType */
?>

<?php
$this->breadcrumbs=array(
	'Eams Framework Types'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EamsFrameworkType', 'url'=>array('index')),
	array('label'=>'Create EamsFrameworkType', 'url'=>array('create')),
	array('label'=>'Update EamsFrameworkType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EamsFrameworkType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EamsFrameworkType', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'View Eams Framework Type'.$model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'description',
		'level',
	),
)); ?>