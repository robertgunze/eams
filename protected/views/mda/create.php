<?php
/* @var $this MdaController */
/* @var $model Mda */
?>

<?php
$this->breadcrumbs=array(
	'Mdas'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mda', 'url'=>array('index')),
	array('label'=>'Manage Mda', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('','Create MDA'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>