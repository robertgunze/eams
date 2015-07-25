<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'title',array('span'=>5,'maxlength'=>255)); ?>

            <div class="row">
            <?php echo $form->label($model,'body'); ?>
            <?php $this->widget('ext.extckeditor.ExtCKEditor', array(
            'model'=>$model,
            'attribute'=>'body', // model atribute
            'language'=>'en', /* default lang, If not declared the language of the project will be used in case of using multiple languages */
            'editorTemplate'=>'full', // Toolbar settings (full, basic, advanced)
            )); ?>
            <?php $form->error($model,'body'); ?>
            </div>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>3,'readOnly'=>$model->isNewRecord?false:true,'maxlength'=>50)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->