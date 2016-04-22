<?php
/* @var $this EamsFilesImportController */
/* @var $model EamsFilesImport */
?>

<?php
$this->breadcrumbs=array(
	'Eams Files Imports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EamsFilesImport', 'url'=>array('index')),
	array('label'=>'Manage EamsFilesImport', 'url'=>array('admin')),
);
?>

<h1>Create EamsFilesImport</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>