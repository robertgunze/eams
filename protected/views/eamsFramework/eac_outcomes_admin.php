<?php
/* @var $this EamsFrameworkController */
/* @var $model EamsFramework */

$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
    'Eams Frameworks' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List EamsFramework', 'url' => array('index')),
    array('label' => 'Create EamsFramework', 'url' => array('create')),
);

?>

<?php echo TbHtml::pageHeader('', 'Manage EAC Outcomes'); ?>
<?php echo CHtml::link('Add New EAC Outcome', $this->createUrl('create'), array('class' => 'btn btn-success')); ?>
<br><br/>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'eams-framework-grid',
    'type' => TbHtml::GRID_TYPE_BORDERED,
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'type' => 'html',
            'name' => 'framework_description',
            'value' => 'TbHtml::link($data->framework_description,Yii::app()->createUrl("/eamsFramework/admin",array("parent_id"=>$data->parent_id)))'
        ),
        array(
            'name' => 'type_id',
            'value' => '$data->type->description',
            'filter' => TbHtml::listData(EamsFrameworkType::model()->findAll(), "id", "description")
        ),
//		'parent_id',
        'guid',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
