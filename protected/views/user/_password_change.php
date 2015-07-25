<?php echo TbHtml::pageHeader('', 'User Account '); ?>

<fieldset>
    <legend>Change Password</legend>
<?php echo TbHtml::beginFormTb()?>
      <?php echo TbHtml::label('<b>New Password</b>','new_password');?>
      <?php echo TbHtml::passwordField('new_password','',array('placeholder'=>'Enter new password here...')); ?>
      <div class="form-actions">
        <?php echo TbHtml::submitButton('Change',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
      </div>
 

<?php echo TbHtml::endForm();?>
</fieldset>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		//'id',
		'username',
		'first_name',
		'middle_name',
		'last_name',
               
                $model->is_mda?
                    array(
                        'label'=>'MDA',
                        'value'=>!is_null($model->mda)?$model->mda->description:"",
                    ):
                    array(
                        'label'=>'MEAC Office',
                        'value'=>!is_null($model->meacOffice)?$model->meacOffice->description:"",
                    ),
		'sex',
                array(
                    'name'=>'active',
                    'value'=>$model->active?"Yes":"No"
                )
	),
)); ?>
