<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eac Facts'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EacFacts', 'url'=>array('index')),
	array('label'=>'Manage EacFacts', 'url'=>array('admin')),
);
?>
<?php echo TbHtml::pageHeader('', 'Create Common Market'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>