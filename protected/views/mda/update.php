<?php
/* @var $this MdaController */
/* @var $model Mda */
?>

<?php
$this->breadcrumbs=array(
	'Mdas'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mda', 'url'=>array('index')),
	array('label'=>'Create Mda', 'url'=>array('create')),
	array('label'=>'View Mda', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mda', 'url'=>array('admin')),
);
?>
     <?php echo TbHtml::pageHeader('', 'Update Mda' . $model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>