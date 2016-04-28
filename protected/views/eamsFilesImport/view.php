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
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'import-grid',
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'dataProvider' => $arrayDataProvider,
    //'filter' => $model,
    'columns' => array(
    	array(
                //'name' => 'check',
                'header'=>'Check All',
                'id' => 'selectedIds',
                'value' => '$data["decision_reference"]',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => '100',
 
        ),
        array(
        	'header' => 'Decision Reference',
            'name' => 'decision_reference',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["decision_reference"])'
        ),
        array(
        	'header' => 'Description',
            'name' => 'description',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["description"])'
        ),
        array(
        	'header' => 'Decision Date',
            'name' => 'decision_date',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["decision_date"])'
        ),
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