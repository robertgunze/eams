<?php
/* @var $this EamsFilesImportController */
/* @var $model EamsFilesImport */
?>

<?php
$this->breadcrumbs=array(
	'Eams Files Imports'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List EamsFilesImport', 'url'=>array('index')),
	array('label'=>'Create EamsFilesImport', 'url'=>array('create')),
	array('label'=>'Update EamsFilesImport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EamsFilesImport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EamsFilesImport', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('', 'View Imported File'); ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'mime_type',
		'file_extension',
		'file_size',
		'date_created',
		'date_updated',
	),
)); ?>

<script type="text/javascript">
   payload = null;
</script>

<div class="payload" style="display:none"></div>
<?php
echo CHtml::ajaxLink("Save Selected",Yii::app()->createUrl('import/saveCommonMarket'), array(
        "type" => "post",
        "beforeSend"=>'function(){
            var checkedRowId=$("#import-grid").yiiGridView("getChecked", "selectedIds");
            console.log(checkedRowId);
            var protocol_details =null;
            var provision=null;
            var indicator=null;
            var data_collection_guidelines=null;
            var protocol_id = null;
            var protocol_provision_id = null;
            var indicator_id = null;
            var data_field_code = null;
            
            var data = [];
            $("#import-grid tr").each(function(i){
                if("checked" == $(this).children(":nth-child(1)").find("input").attr("checked")){
                    protocol_details=$(this).children(":nth-child(3)").text(); // 3rd column
                    provision=$(this).children(":nth-child(4)").text(); // 4th column
                    data_field_code=$(this).children(":nth-child(5)").text(); // 5th column
                    indicator_id = $(this).children(":nth-child(6)").text(); // 6th column
                    indicator = $(this).children(":nth-child(7)").text(); // 7th column
                    data_collection_guidelines = $(this).children(":nth-child(8)").text(); // 8th column;
                   
                    var row_data = {
                      "protocol_details":protocol_details,
                      "provision":provision,
                      "indicator":indicator,
                      "data_collection_guidelines":data_collection_guidelines,
                      "protocol_id":protocol_id,
                      "protocol_provision_id":protocol_provision_id,
                      "indicator_id":indicator_id,
                      "data_field_code":data_field_code
                    };
                    
                    console.log(JSON.stringify(row_data));
                    data.push(row_data);     

                }
            });
       
            console.log(JSON.stringify(data));
            payload = JSON.stringify(data);
            
        }',
        "data" => 'js:{ids : $.fn.yiiGridView.getChecked("import-grid","selectedIds").toString(),data : payload}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("import-grid")  }' ),array(
        'class' => 'btn btn-info'
        )
        );
?>

 &nbsp;&nbsp; 
 <?php
 echo CHtml::ajaxLink("Archive File", $this->createUrl('report/getvalue'), array(
        "type" => "post",
        "data" => 'js:{ids : $.fn.yiiGridView.getChecked("import-grid","selectedIds").toString()}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("import-grid") }' ),array(
        'class' => 'btn btn-info'
        )
        );
 ?>
 <br /><br />

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'import-grid',
    'dataProvider' => $arrayDataProvider,
    //'filter' => $model,
    'columns' => array(
        array(
                //'name' => 'check',
                'header'=>'Check All',
                'id' => 'selectedIds',
                'value' => '$data["indicator_id"]',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '100',
 
        ),
        //'id',
        array(
            'header' => '#',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        //'protocol_id',
        array(
            'header' => 'Freedom / Rights',
            'name' => 'protocol_details',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["protocol_details"])'
        ),
        //'protocol_provision_id',
        array(
            'header' => 'Protocal Provision Description',
            'name' => 'protocol_provision_description',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["protocol_provision_description"])'
        ),
         array(
            'header' => 'Data Field Code',
            'name' => 'data_field_code',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["data_field_code"])'
        ),
        // array(
        //     'header' => 'Data Field Description',
        //     'name' => 'data_field_desc',
        //     'type' => 'raw',
        //     'value' => 'CHtml::encode($data["data_field_desc"])'
        // ),
        array(
            'header' => 'Indicator ID',
            'name' => 'indicator_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["indicator_id"])'
        ),
        array(
            'header' => 'Indicator Description',
            'name' => 'indicator_description',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["indicator_description"])'
        ),
        array(
            'header' => 'Data Collection Guidelines',
            'name' => 'data_collection_guidelines',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["data_collection_guidelines"])'
        ),
        // array(
        //     'header' => 'Numeric Data',
        //     'name' => 'numeric_data',
        //     'type' => 'raw',
        //     'value' => 'CHtml::encode($data["numeric_data"])'
        // ),
        // array(
        //     'name' => 'alphanumeric_data',
        //     'header' => 'Alpha-numeric Data',
        //     'name' => 'alphanumeric_data',
        //     'type' => 'raw',
        //     'value' => 'CHtml::encode($data["alphanumeric_data"])'
        // ),
        array(
            'header' => 'Date Created',
            'name' => 'date_created',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["date_created"])'
        ),
        //'create_user_id',
        //'date_updated',
        //'update_user_id',
    ),
));
?>

<?php
echo CHtml::ajaxLink("Save Selected", $this->createUrl('report/getvalue'), array(
        "type" => "post",
        "data" => 'js:{theIds : $.fn.yiiGridView.getChecked("import-grid","selectedIds").toString(),"status":$("#newStatus").val()}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("import-grid")  }' ),array(
        'class' => 'btn btn-info'
        )
        );
?>

 &nbsp;&nbsp; 
 <?php
 echo CHtml::ajaxLink("Archive File", $this->createUrl('report/getvalue'), array(
        "type" => "post",
        "data" => 'js:{theIds : $.fn.yiiGridView.getChecked("import-grid","selectedIds").toString(),"status":$("#newStatus").val()}',
        "success" => 'js:function(data){ $.fn.yiiGridView.update("import-grid")  }' ),array(
        'class' => 'btn btn-info'
        )
        );
 ?>

 <br /><br />