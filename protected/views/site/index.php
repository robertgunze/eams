<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php //echo TbHtml::pageHeader('', Yii::t('strings',CHtml::encode(Yii::app()->name)))?>

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
