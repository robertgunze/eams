<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
         'id'=>'upload_decisions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
         'htmlOptions'=>array(
                 'enctype'=>'multipart/form-data'
          )
        
        ));?>
<fieldset>
    <legend>Upload</legend>
    <?php if(Yii::app()->user->hasFlash('success')):?>
    <?php echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('success'))?>
    <?php endif;?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->fileFieldControlGroup($model,'upload_file'); ?>
    <div class="form-actions">
        <?php echo TbHtml::submitButton('Import',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>
</fieldset>
<?php $this->endWidget();?>
</div>