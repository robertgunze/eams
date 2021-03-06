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
<?php echo TbHtml::pageHeader('', 'Annual Performance'); ?>
<?php echo CHtml::link('Add Indicator', $this->createUrl('indicator/create',array('framework_id'=>$model->id)), array('class' => 'btn btn-success')); ?>
&nbsp;&nbsp;<a class="print-button" href="javascript:window.print()" rel="nofollow"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/print.gif" /></a>

<br><br/>
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
     
        </tr>
    </thead>
    <tbody>
        <?php $count = 0?>
        <?php foreach($model->indicators as $indicator):?>
        <?php $count+=1;?>
        <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $indicator->description?></td>
                <td ></td>
                <?php $percentageChange = 'N/A'; ?>
                
                <?php foreach($indicator->eamsFrameworkIndicatorMappings as $mapping):?>
                       <?php if(!$mapping->eamsFacts):?>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                       <?php else:?>
                       <?php foreach($mapping->eamsFacts as $key=>$fact):?>
                        <?php $deltaSign = $percentageChange = ""; ?>
                        <?php if($key > 0 ):?>
                          <?php if(($mapping->eamsFacts[$key-1]->indicator_value > 0)):?>
                           <?php $percentageChange =  $percentageChange = number_format(100/($mapping->eamsFacts[$key-1]->indicator_value) * ($mapping->eamsFacts[$key]->indicator_value - $mapping->eamsFacts[$key-1]->indicator_value),2) ; ?>
                          <?php else:?>
                            <?php $percentageChange = 'N/A'?>
                          <?php endif;?>
                        <?php elseif($key==0):?>
                            <?php $percentageChange = 0?>
                        <?php endif;?>
                        <?php if($percentageChange > 0):?>
                        <?php $deltaSign = TbHtml::icon(TbHtml::ICON_ARROW_UP);?>
                        <?php elseif($percentageChange < 0): ?>
                        <?php $deltaSign = TbHtml::icon(TbHtml::ICON_ARROW_DOWN);?>
                        <?php endif;?>
                        
                        <?php $deltaLabel = TbHtml::labelTb($percentageChange.'% '.$deltaSign, array('color' => TbHtml::LABEL_COLOR_INFO));  ?>
                        
                        <td id="<?php echo $fact->id?>" style="width:110px"><?php echo $fact->indicator_value."  ".$deltaLabel; ?></td>
                            <?php if($mapping->eamsFacts[0]->indicator_value > 0):?>
                            <?php $percentageChange = number_format(100/($mapping->eamsFacts[0]->indicator_value) * ($mapping->eamsFacts[count($mapping->eamsFacts)-1]->indicator_value - $mapping->eamsFacts[0]->indicator_value),2) ?>
                              <?php if($percentageChange > 0):?>
                                <?php $deltaSign = TbHtml::icon(TbHtml::ICON_ARROW_UP);?>
                              <?php else: ?>
                                <?php $deltaSign = TbHtml::icon(TbHtml::ICON_ARROW_DOWN);?>
                              <?php endif;?>
                            <?php $deltaLabel = TbHtml::labelTb($percentageChange.'% '.$deltaSign, array('color' => TbHtml::LABEL_COLOR_INFO));  ?>
                        
                            <?php else:?>
                            <?php $percentageChange = 'N/A'?>
                            <?php endif;?>
                       <?php endforeach;?>
                       <?php endif;?>
                          
                <?php endforeach;?>
                <td><?php echo $deltaLabel; ?></td>
                <td ></td> 
                
        </tr>
     <?php endforeach;?>
    </tbody>
    <tfoot>
        
    </tfoot>
</table>

<script>
    
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
