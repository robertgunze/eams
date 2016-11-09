<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>
<?php 
Yii::app()->clientScript->registerScript('user-identity', "
$('#User_is_mda').change(function(){
	$('#meac_office_field').toggle();
        $('#mda_field').toggle();
	return false;
});
");
?>
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'username',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'first_name',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'middle_name',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'last_name',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->radioButtonListControlGroup($model,'sex',array('M'=>'Male','F'=>'Female')); ?>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'phone'); ?>
      
            <table style="background-color:#F6F6F6;">
                <tr>
                    <td>
                        <?php echo $form->checkBoxControlGroup($model, 'is_mda'); ?>
                        <span class="hint"><i>Tick to select an MDA for the user account</i></span>
                    </td>
                    <td id="meac_office_field" style="<?php echo !$model->is_mda ? 'display:block':'display:none'?>"><?php echo $form->dropDownListControlGroup($model, 'meac_office_id', TbHtml::listData(MeacOffice::model()->findAll(),'id','description'),array('prompt'=>'--select--')); ?></td>
                    <td id="mda_field" style="<?php echo $model->is_mda ? 'display:block':'display:none'?>"><?php echo $form->dropDownListControlGroup($model, 'mda_id', TbHtml::listData(Mda::model()->findAll(),'id','description'),array('prompt'=>'--select--')); ?></td>
                </tr>
            </table>
            
           
    
           
            <?php echo $form->checkBoxControlGroup($model,'active',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->