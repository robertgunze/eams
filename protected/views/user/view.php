<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->layout = '//layouts/column1';
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'User Account '); ?>

<div class="well">
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		'username',
		'first_name',
		'middle_name',
		'last_name',
               $model->is_mda?
                    array(
                        'label'=>'MDA',
                        'value'=>!is_null($model->mda)?$model->mda->description:"",
                    ):
                    array(
                        'label'=>'MEAC Office',
                        'value'=>!is_null($model->meacOffice)?$model->meacOffice->description:"",
                    ),
		'sex',
                array(
                    'name'=>'active',
                    'value'=>$model->active?"Yes":"No"
                )
	),
)); ?>

<?php echo TbHtml::link('Assign role(s) to this user', $this->createUrl('/authItem/grantAccess', array('id' => $model->id)), array('class' => 'btn btn-success'));?>

</div>