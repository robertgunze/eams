<?php
/* @var $this EacFactsController */
/* @var $model EacFacts */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5,'maxlength'=>20)); ?>

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
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->