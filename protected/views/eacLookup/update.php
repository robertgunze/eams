<?php
/* @var $this EacLookupController */
/* @var $model EacLookup */
?>

<?php
$this->breadcrumbs=array(
	'Eac Lookups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EacLookup', 'url'=>array('index')),
	array('label'=>'Create EacLookup', 'url'=>array('create')),
	array('label'=>'View EacLookup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EacLookup', 'url'=>array('admin')),
);
?>

    <h1>Update EacLookup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>