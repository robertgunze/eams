<?php
$this->breadcrumbs=array(
	'Auth Assignments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuthAssignment', 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Operation View User')),
	array('label'=>'Create AuthAssignment', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Operation Edit User')),
	array('label'=>'View AuthAssignment', 'url'=>array('view', 'id'=>$model->id),'visible'=>Yii::app()->user->checkAccess('Operation Edit User')),
	array('label'=>'Manage AuthAssignment', 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Operation View User')),
);
?>

<h1>Update AuthAssignment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>