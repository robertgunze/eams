<?php
/* @var $this EacDecisionController */
/* @var $model EacDecision */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <table class="well">
        
        <tr>
            <td>
              <?php echo $form->dropDownListControlGroup($model,'decision_source_id',
                      TbHtml::listData(EacLookup::model()->findAll('type=:type',array(':type'=>  EacLookup::DECISION_SOURCE)),"id","description"),
                      array('prompt'=>'--select--')
                      ); ?>
            </td>
            <td><?php echo $form->textFieldControlGroup($model,'decision_reference',array('maxlength'=>100)); ?></td>
            <td><?php echo TbHtml::label('Date From', 'dateFrom'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                 'model'=>$model,
                                                 'attribute'=>'dateFrom',
                                                 'options'=>array(
                                                     'showAnim'=>'fold',
                                                     'showOn'=>'both',//focus,button,both
                                                     'changeMonth'=>true,
                                                     'changeYear'=>true,
                                                     'yearRange'=>'-100:+0',//last hundred years
                                                     'buttonText'=>'Please select date',
                                                     'buttonImage'=>Yii::app()->request->baseUrl."/images/calendar.png",
                                                     'buttonImageOnly'=>true,
                                                     'dateFormat'=>'yy-mm-dd',
                                                 ),
                                                 'htmlOptions'=>array(
                                                     'style'=>'height:25px;',
                                                 ),
                                             ));  
                          ?>
              <?php echo TbHtml::error($model,'dateFrom'); ?>
            </td>
            <td><?php echo $form->textFieldControlGroup($model,'responsibility_center',array('maxlength'=>5000)); ?></td>
        </tr>
        
        <tr>
            <td><?php echo $form->dropDownListControlGroup($model,'sectoral_council_id',
                    TbHtml::listData(EacLookup::model()->findAll('type=:type',array(':type'=>  EacLookup::SECTORAL_COUNCIL)),"id","description"),
                    array(
                        'empty'=>'--select--'
                    )); ?>
            </td>
            <td><?php echo $form->dropDownListControlGroup($model,'implementation_status_id',TbHtml::listData(EacLookup::model()->findAll('type=:type',array(':type'=>  EacLookup::IMPLEMENTATION_STATUS)),"id","description"), 
                    array(
                        'empty'=>'--select--'
                    )); ?></td>
              <td><?php echo TbHtml::label('Date To', 'dateTo'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                 'model'=>$model,
                                                 'attribute'=>'dateTo',
                                                 'options'=>array(
                                                     'showAnim'=>'fold',
                                                     'showOn'=>'both',//focus,button,both
                                                     'changeMonth'=>true,
                                                     'changeYear'=>true,
                                                     'yearRange'=>'-100:+0',//last hundred years
                                                     'buttonText'=>'Please select date',
                                                     'buttonImage'=>Yii::app()->request->baseUrl."/images/calendar.png",
                                                     'buttonImageOnly'=>true,
                                                     'dateFormat'=>'yy-mm-dd',
                                                 ),
                                                 'htmlOptions'=>array(
                                                     'style'=>'height:25px;',
                                                 ),
                                             ));  
                          ?>
              <?php echo TbHtml::error($model,'dateTo'); ?>
            </td>
            <td><?php echo $form->textFieldControlGroup($model,'meeting_no'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->dropDownListControlGroup($model,'responsible_mda_id',
                    TbHtml::listData(Mda::model()->findAll(),"id","description"),
                    array(
                        'empty'=>'--select--'
                    )); ?>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
    </table>
                   
        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_DEFAULT,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->