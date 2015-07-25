<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->layout = '//layouts/column1';
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'Create User'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>