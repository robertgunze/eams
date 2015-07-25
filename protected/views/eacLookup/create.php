<?php
/* @var $this EacLookupController */
/* @var $model EacLookup */
?>

<?php
$this->layout = '//layouts/column1';
$this->breadcrumbs=array(
	'Eac Lookups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EacLookup', 'url'=>array('index')),
	array('label'=>'Manage EacLookup', 'url'=>array('admin')),
);
?>


<?php echo TbHtml::pageHeader('', 'Create EacLookup'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>