<?php
/* @var $this DashboardController */

$this->layout='//layouts/column1';
$this->breadcrumbs=array(
	'Dashboard',
);
?>

<?php echo TbHtml::pageHeader('', 'Dashboard / Data Visualization'); ?>

<div class="well">
<div style="width:100%">
  <table >
  <tr >
  <td><span class="alert alert-success">Number of Decisions Approaching Deadline <?php echo EacDecision::getDecisionsApproachingDeadline();?></span></td>
  <td><span class="alert alert-danger">Number of Uploaded Decisions <?php echo EacDecision::model()->count();?></span></td>
  <td><span class="alert alert-success">Number of MDA Users <?php echo User::model()->count('is_mda=:is_mda',array(':is_mda'=>1));?></span></td>
  <td><span class="alert alert-info">Number of Users <?php echo User::model()->count();?></span></td>
  </tr>
  </table>
</div>
    
     <?php $this->Widget('HighchartsWidget', array(
               'options'=>array(
                  'colors'=>array('#D24842','#468847','#F89406'),
                  'chart'=>array(
                       'plotBackgroundColor'=> null,
                       'plotBorderWidth' => 1,//null,
                       'plotShadow' => false
                  ),
                  'title' => array('text' =>'Decision/Directives Implementation Status'),
                   'tooltip'=> array(
                        'pointFormat'=>'{series.name}: <b>{point.percentage:.1f}%</b>'
                    ),
                   'plotOptions'=>array(
                        'allowPointSelect'=> true,
                            'cursor'=> 'pointer',
                            'dataLabels'=> array(
                                'enabled'=> true,
                                'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                                'style'=> array(
//                                    'color'=> 'js:(Highcharts.theme && Highcharts.theme.contrastTextColor)' || 'black'
                                )
                            )
                        ),
                   'series' =>array(
                       array(
                                'type'=>'pie',
                                'name'=>'Percentage',
                                'data'=>  EacDecision::getImplementationStatusDistribution()
                           )
                   )

                   ),
      
));
    
    ?>
</div>






