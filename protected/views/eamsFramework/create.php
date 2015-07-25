<?php
/* @var $this EamsFrameworkController */
/* @var $model EamsFramework */
?>

<?php
$this->breadcrumbs=array(
	'Eams Frameworks'=>array('admin'),
	'Create',
);

?>

<?php echo TbHtml::pageHeader('', 'Create Eams Frameworks'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>