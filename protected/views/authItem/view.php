<?php
if ($model->type == 2) {
    $this->breadcrumbs = array(
        'Groups' => array('roles'),
        $model->name,
    );
    
    echo TbHtml::pageHeader('', 'View Group/Role:- '.$model->name);
}
else{
     $this->breadcrumbs = array(
        'Actions' => array('admin'),
        $model->name,
    ); 
     
    echo TbHtml::pageHeader('', 'View Action:- '.$model->name);
}
?>

<?php // echo TbHtml::pageHeader('', 'View Group/Role'); ?>

<div class="well">
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => TbHtml::DETAIL_TYPE_BORDERED,
        'data' => $model,
        'attributes' => array(
            'name',
            //'type',
            'description',
        //'bizrule',
        //'data',
        ),
    ));
    ?>
    <?php
    if ($model->type == 2) {
        echo TbHtml::link('Add access items to this group', $this->createUrl('/authItem/assignItems', array('name' => $model->name)), array('class' => 'btn btn-success'));
    }
    ?>
</div>

