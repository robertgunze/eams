<?php
/* @var $this DashboardController */

$this->layout = '//layouts/column1';
$this->breadcrumbs = array(
    'Dashboard',
);
?>

<?php echo TbHtml::pageHeader('', 'Dashboard / Data Visualization'); ?>

<div class="well">
    <div style="width:100%">
        <table >
            <tr >
                <td>
                    <div style="width:95%;height:100%" class="btn btn-success">
                        <div>Number of fully implemented decisions </div>
                        <h2><?php echo EacDecision::getDecisionsApproachingDeadline(); ?></h2>
                        <p><a>(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-warning">
                        <div>Number of partially implemented decisions</div>
                        <h2><?php echo EacDecision::model()->count(); ?></h2>
                        <p><a href="<?php ?>">(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-danger">
                        <div>Number of pending decisions</div>
                        <h2><?php echo User::model()->count('is_mda=:is_mda', array(':is_mda' => 1)); ?></h2>
                        <p><a>(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
            </tr>
            <tr >
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-danger">
                        <div>Number of Decisions Approaching Deadline</div>
                        <h2><?php echo EacDecision::getDecisionsApproachingDeadline(); ?></h2>
                        <p><a>(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-info">
                        <div>Number of Uploaded Decisions</div>
                        <h2><?php echo EacDecision::model()->count(); ?></h2>
                        <p><a href="<?php echo $this->createUrl('/eacDecision/admin'); ?>" >(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-info">
                        <div>Number of MDA Users</div>
                        <h2><?php echo User::model()->count('is_mda=:is_mda', array(':is_mda' => 1)); ?></h2>
                        <p><a href="<?php echo $this->createUrl('/user/mdas'); ?>">(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="width:95%;height:100%"  class="btn btn-info">
                        <div>Number of Users</div>
                        <h2><?php echo User::model()->count(); ?></h2>
                        <p><a href="<?php echo $this->createUrl('/user/admin'); ?>">(View all&nbsp;<span class="icon-arrow-right">&nbsp;</span>)</a></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <?php
    $this->Widget('HighchartsWidget', array(
        'options' => array(
            'colors' => array('#D24842', '#468847', '#F89406'),
            'chart' => array(
                'plotBackgroundColor' => null,
                'plotBorderWidth' => 1, //null,
                'plotShadow' => false
            ),
            'title' => array('text' => 'Decision/Directives Implementation Status'),
            'tooltip' => array(
                'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
            ),
            'plotOptions' => array(
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => array(
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                    'style' => array(
//                                    'color'=> 'js:(Highcharts.theme && Highcharts.theme.contrastTextColor)' || 'black'
                    )
                )
            ),
            'series' => array(
                array(
                    'type' => 'pie',
                    'name' => 'Percentage',
                    'data' => EacDecision::getImplementationStatusDistribution()
                )
            )
        ),
    ));
    ?>
</div>






