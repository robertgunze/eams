<?php
/* @var $this LoginController */
/* @var $model Login */
?>

<?php
$this->breadcrumbs=array(
	'Logins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Login', 'url'=>array('index')),
	array('label'=>'Create Login', 'url'=>array('create')),
	array('label'=>'Update Login', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Login', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Login', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('','View Login #'.$model->id); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
                array(
                    'name'=>'user_id',
                    'value'=>$model->user->first_name." ".$model->user->last_name
                ),
                array(
                    'name'=>'status',
                    'value'=>$model->getStatus()
                ),
		'details',
		'other_details',
		'date_created',
	),
)); ?>