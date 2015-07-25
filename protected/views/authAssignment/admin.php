<?php
$this->breadcrumbs=array(
	'Auth Assignments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AuthAssignment', 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Operation View User')),
	array('label'=>'Create AuthAssignment', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Operation Edit User')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('auth-assignment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1></h1>
<?php echo TbHtml::pageHeader('', 'Manage Auth Assignments'); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'auth-assignment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'itemname',
		'userid',
		'bizrule',
		'data',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
