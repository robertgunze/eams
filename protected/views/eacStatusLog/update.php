<?php
/* @var $this EacStatusLogController */
/* @var $model EacStatusLog */
?>

<?php
$this->breadcrumbs=array(
	'Eac Status Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EacStatusLog', 'url'=>array('index')),
	array('label'=>'Create EacStatusLog', 'url'=>array('create')),
	array('label'=>'View EacStatusLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EacStatusLog', 'url'=>array('admin')),
);
?>

    <h1>Update EacStatusLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>