<?php
 $this->breadcrumbs = array(
        'Groups' => array('roles'),
        //$model->name,
    );
/* @var $this RespondentController */
/* @var $model Respondent */

$this->layout ='//layouts/column1';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#respondent-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Groups/Roles'); ?>

<?php echo CHtml::link('Create Group/Role',$this->createUrl('createRole'),array('class'=>'btn btn-success')); ?>
<br/><br/>
<div class="search-form" style="display:none">

</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'respondent-grid',
	'dataProvider'=>$dataProvider,
	   'columns' => array(
        array('name' => 'Number',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        'name',
        //'type',
        'description',
        //'bizrule',
        //'data',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}',
            'header' => 'Options',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl("authItem/update", array("id"=>"$data->primaryKey","opt"=>2))',
                ),
            ),
        ),
    ),
)); ?>


