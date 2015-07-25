<?php
/* @var $this MdaController */
/* @var $model Mda */
?>

<?php
$this->breadcrumbs=array(
	'Mdas'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mda', 'url'=>array('index')),
	array('label'=>'Create Mda', 'url'=>array('create')),
	array('label'=>'Update Mda', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mda', 'url'=>array('admin')),
);
?>
<?php echo TbHtml::pageHeader('', 'View Mda' . $model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'description',
		'abbrev',
		'contact_details',
		'phone_no',
		'email',
		'remarks',
	),
)); ?>