<?php
/* @var $this UserController */
/* @var $model User */
$this->layout = '//layouts/column1';

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo TbHtml::pageHeader('', 'Manage Users'); ?>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<?php echo CHtml::link('Create Account',$this->createUrl('user/create'),array('class'=>'btn btn-success')); ?>
<div style="clear:both;margin-bottom: 20px;"></div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
                array( 
                'class' => 'editable.EditableColumn',
                'name' => 'first_name',
                'editable' => array(
                  'type'     => 'text',
                  'url'      => $this->createUrl('user/ajaxUpdate'),
                  'placement'=>'right',

                  )
                ),
                array( 
                'class' => 'editable.EditableColumn',
                'name' => 'middle_name',
                'editable' => array(
                  'type'     => 'text',
                  'url'      => $this->createUrl('user/ajaxUpdate'),
                  'placement'=>'right',

                  )
                ),
                array( 
                'class' => 'editable.EditableColumn',
                'name' => 'last_name',
                'editable' => array(
                  'type'     => 'text',
                  'url'      => $this->createUrl('user/ajaxUpdate'),
                  'placement'=>'right',

                  )
                ),
		
		            'sex',
                'email',
                'phone',
                
              
                array(
                    'name'=>'meac_office_id',
                    'value'=>'!is_null($data->meacOffice)?$data->meacOffice->description:""',
                    'filter'=>TbHtml::listData(MeacOffice::model()->findAll(),"id","description")
                ),
                array(
                     'name'=>'mda_id',
                    'value'=>'!is_null($data->mda)?$data->mda->description:""',
                    'filter'=>TbHtml::listData(Mda::model()->findAll(),"id","description")
                ),
                array(
                    'name'=>'is_mda',
                    'value'=>'$data->is_mda?"Yes":"No"'
                ),
                array( 
                    'class' => 'editable.EditableColumn',
                    'name' => 'active',
                    'value'=>'$data->active?"Yes":"No"',
                    'editable' => array(
                      'type'     => 'select',
                      'url'      => $this->createUrl('user/ajaxUpdate'),
                      'source'=>array(0=>'Inactive',1=>'Active'),
                      'placement'=>'right',

                      )
                ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>