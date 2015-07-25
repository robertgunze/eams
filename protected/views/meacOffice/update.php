<?php
/* @var $this MeacOfficeController */
/* @var $model MeacOffice */
?>

<?php
$this->breadcrumbs=array(
	'Meac Offices'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List MeacOffice', 'url'=>array('index')),
	array('label'=>'Create MeacOffice', 'url'=>array('create')),
	array('label'=>'View MeacOffice', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MeacOffice', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'Update Meac Office' . $model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>