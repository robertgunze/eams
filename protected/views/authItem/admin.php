<?php
      $this->breadcrumbs = array(
        'Actions' => array('admin'),
        $model->name,
    );
?>

<?php echo TbHtml::pageHeader('', 'Manage Actions'); ?>

<?php echo CHtml::link('Create Action',$this->createUrl('createAction'),array('class'=>'btn btn-success')); ?>
<br/><br/>
<div class="search-form" style="display:none">

</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'respondent-grid',
	'dataProvider'=>$model->search(),
	   'columns' => array(
        array(
            'header' => '#',
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



