<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */


$this->breadcrumbs = array(
    'Eac Facts' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List EacFacts', 'url' => array('index')),
    array('label' => 'Create EacFacts', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#eac-facts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Common Market'); ?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>&nbsp;
<?php echo TbHtml::link('Export to Excel',$this->createUrl('//export/exportCommonMarket'),array('class'=>'btn btn-success'));?>
<br /><br />
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'eac-facts-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        //'protocol_id',
        'protocol_details',
        //'protocol_provision_id',
        'protocol_provision_description',
        //'data_field_code',
        'data_field_desc',
        //'indicator_id',
        'indicator_description',
        'data_collection_guidelines',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'numeric_data',
            'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(//editable section
                //'apply'      => '$data->indicator_value == null', //can't edit filled values
                'url' => $this->createUrl('eacFacts/ajaxUpdate'),
                'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'alphanumeric_data',
            'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(//editable section
                //'apply'      => '$data->indicator_value == null', //can't edit filled values
                'url' => $this->createUrl('eacFacts/ajaxUpdate'),
                'placement' => 'right',
            )
        ),
        //'date_created',
        //'create_user_id',
        //'date_updated',
        //'update_user_id',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
