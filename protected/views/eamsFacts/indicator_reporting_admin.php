<?php echo TbHtml::pageHeader('', 'Facts Sheet'); ?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'eams-facts-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
//		'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'header' => 'Indicator Description',
            'value' => '$data->eamsFrameworkIndicatorMapping->indicator->description'
        ),
        array(
            'header' => 'Framework Description',
            'value' => '$data->eamsFrameworkIndicatorMapping->framework->framework_description'
        ),
        array(
            'type' => 'html',
            'header' => 'Reporting Period',
            'value' => '$data->timeDimension->daytimekey." ".TbHtml::labelTb($data->timeDimension->daymonth." , ".$data->timeDimension->dayquarter." , ".$data->timeDimension->dayyear)'
        ),
        //'data_ref_date',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'data_ref_date',
//                    'value' => 'is_null($data->data_ref_date)?"Set date":$data->data_ref_date',
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type' => 'date',
                'format' => 'yyyy-mm-dd',
                'viewformat' => 'yyyy-mm-dd',
                'url' => $this->createUrl('eamsFacts/ajaxUpdate'),
                'placement' => 'right',
            )
        ),
        array(
            'type' => 'html',
            'header' => 'Status',
            'value' => '$data->is_reported==0?TbHtml::labelTb("Not Reported",array("color" => TbHtml::LABEL_COLOR_IMPORTANT)):TbHtml::labelTb("Reported", array("color"=> TbHtml::LABEL_COLOR_SUCCESS))'
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'indicator_value',
            'headerHtmlOptions' => array('style' => 'width: 110px'),
            'editable' => array(//editable section
                //'apply'      => '$data->indicator_value == null', //can't edit filled values
                'url' => $this->createUrl('eamsFacts/ajaxUpdate'),
                'placement' => 'right',
            )
        ),
        'created_by',
        /*
          'framework_ind_id',
          'timestamp',
          'time_id',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>



