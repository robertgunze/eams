<?php
/* @var $this MeacOfficeController */
/* @var $model MeacOffice */
?>

<?php
$this->breadcrumbs=array(
	'Meac Offices'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MeacOffice', 'url'=>array('index')),
	array('label'=>'Create MeacOffice', 'url'=>array('create')),
	array('label'=>'Update MeacOffice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MeacOffice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeacOffice', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'View Meac Office' . $model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'description',
		'abbrev',
		'parent_id',
		'active',
	),
)); ?>