<?php
/* @var $this AuditTrailController */
/* @var $model AuditTrail */

$this->breadcrumbs = array(
    'Audit Trails' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List AuditTrail', 'url' => array('index')),
    array('label' => 'Create AuditTrail', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#audit-trail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Audit Trails'); ?>

<?php // echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<!--<div class="search-form" style="display:none">
<?php
//    $this->renderPartial('_search', array(
//        'model' => $model,
//    ));
?>
</div> search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'audit-trail-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
//        'user_id',
        array('name' => 'user_id',
            'value' => '$data->user->username',
        ),
        'details',
//        'activity_group',
        'date_created',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>
