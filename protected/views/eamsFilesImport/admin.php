<?php
/* @var $this EamsFilesImportController */
/* @var $model EamsFilesImport */


$this->breadcrumbs=array(
	'Eams Files Imports'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EamsFilesImport', 'url'=>array('index')),
	array('label'=>'Create EamsFilesImport', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#eams-files-import-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Files From EAMS Central'); ?>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'eams-files-import-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'mime_type',
		'file_extension',
		'file_size',
		'date_created',
		/*
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}'
		),
	),
)); ?>