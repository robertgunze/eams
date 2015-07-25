<?php
/* @var $this MeacOfficeController */
/* @var $model MeacOffice */


$this->breadcrumbs = array(
    'Meac Offices' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List MeacOffice', 'url' => array('index')),
    array('label' => 'Create MeacOffice', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#meac-office-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage MEAC Offices'); ?>

    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>&nbsp;
<?php echo CHtml::link('Add New', $this->createUrl('/meacOffice/create'), array('class' => 'btn btn-success')); ?><br><br/>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'meac-office-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//		'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        'description',
        'abbrev',
        array(
            'name' => 'parent_id',
            'value' => 'is_null($data->parent)?"Not set":$data->parent->description'
        ),
        array(
            'name' => 'active',
            'value' => '$data->active?"Yes":"No"'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>