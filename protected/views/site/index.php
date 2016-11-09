<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php //echo TbHtml::pageHeader('', Yii::t('strings',CHtml::encode(Yii::app()->name)))?>
<?php if(!empty(Yii::app()->user->getState('pending-decisions-message'))) : ?>
<?php echo TbHtml::alert(TbHtml::ALERT_COLOR_INFO, Yii::app()->user->getState('pending-decisions-message'),array('style'=>'position:fixed;width:50%;height:200px;margin-left:15%;margin-right:15%')); ?>
<?php Yii::app()->user->setState('pending-decisions-message','');?>
<?php endif; ?>

<?php $aboutContent = 
TbHtml::link('',$this->createUrl('//page/update',array('id'=>$model->id)),array('class'=>TbHtml::ICON_PENCIL)).
"
<h3>$model->title</h3>
<div style='font-size:14px;height:150px;'>
$model->body
</div>
" ;

?>
<?php echo TbHtml::heroUnit(null,$aboutContent);?>
