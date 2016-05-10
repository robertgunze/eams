<?php
/* @var $this EamsFrameworkController */
/* @var $model EamsFramework */
?>

<?php
$this->breadcrumbs=array(
	'Eams Frameworks'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EamsFramework', 'url'=>array('index')),
	array('label'=>'Create EamsFramework', 'url'=>array('create')),
	array('label'=>'Update EamsFramework', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EamsFramework', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EamsFramework', 'url'=>array('admin')),
);
?>
<h1 id="report-header1" style="display:none"><?php echo Yii::app()->params['owner']; ?></h1>

<?php echo TbHtml::pageHeader('', 'View Eams Framework #'.$model->id); ?>
<?php echo CHtml::link('Add Indicator', $this->createUrl('indicator/create',array('framework_id'=>$model->id)), array('class' => 'btn btn-success')); ?>
&nbsp;&nbsp;<a class="print-button" href="javascript:printReport()" rel="nofollow"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/print.gif" /></a>

<br><br/>
<h3 id="report-header2" style="display:none">Annual Performance Report</h3>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		 array(
                    'name'=>'framework_description',
                    'label'=>'Description',
                    'value'=>$model->framework_description
                ),
                array(
                    'name'=>'type_id',
                    'value'=>$model->type->description
                ),
//                array(
//                    'name'=>'parent_id',
//                    'value'=>  isset($model->parent)?$model->parent->description:'Not Set'
//                ),
		//'guid',
	),
)); ?>

<p class="message alert-info " style="position:absolute;top:50%;left: 50%;"></p>

<table class="table-data-print">
    <thead>
        <tr>
            <th>#</th>
            <th>Indicators</th>
            <th>5 Years Target</th>
            <th>Baseline</th>
            <th colspan="4">Annual Performance</th>
            <th>Achievement</th>
            <th>Comments</th>
            <th></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>2013-2018</th>
            <th>Status 2014</th>
            <th>2014/15</th>
            <th>2015/16</th>
            <th>2016/17</th>
            <th>2017/18</th>
            <th>Percentage(%)</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 0?>
        <?php foreach($model->indicators as $indicator):?>
        <?php $count+=1;?>
        <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $indicator->description?></td>
                <td contenteditable="true"></td>
                <?php $percentageChange = 'N/A'; ?>
                
                <?php foreach($indicator->eamsFrameworkIndicatorMappings as $mapping):?>
                       <?php if(!$mapping->eamsFacts):?>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                        <td contenteditable="true"></td>
                       <?php else:?>
                       <?php foreach($mapping->eamsFacts as $fact):?> 
                        <td contenteditable="true" id="<?php echo $fact->id?>"><?php echo $fact->indicator_value; ?></td>
                            <?php if($mapping->eamsFacts[0]->indicator_value != 0):?>
                            <?php $percentageChange = number_format(100/($mapping->eamsFacts[0]->indicator_value) * ($mapping->eamsFacts[count($mapping->eamsFacts)-1]->indicator_value - $mapping->eamsFacts[0]->indicator_value),2).'%'?>
                            <?php else:?>
                            <?php $percentageChange = 'N/A'?>
                            <?php endif;?>
                       <?php endforeach;?>
                       <?php endif;?>
                          
                <?php endforeach;?>
                <td><?php echo $percentageChange; ?></td>
                <td contenteditable="true"></td> 
                <td><?php echo Chtml::link('View Report',$this->createUrl('/eamsFramework/viewSP',array('id'=>$model->id)));?></td>
                
        </tr>
     <?php endforeach;?>
    </tbody>
    <tfoot>
        
    </tfoot>
</table>

<script>

function printReport(){
    $('#report-header1').css("display","block");
    $('#report-header2').css("display","block");
    window.print();
    $('#report-header1').css("display","none");
    $('#report-header2').css("display","none");
    return false;
}
    
$('body').on('focus', '[contenteditable]', function() {
    var $this = $(this);
    $this.data('before', $this.html());
    $this.attr("style","background-color:#ddd;border:1px solid");
    return $this;
}).on('blur keyup paste input', '[contenteditable]', function() {
    var $this = $(this);
    if ($this.data('before') !== $this.html()) {
        $this.data('before', $this.html());
        $this.trigger('change');
        //console.log($this.html());
        $('.message').html("Saving...");
        
        $.get('./index.php?r=eamsFacts/AsyncUpdate&fact_id='+$this.attr('id')+'&value='+$this.html(),function(response,status){
           var message = "";
            if(status === 200 ){
               message = response;
            }else{
               message = "Failed...";
            }
            $('.message').html(message);
            $('.message').show(2000,function(){
               
                $('.message').html("");
                return false;
            });
        });
        $this.attr("style","background-color:#fff");
    }
    return $this;
});

</script>
