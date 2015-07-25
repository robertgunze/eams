<?php
/* @var $this EamsFrameworkTypeController */
/* @var $model EamsFrameworkType */
?>

<?php
$this->breadcrumbs=array(
	'Eams Framework Types'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List EamsFrameworkType', 'url'=>array('index')),
	array('label'=>'Create EamsFrameworkType', 'url'=>array('create')),
	array('label'=>'View EamsFrameworkType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EamsFrameworkType', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'View Eams Framework Type'.$model->id); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>