<?php

$this->breadcrumbs = array(
    'Groups' => array('roles'),
    $model->name => array('view', 'id' => $model->name),
    'Update',
);
?>

<?php

if ($model->type == 2) {
    echo TbHtml::pageHeader('', 'Update Group:-' . $model->name);
}
else{
   echo TbHtml::pageHeader('', 'Update Action:-' . $model->name); 
}
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>