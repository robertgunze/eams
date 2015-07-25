<?php
/* @var $this IndicatorDataSourceController */
/* @var $model IndicatorDataSource */

$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
    'Indicator Data Sources' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List IndicatorDataSource', 'url' => array('index')),
    array('label' => 'Create IndicatorDataSource', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#indicator-data-source-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Indicator Data Sources'); ?>
<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

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
    'id' => 'indicator-data-source-grid',
    'type' => TbHtml::GRID_TYPE_BORDERED,
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
        'contact_details',
        'phone_no',
        'email',
        /*
          'remarks',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>