<fieldset>
    <legend>Reset Password</legend>
<?php echo TbHtml::beginFormTb()?>
      <?php echo TbHtml::label('<b>Email</b>','email');?>
      <?php echo TbHtml::textField('email','',array('placeholder'=>'Enter your email here...','span'=>5)); ?>
      <div class="form-actions">
        <?php echo TbHtml::submitButton('Submit',array(
		    'color'=>TbHtml::BUTTON_COLOR_SUCCESS,
		    'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
      </div>
 

<?php echo TbHtml::endForm();?>
</fieldset>