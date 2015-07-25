<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eac Facts'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EacFacts', 'url'=>array('index')),
	array('label'=>'Create EacFacts', 'url'=>array('create')),
	array('label'=>'Update EacFacts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EacFacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EacFacts', 'url'=>array('admin')),
);
?>

<h1>View EacFacts #<?php echo $model->id; ?></h1>
<?php echo TbHtml::pageHeader('', 'View Common Market' . $model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'protocol_id',
		'protocol_details',
		'protocol_provision_id',
		'protocol_provision_description',
		'data_field_code',
		'data_field_desc',
		'indicator_id',
		'indicator_description',
		'data_collection_guidelines',
		'numeric_data',
		'alphanumeric_data',
		'date_created',
		'create_user_id',
		'date_updated',
		'update_user_id',
	),
)); ?>