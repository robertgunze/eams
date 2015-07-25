<?php
/* @var $this MdaController */
/* @var $model Mda */


$this->breadcrumbs = array(
    'Mdas' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Mda', 'url' => array('index')),
    array('label' => 'Create Mda', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mda-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage MDAs'); ?>

    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>&nbsp;
    <?php echo CHtml::link('Add New', $this->createUrl('/mda/create'), array('class' => 'btn btn-success')); ?><br><br/>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'mda-grid',
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