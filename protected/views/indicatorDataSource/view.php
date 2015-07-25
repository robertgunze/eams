<?php

/* @var $this IndicatorDataSourceController */
/* @var $model IndicatorDataSource */
?>

<?php

$this->breadcrumbs = array(
    'Indicator Data Sources' => array('admin'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List IndicatorDataSource', 'url' => array('index')),
    array('label' => 'Create IndicatorDataSource', 'url' => array('create')),
    array('label' => 'Update IndicatorDataSource', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete IndicatorDataSource', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage IndicatorDataSource', 'url' => array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'View Indicator Data Source' . $model->id); ?>

<?php

$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
//		'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        'description',
        'abbrev',
        'contact_details',
        'phone_no',
        'email',
        'remarks',
    ),
));
?>