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

   $(document).ready(function(){
         $('.btn-save-data').click(function(){
            var checkedRowId=$("#import-grid").yiiGridView("getChecked", "selectedIds");
            console.log(checkedRowId);
            var decision_reference =null;
            var description=null;
            var budgetary_implications=null;
            var time_frame=null;
            var performance_indicators = null;
            var responsibility_center = null;
            var meeting_no = null;
            var eams_central_id = null;
            var decision_source_id = null;
            var sectoral_council_id = null;
            var decision_date = null;
            
            var data = [];
            var allChecked = false;
            $("#import-grid tr").each(function(i){  
                if("checked" == $(this).children(":nth-child(1)").find("input").attr("checked")){
                    if(allChecked == false && "checked"==$("#selectedIds_all").attr("checked")){
                        allChecked = true;
                        return;//continue
                    }

                    decision_reference = $(this).children(":nth-child(2)").text(); // 2nd column
                    description = $(this).children(":nth-child(3)").text(); // 3rd column
                    budgetary_implications = $(this).children(":nth-child(4)").text(); // 4th column
                    time_frame = $(this).children(":nth-child(5)").text(); // 5th column
                    performance_indicators = $(this).children(":nth-child(6)").text(); // 6th column
                    responsibility_center = $(this).children(":nth-child(7)").text(); // 7th column;
                    meeting_no = $(this).children(":nth-child(8)").text(); // 8th column
                    eams_central_id = $(this).children(":nth-child(9)").text(); // 9th column
                    decision_source_id = $(this).children(":nth-child(10)").text(); // 10th column
                    sectoral_council_id = $(this).children(":nth-child(11)").text(); // 11th column
                    decision_date = $(this).children(":nth-child(12)").text(); // 12th column

                    var row_data = {
                      "eams_central_id":eams_central_id,
                      "decision_reference":decision_reference,
                      "decision_date":decision_date,
                      "description":description,
                      "budgetary_implications":budgetary_implications,
                      "time_frame":time_frame,
                      "performance_indicators":performance_indicators,
                      "responsibility_center":responsibility_center,
                      "meeting_no":meeting_no,
                      "decision_source_id":decision_source_id,
                      "sectoral_council_id":sectoral_council_id
                    };
                    
                    console.log(JSON.stringify(row_data));
                    data.push(row_data);     

                }
            });
       
            console.log(JSON.stringify(data));
            payload = JSON.stringify(data);

            var url = "<?php echo Yii::app()->createUrl('import/saveDecisions') ?>" + "&timestamp="+ new Date().getTime();
            //console.log(url);
            var data = {ids : $.fn.yiiGridView.getChecked("import-grid","selectedIds").toString(),data : payload };
            $.post(url,data,function(response,status){
                console.log(status);
                if(status=="success"){
                 $(".message").html('<div class="success alert alert-info fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data saved successfully...</div>');
                }else{
                 $(".message").html('<div class="success alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Could not save submitted data...</div>');
                
                }
            });
         });
   });

</script>

<div class="message"></div>
<div class="payload" style="display:none"></div>
<?php echo CHtml::button('Save Selected',['id'=>'btn-save-data-top','class'=>'btn btn-info btn-save-data'])?>
 &nbsp;&nbsp; 
 <?php
 echo CHtml::link("Archive File", $this->createUrl('archive',['id'=>$model->id]), array(
        'class' => 'btn btn-info')
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
            'header' => 'Budgetary Implications',
            'name' => 'budgetary_implications',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["budgetary_implications"])'
        ),
        array(
            'header' => 'Timeframe',
            'name' => 'time_frame',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["time_frame"])'
        ),
        array(
            'header' => 'Performance Indicators',
            'name' => 'performance_indicators',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["performance_indicators"])'
        ),
        array(
            'header' => 'Responsibility Center',
            'name' => 'responsibility_center',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["responsibility_center"])'
        ),
        array(
            'header' => 'Meeting #',
            'name' => 'meeting_no',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["meeting_no"])'
        ),
        array(
            'header' => 'Decision ID',
            'name' => 'eams_central_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["eams_central_id"])'
        ),
        array(
            'header' => 'Decision Source',
            'name' => 'decision_source_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["decision_source_id"])'
        ),
         array(
            'header' => 'Sectoral Council ID',
            'name' => 'sectoral_council_id',
            'type' => 'raw',
            'value' => 'CHtml::encode($data["sectoral_council_id"])'
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

<?php echo CHtml::button('Save Selected',['id'=>'btn-save-data-bottom','class'=>'btn btn-info btn-save-data'])?>

 &nbsp;&nbsp; 
 <?php
 echo CHtml::link("Archive File", $this->createUrl('archive',['id'=>$model->id]), array(
        'class' => 'btn btn-info')
        );
 ?>

 <br /><br />