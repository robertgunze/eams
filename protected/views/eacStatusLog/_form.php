<?php
/* @var $this EacStatusLogController */
/* @var $model EacStatusLog */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'eac-status-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

            
            <?php echo $form->dropDownListControlGroup($model,'status_id',TbHtml::listData(EacLookup::model()->findAll('type=:type',array(':type'=>  EacLookup::IMPLEMENTATION_STATUS)),"id","description"), 
                    array(
                        'empty'=>'--select--'
                    )); ?>
            <?php echo $form->textAreaControlGroup($model,'status_narrative',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textAreaControlGroup($model,'remarks',array('rows'=>6,'span'=>8)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->