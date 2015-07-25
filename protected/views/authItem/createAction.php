<?php
$this->breadcrumbs=array(
	'Actions'=>array('admin'),
	'Create',
);
?>

<?php echo TbHtml::pageHeader('', 'Create a New Action'); ?>

<?php echo $this->renderPartial('_formAction', array('model'=>$model)); ?>