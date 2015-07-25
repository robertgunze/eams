<?php
/* @var $this EacStatusLogController */
/* @var $model EacStatusLog */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status_id',array('span'=>5)); ?>

                    <?php echo $form->textAreaControlGroup($model,'remarks',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'create_user_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_created',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'update_user_id',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'date_updated',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->