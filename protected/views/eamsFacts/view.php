<?php
/* @var $this EamsFactsController */
/* @var $model EamsFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eams Facts'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EamsFacts', 'url'=>array('index')),
	array('label'=>'Create EamsFacts', 'url'=>array('create')),
	array('label'=>'Update EamsFacts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EamsFacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EamsFacts', 'url'=>array('admin')),
);
?>
<?php echo TbHtml::pageHeader('', 'View Eams Facts'.$model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'framework_ind_id',
		'time_id',
		'data_ref_date',
		'indicator_value',
		'created_by',
		'timestamp',
	),
)); ?>