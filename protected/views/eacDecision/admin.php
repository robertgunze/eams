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

<div>
<?php echo TbHtml::pageHeader('', 'Manage EAC Decisions'); ?>
<div class="form-actions"> 
    <?php echo CHtml::link('Toggle Search', '#', array('class' => 'search-button btn', 'style' => 'float:right')); ?>
</div>
<div class="search-form" style="display:block">
    <?php
    $this->renderPartial('_decisions_filter', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
 echo TbHtml::buttonDropdown('Export Data To', array(
    array('label' => 'HTML', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'html'))),
    array('label' => 'PDF', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'pdf'))),
    array('label' => 'EXCEL', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'excel'))),
    //TbHtml::menuDivider(),
    array('label' => 'CSV', 'url' => $this->createUrl('eacDecision/admin',array('format'=>'csv'))),
), array('split' => true,'color'=>TbHtml::BUTTON_COLOR_SUCCESS,'size'=>TbHtml::BUTTON_SIZE_SMALL)); 

$displayable = (!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda)==true ?'':'display:none';
$allowableActions = (!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda)==true ?'{view}':'{view}';

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
        //'description',
        array(
            'type' => 'html',
            'header'=>'Description',
            'value'=>'$data->description',
            'htmlOptions'=>array('width'=>'400px'),
            ),
        //'budgetary_implications',
        'time_frame',
        //'performance_indicators',
        array(
            'type'=>'html',
            'header'=>'Performance Indicators',
            'value'=>'$data->performance_indicators',
            'htmlOptions'=>array('width'=>'150px'),
            ),
        //'responsibility_center',
        //'meeting_no',
        array(
            'type' => 'html',
            'header'=>'Responsible MDA(s)',
            'value'=>'$data->getResponsibleMdas()',
            'htmlOptions'=>array('width'=>'40px','style'=>$displayable),
            'headerHtmlOptions' => array('style' => 'width: 40px;'.$displayable),
        ),

        array(
            'type'=>'html',
            'header'=>'Progress Updates',
            'value'=>'$data->getStatusLogs()',
            'htmlOptions'=>array('width'=>'200px'),
            ),
        array(
            'type' => 'html',
            'header' => 'Status',
            'name' => 'implementation_status_id',
            'value' => 'TbHtml::labelTb("&nbsp;&nbsp;", array("style"=>"width:100%;height:100%;background-color:{$data->getStatusColor($data)}","color" =>"{$data->getStatusColor($data)}"));'
        ),
        array(
            'class' => 'editable.EditableColumn',
            'header'=>'',
	    'htmlOptions' => array('style' =>$displayable),
            'name' => 'responsible_mda_id',
	    'headerHtmlOptions' => array('style' => 'width: 100px;'.$displayable),
            'filter' => TbHtml::listData(Mda::model()->findAll(), "id", "description"),
            'editable' => array(
                'type' => 'checklist',
                'url' => $this->createUrl('eacDecision/ajaxUpdate'),
                'source' => TbHtml::listData(Mda::model()->findAll(), 'id', 'description'),
                'placement' => 'right',
                'emptytext' => '<p class="btn btn-success">Select responsible MDA</p>'
            )
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $allowableActions,
        ),
    ),
));
?>

</div>
