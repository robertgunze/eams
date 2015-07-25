<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */

$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
    'EAC Decisions' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List EacDecision', 'url' => array('index')),
    array('label' => 'Create EacDecision', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#eac-decision-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php echo TbHtml::pageHeader('', 'Manage EAC Decisions'); ?>
<div class="form-actions"> 
    <?php echo CHtml::link('Toggle Advanced Search', '#', array('class' => 'search-button btn', 'style' => 'float:right')); ?>
</div>
<div class="search-form" style="display:block">
    <?php
    $this->renderPartial('_decisions_filter', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<div style="width:94%">
<?php
 echo TbHtml::buttonDropdown('Export Data To', array(
    array('label' => 'HTML', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'html'))),
    array('label' => 'PDF', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'pdf'))),
    array('label' => 'EXCEL', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'excel'))),
    //TbHtml::menuDivider(),
    array('label' => 'CSV', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'csv'))),
), array('split' => true,'color'=>TbHtml::BUTTON_COLOR_SUCCESS,'size'=>TbHtml::BUTTON_SIZE_SMALL)); 

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'eac-decision-grid',
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'dataProvider' => $model->search(),
//	'filter'=>$model,
    'columns' => array(
//        'id',
        // array(
        //     'header' => '#',
        //     'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        //     ),
        //'eams_central_id',
        'decision_reference',
        'decision_date',
        'description',
        //'budgetary_implications',
        'time_frame',
        'performance_indicators',
        //'responsibility_center',
        //'meeting_no',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'responsible_mda_id',
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'filter' => TbHtml::listData(Mda::model()->findAll(), "id", "description"),
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('eacDecision/ajaxUpdate'),
                'source' => TbHtml::listData(Mda::model()->findAll(), 'id', 'description'),
                'placement' => 'right',
                'emptytext' => '<p class="btn btn-success">Select responsible MDA</p>'
            )
        ),
//                array(
//                    'name'=>'sectoral_council_id',
//                    'value'=>'$data->sectoral_council_id',
//                    'filter'=>TbHtml::listData(EacLookup::model()->findAll('type=:type',array(':type'=>  EacLookup::SECTORAL_COUNCIL)),"id","description"),
//                ),
        //'implementation_status_id',

        /*
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'implementation_status_id',
            'headerHtmlOptions' => array('style' => 'width: 100px;'),
            'filter' => TbHtml::listData(EacLookup::model()->findAll('type=:type', array(':type' => EacLookup::IMPLEMENTATION_STATUS)), "id", "description"),
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('eacDecision/ajaxUpdate'),
                'source' => TbHtml::listData(EacLookup::model()->findAll('type=:type', array(':type' => EacLookup::IMPLEMENTATION_STATUS)), 'id', 'description'),
                'placement' => 'right',
                'emptytext' => '<p class="btn btn-success">Update Status</p>'
            )
        ),
        */

        array(
            'type'=>'html',
            'header'=>'Feedback',
            'value'=>'$data->getStatusLogs()'
            ),
        array(
            'type' => 'html',
            'header' => 'Status',
            'name' => 'implementation_status_id',
            'value' => 'TbHtml::labelTb("&nbsp;&nbsp;", array("color" =>"{$data->getStatusColor($data)}"));'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>

</div>