<?php
/* @var $this PageController */
/* @var $model Page */
?>

<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('','Update Page #'.$model->name); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>