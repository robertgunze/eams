<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

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
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->