<?php
/* @var $this MeacOfficeController */
/* @var $model MeacOffice */
?>

<?php
$this->breadcrumbs=array(
	'Meac Offices'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MeacOffice', 'url'=>array('index')),
	array('label'=>'Manage MeacOffice', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('','Create MEAC Office'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>