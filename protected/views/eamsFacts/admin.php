<?php
/* @var $this EamsFactsController */
/* @var $model EamsFacts */

$this->breadcrumbs = array(
    'Eams Facts' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List EamsFacts', 'url' => array('index')),
    array('label' => 'Create EamsFacts', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#eams-facts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Eams Facts'); ?>
    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?><br><br/>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'eams-facts-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//		'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        'framework_ind_id',
        'time_id',
        'data_ref_date',
        'indicator_value',
        'created_by',
        /*
          'timestamp',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>