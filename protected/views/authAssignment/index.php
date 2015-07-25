<?php
$this->breadcrumbs=array(
	'Auth Assignments',
);

$this->menu=array(
	array('label'=>'Create AuthAssignment', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Operation Edit User')),
	array('label'=>'Manage AuthAssignment', 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Operation View User')),
);
?>

<h1>Auth Assignments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
