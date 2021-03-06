<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'eac-facts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'protocol_id',array('span'=>5,'maxlength'=>10)); ?>

            <?php echo $form->textFieldControlGroup($model,'protocol_details',array('span'=>5,'maxlength'=>300)); ?>

            <?php echo $form->textFieldControlGroup($model,'protocol_provision_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'protocol_provision_description',array('span'=>5,'maxlength'=>300)); ?>

            <?php echo $form->textFieldControlGroup($model,'data_field_code',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'data_field_desc',array('span'=>5,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'indicator_id',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'indicator_description',array('span'=>5,'maxlength'=>300)); ?>

            <?php echo $form->textFieldControlGroup($model,'data_collection_guidelines',array('span'=>5,'maxlength'=>300)); ?>

            <?php echo $form->textFieldControlGroup($model,'numeric_data',array('span'=>5,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'alphanumeric_data',array('span'=>5,'maxlength'=>255)); ?>

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