<div class="form wide">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'auth-item-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'type'); ?>
        <?php //echo $form->textField($model,'type'); ?>
<?php echo $form->hiddenField($model, 'type', array('value' => 1)); ?>
<?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
<?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'description'); ?>
    </div>


    <div class="row buttons">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); 
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->