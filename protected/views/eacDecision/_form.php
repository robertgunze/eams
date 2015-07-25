<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'eac-decision-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'eams_central_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'decision_reference',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'decision_date',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>5000)); ?>

            <?php echo $form->textFieldControlGroup($model,'budgetary_implications',array('span'=>5,'maxlength'=>5000)); ?>

            <?php echo $form->textFieldControlGroup($model,'time_frame',array('span'=>5,'maxlength'=>5000)); ?>

            <?php echo $form->textFieldControlGroup($model,'performance_indicators',array('span'=>5,'maxlength'=>5000)); ?>

            <?php echo $form->textFieldControlGroup($model,'responsibility_center',array('span'=>5,'maxlength'=>5000)); ?>

            <?php echo $form->textFieldControlGroup($model,'meeting_no',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'sectoral_council_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'implementation_status_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'date_created',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'create_user_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'date_updated',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'update_user_id',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->