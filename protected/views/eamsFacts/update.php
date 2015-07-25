<?php
/* @var $this EamsFactsController */
/* @var $model EamsFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eams Facts'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List EamsFacts', 'url'=>array('index')),
	array('label'=>'Create EamsFacts', 'url'=>array('create')),
	array('label'=>'View EamsFacts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EamsFacts', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'Update Eams Facts'.$model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>