<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */
?>

<?php
$this->breadcrumbs=array(
	'Eac Facts'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List EacFacts', 'url'=>array('index')),
	array('label'=>'Create EacFacts', 'url'=>array('create')),
	array('label'=>'View EacFacts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EacFacts', 'url'=>array('admin')),
);
?>
    <?php echo TbHtml::pageHeader('', 'Update Common Market' . $model->id); ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>