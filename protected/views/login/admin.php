<?php
/* @var $this LoginController */
/* @var $model Login */


$this->breadcrumbs=array(
	'Logins'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Login', 'url'=>array('index')),
	array('label'=>'Create Login', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#login-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('','Manage Logins'); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'login-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name'=>'user_id',
                    'value'=>'$data->user->first_name." ".$data->user->last_name',
                    'filter'=>false
                ),
                array(
                    'name'=>'status',
                    'value'=>'$data->getStatus()',
                    'filter'=>  Login::getStatusOptions()
                ),
		'details',
		'other_details',
		'date_created',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{view}'
		),
	),
)); ?>