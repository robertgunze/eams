<?php
/* @var $this IndicatorController */
/* @var $model Indicator */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'indicator-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'description',array('span'=>5,'maxlength'=>255)); ?>

            <?php echo $form->textAreaControlGroup($model,'definition',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textAreaControlGroup($model,'interpretation',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textFieldControlGroup($model,'guid',array('span'=>5,'maxlength'=>7)); ?>
    
            <?php echo $form->dropDownListControlGroup($model, 'frequency', TbHtml::listData(Frequency::model()->findAll(),'id','description'));?>
     
            <?php echo $form->dropDownListControlGroup($model, 'indicatorUnit', TbHtml::listData(IndicatorUnit::model()->findAll(),'id','abbrev'));?>

            <?php echo $form->dropDownListControlGroup($model, 'indicatorDataSource', TbHtml::listData(IndicatorDataSource::model()->findAll(),'id','description'));?>

    
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->