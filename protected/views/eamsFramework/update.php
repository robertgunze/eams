<?php
/* @var $this EamsFrameworkController */
/* @var $model EamsFramework */
?>

<?php
$this->breadcrumbs=array(
	'Eams Frameworks'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List EamsFramework', 'url'=>array('index')),
	array('label'=>'Create EamsFramework', 'url'=>array('create')),
	array('label'=>'View EamsFramework', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EamsFramework', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'Update Eams Frameworks'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>