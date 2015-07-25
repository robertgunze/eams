<?php
/* @var $this EamsFrameworkController */
/* @var $model EamsFramework */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'eams-framework-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

<!--    <p class="help-block">Fields with <span class="required">*</span> are required.</p>-->

    <?php // echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'framework_description', array('span' => 5, 'maxlength' => 255)); ?>           

    <?php // echo $form->dropDownListControlGroup($model, 'type_id', TbHtml::listData(EamsFrameworkType::model()->findAll(), 'id', 'description'), array('prompt' => '--select--')); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'type_id'); ?>
        <?php
        echo $form->dropDownList($model, 'type_id', CHtml::listData(EamsFrameworkType::model()->findAll(), 'id', 'description'), array(
            'prompt' => '--select--',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('loadParents'),
                'update' => '#parent_id',
                'data' => array('type' => 'js:this.value'),
            ))
        );
        ?>
    </div>

    <?php // echo $form->dropDownListControlGroup($model, 'parent_id', TbHtml::listData(EamsFramework::model()->findAll(), 'id', 'framework_description'), array('prompt' => '--select--')); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php
        echo CHtml::dropDownList('parent_id', '', array(), array('prompt' => '--select--'));
        ?>
    </div>

    <?php echo $form->textFieldControlGroup($model, 'guid', array('span' => 5, 'maxlength' => 10)); ?>

    <div class="form-actions">
        <?php
        echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->