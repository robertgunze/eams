<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
?>

<?php
$this->breadcrumbs=array(
	'Eac Decisions'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EacDecision', 'url'=>array('index')),
	array('label'=>'Create EacDecision', 'url'=>array('create')),
	array('label'=>'Update EacDecision', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EacDecision', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EacDecision', 'url'=>array('admin')),
);
?>

<?php 
Yii::app()->clientScript->registerScript('search', "

$('#deadline-button').click(function(){
  $('.deadline-form').toggle();
  return false;
});
$('#close-button').click(function(){
  $('.deadline-form').hide();
  return false;
});

");
?>

<?php echo TbHtml::pageHeader('','View EAC Decision #'.$model->decision_reference);?>

<div class="well">
    <?php echo TbHtml::link('Update Status',$this->createUrl('eacStatusLog/create',array('id'=>$model->id)),array('class'=>'btn btn-success'));?>
    <?php if(!Yii::app()->user->getState('is_mda')) :?>
    <?php echo TbHtml::link('Set Deadline','#',
      array(
        'class'=>'btn btn-success',
        'id'=>'deadline-button'
        )
      );?>
    <?php endif;?>
      <br /><br />
    <div class="deadline-form form wide" style="display:none">
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action'=>$this->createUrl('update',array('id'=>$model->id)),
        'id'=>'eac-decision-form',
        'enableAjaxValidation'=>false,
      )); ?>

          <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                 'model'=>$model,
                                                 'attribute'=>'deadline',
                                                 'options'=>array(
                                                     'showAnim'=>'fold',
                                                     'showOn'=>'both',//focus,button,both
                                                     'changeMonth'=>true,
                                                     'changeYear'=>true,
                                                     'yearRange'=>'-5:+100',//next hundred years
                                                     'buttonText'=>'Please select date',
                                                     'buttonImage'=>Yii::app()->request->baseUrl."/images/calendar.png",
                                                     'buttonImageOnly'=>true,
                                                     'dateFormat'=>'yy-mm-dd',
                                                 ),
                                                 'htmlOptions'=>array(
                                                     'style'=>'height:25px;',
                                                 ),
                                             ));  
                          ?>
              <?php echo TbHtml::error($model,'deadline'); ?>


              <div class="form-actions">
                  <?php echo TbHtml::submitButton('Save',array(
                  'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
                  'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
              )); ?>
                  <?php echo TbHtml::button('Close',array(
                  'color'=>TbHtml::BUTTON_COLOR_DEFAULT,
                  'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
                  'id'=>'close-button'
              )); ?>
              </div>

    <?php $this->endWidget(); ?>
    </div>
    <br /><br />
    <?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		//'eams_central_id',
		'decision_reference',
		'decision_date',
		'description',
		'budgetary_implications',
		'deadline',
		'performance_indicators',
		'responsibility_center',
		'meeting_no',
		'sectoral_council_id',
                array(
                    'name'=>'implementation_status_id',
                    'value'=>!is_null($model->status)?$model->status->description:"Not set"
                ),
		'date_created',
//		'create_user_id',
//		'date_updated',
//		'update_user_id',
	),
)); ?>
</div>

<?php echo TbHtml::pageHeader('','Status Comment(s)'); ?>
<?php foreach ($model->statusLogs as $log):?>
     
      <div class="well">
          <span><strong>Status:</strong></span><?php echo $log->status->description;?>
          <br />
          <span><strong>Status Narrative:</strong></span><?php echo $log->status_narrative;?>
          <br />
          <span><strong>Remarks:</strong></span><?php echo $log->remarks;?>
          <br />
          <i>--<?php echo $log->createUser->username; ?>--<?php echo $log->date_created?></i>
      </div>
<p></p>
<?php endforeach;?>
<span class="help-block">
    &nbsp;<i>Total Comments:</i> <?php echo count($model->statusLogs) ?>
</span>
