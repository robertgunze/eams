<?php
$this->breadcrumbs=array(
	'Groups'=>array('roles'),
	'Create',
);
?>

<?php echo TbHtml::pageHeader('', 'Create a New Group/Role'); ?>

<?php echo $this->renderPartial('_formRole', array('model'=>$model)); ?>