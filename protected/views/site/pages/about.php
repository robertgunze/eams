<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<?php echo TbHtml::pageHeader('', 'About'); ?>

<?php $aboutContent = 
"
<h2>EAMS-TANZANIA</h2>
<div style='font-size:small;'>
Product Version: EAMS-TANZANIA 0.0.5 (Release 201210100934)<br />
Updates: Updates available<br />
PHP: 5.4<br />
System: Linux <br />
Copyright © 2014 by VECA Technologies. All Rights Reserved.
</div>
" ;

?>
<?php echo TbHtml::heroUnit(null,$aboutContent);?>