<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
                
                
                
	?>
            <br/><br /><br/><br />
            <?php 
//$this->Widget('HighchartsWidget', array(
//   'options'=>array(
//      'chart'=>array(
//          'type'=>'gauge',
//            'alignTicks'=>false,
//            'plotBackgroundColor'=>null,
//            'plotBackgroundImage'=>null,
//            'plotBorderWidth'=> 0,
//            'plotShadow'=>false
//      ),
//       'title'=>array(
//           'text'=>'Overall Performance'
//       ),
//       
//       'pane'=>array(
//            'startAngle'=>-150,
//            'endAngle'=> 150,
//             'background'=> array(
//                 array(
//                'backgroundColor'=> array(
//                    'linearGradient'=> array( 'x1'=>0, 'y1'=> 0, 'x2'=> 0, 'y2'=> 1 ),
//                    'stops'=> array(
//                        array(0, '#FFF'),
//                        array(1, '#333')
//                    )
//                ),
//                'borderWidth'=> 0,
//                'outerRadius'=> '109%'
//            ), array(
//                'backgroundColor'=> array(
//                    'linearGradient'=>array( 'x1'=> 0, 'y1'=> 0, 'x2'=> 0, 'y2'=> 1 ),
//                    'stops'=> array(
//                        array(0, '#333'),
//                        array(1, '#FFF')
//                    )
//                ),
//                'borderWidth'=> 1,
//                'outerRadius'=> '107%'
//            ), 
//                array(
//                'backgroundColor'=> '#DDD',
//                'borderWidth'=>0,
//                'outerRadius'=> '105%',
//                'innerRadius'=> '103%'
//            ))
//        ),
//       
//       'yAxis'=>array(
//            'min'=> 0,
//            'max'=> 20.0,
//
//            'minorTickInterval'=> 'auto',
//            'minorTickWidth'=> 1,
//            'minorTickLength'=> 10,
//            'minorTickPosition'=> 'inside',
//            'minorTickColor'=> '#666',
//
//            'tickPixelInterval'=> 30,
//            'tickWidth'=> 2,
//            'tickPosition'=> 'inside',
//            'tickLength'=> 10,
//            'tickColor'=> '#666',
//            'labels'=> array(
//                'step'=> 2,
//                'rotation'=> 'auto'
//            ),
//            'title'=> array(
//                'text'=> 'activity/quarter'
//            ),
//            'plotBands'=> array(
//                array(
//                'from'=> 0,
//                'to'=> 120,
//                'color'=> '#55BF3B' // green
//            ), array(
//                'from'=> 120,
//                'to'=> 160,
//                'color'=> '#DDDF0D' // yellow
//            ), array(
//                'from'=> 160,
//                'to'=> 200,
//                'color'=> '#DF5353' // red
//            ))
//        ),
//       'series'=> array(array(
//            'name'=> 'Speed',
//            'data'=>array(80),
//            'tooltip'=> array(
//                'valueSuffix'=>' activity/quarter'
//            )
//        ))
//   )
//));
//
//Yii::app()->clientScript->registerScriptFile('//code.highcharts.com/highcharts-more.js');
?> 
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>