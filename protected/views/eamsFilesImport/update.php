<?php
/* @var $this EamsFilesImportController */
/* @var $model EamsFilesImport */
?>

<?php
$this->breadcrumbs=array(
	'Eams Files Imports'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EamsFilesImport', 'url'=>array('index')),
	array('label'=>'Create EamsFilesImport', 'url'=>array('create')),
	array('label'=>'View EamsFilesImport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EamsFilesImport', 'url'=>array('admin')),
);
?>

    <h1>Update EamsFilesImport <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>