<?php
/* @var $this EamsFilesImportController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Eams Files Imports',
);

$this->menu=array(
	array('label'=>'Create EamsFilesImport','url'=>array('create')),
	array('label'=>'Manage EamsFilesImport','url'=>array('admin')),
);
?>

<h1>Eams Files Imports</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>