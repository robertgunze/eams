<?php /* @var $this Controller */ 
 Yii::app()->bootstrap->register();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu" >
            <?php 
                ob_start();
                echo TbHtml::badge('2', array('color' => TbHtml::BADGE_COLOR_SUCCESS));
                $indicatorCount = ob_get_contents();
                ob_clean();
            ?>
            <?php  $this->widget('bootstrap.widgets.TbNavbar', array(
                    'brandLabel' => '<strong><span style="color:#56AD56">EAMS </span>TANZANIA</strong>',
                    'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
                    'items'=>array(
                        //!Yii::app()->user->isGuest?  EamsFacts::loadNotifier():"",
                        array(
                            'class' => 'bootstrap.widgets.TbNav',
			'items'=>array(
                               array('label'=>'EAC Decisions','icon'=>TbHtml::ICON_LIST_ALT, 'url'=>array('/eacDecision/admin'),'visible'=>!Yii::app()->user->isGuest,
                                       'items'=>array(
                                           array('label'=>'Decisions','icon'=>TbHtml::ICON_LIST_ALT, 'url'=>array('/eacDecision/admin'),'visible'=>!Yii::app()->user->isGuest),
                                
                                           array('label'=>'Import/Export','icon'=>TbHtml::ICON_SHARE,'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda,
                                                    'items'=>array(
                                                        array('label'=>'Import', 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest,
                                                                  'items'=>array(
                                                                      array('label'=>'Decisions', 'url'=>array('/import/importdecisions'),'visible'=>!Yii::app()->user->isGuest),
                                                                    )
                                                                ),
                                                        array('label'=>'Export', 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest,
                                                                'items'=>array(
                                                                    array('label'=>'Decision Status Updates', 'url'=>array('/export/exportdecisions'),'visible'=>!Yii::app()->user->isGuest),            
                                                                    )
                                                            ),
                                                    ),
                                        ),
                                           
                                      
                                       ),
                                    ),
                                 array('label'=>'Common Market', 'icon'=>TbHtml:: ICON_INFO_SIGN ,'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda,
                                             'items'=>array(
                                                  array('label'=>'Indicator Updates', 'url'=>array('/eacFacts/admin'),'visible'=>!Yii::app()->user->isGuest),
                                                  array('label'=>'Import', 'url'=>array('/import/importCommonMarket'),'visible'=>!Yii::app()->user->isGuest),
                                                 )
                                            ),
//                                array('label'=>'EAC Development Strategy','icon'=>TbHtml:: ICON_INFO_SIGN , 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest,
//                                            'items'=>array(
//                                                array('label'=>'Indicator Reporting', 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest),
//                                                array('label'=>'Import', 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest),
//                                               )
//                                          ),
                                array('label'=>'MEAC Strategic Plan','icon'=>TbHtml::ICON_CALENDAR, 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda,
                                        'items'=>array(
                                        array('label'=>'National EAC Outcomes', 'url'=>array('/eamsFramework/EACOutcomesAdmin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'MEAC Strategic Plan', 'url'=>array('/eamsFramework/spadmin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Indicators Facts Sheet','url'=>array('/eamsFacts/indicatorReporting'),'visible'=>!Yii::app()->user->isGuest),
                                       
                                        )
                                    ),
                               
                                 array('label'=>'Dashboard','icon'=>TbHtml::ICON_SIGNAL, 'url'=>array('/dashboard/index'),'visible'=>!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda),
                                
                                  array('label' => 'Data Exchange', 'icon' => TbHtml::ICON_BRIEFCASE, 'url' => array('#'), 'visible' => !Yii::app()->user->isGuest && !Yii::app()->user->is_mda,
                                    'items' => array(
                                        array('label' => 'Import Data', 'url' => array('/eamsFilesImport/admin'), 'visible' => !Yii::app()->user->isGuest),
                                        array('label' => 'Export Data', 'url' => array('/export/admin'), 'visible' => !Yii::app()->user->isGuest),
                                    )
                                ),
                                array('label'=>'Settings','icon'=>TbHtml::ICON_WRENCH, 'url'=>array('#'),'visible'=>!Yii::app()->user->isGuest&&!Yii::app()->user->is_mda, 
                                    'items'=>array(
                                        array('label'=>'Users and Security', 'url'=>array('/user/admin'),'visible'=>!Yii::app()->user->isGuest,
                                              'items'=>array(
                                                  array('label'=>'Users Manager', 'url'=>array('/user/admin'),'visible'=>!Yii::app()->user->isGuest),
                                                  array('label'=>'Roles Manager', 'url'=>array('/authItem/roles'),'visible'=>!Yii::app()->user->isGuest),
                                                  array('label'=>'Actions Manager', 'url'=>array('/authItem/admin'),'visible'=>!Yii::app()->user->isGuest),
                                                  array('label'=>'Audit Trail', 'url'=>array('/auditTrail/admin'),'visible'=>!Yii::app()->user->isGuest),
                                                  array('label'=>'Logins Manager', 'url'=>array('/login/admin'),'visible'=>!Yii::app()->user->isGuest),
                                                 
                                              )
                                            ),
                                        array('label'=>'MEAC Office', 'url'=>array('/meacOffice/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'MDAs Manager', 'url'=>array('/mda/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Framework', 'url'=>array('/eamsFramework/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Framework Type', 'url'=>array('/eamsFrameworkType/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Indicators', 'url'=>array('/indicator/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Data Sources', 'url'=>array('/indicatorDataSource/admin'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Indicator Units', 'url'=>array('/indicatorUnit/admin'),'visible'=>!Yii::app()->user->isGuest),

                                        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'),'visible'=>!Yii::app()->user->isGuest),
				
                                        )
                                    ),
                                
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'','icon'=>  TbHtml::ICON_USER ,'url'=>array('#'), 'visible'=>!Yii::app()->user->isGuest,
                                     'items'=>array(
                                        array('label'=>'Logout', 'url'=>array('/site/logout'),'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Change Password', 'url'=>array('/user/passwordChange'),'visible'=>!Yii::app()->user->isGuest),
                                        
                                        )
                                    
                                    )
			),
                       )
		    )
		)); ?>
	</div><!-- mainmenu --><br /><br /><br /><br />
        <div class="brand" style="margin-left: 5%;margin-right:5%;">
            <table id="tbl_logos">
                 <tr>
                     <td><?php echo TbHtml::imageRounded(Yii::app()->request->baseUrl.'/images/logo.png', '',array('width'=>80,'height'=>80,'class'=>'logo'))?></td>
                     <td>
                     <center>
                      <?php echo TbHtml::pageHeader('', 
                         Yii::t('strings', substr(CHtml::encode(Yii::app()->name),0,27)."<br />".substr(CHtml::encode(Yii::app()->name),28),['style'=>'font-size:40px;']) 
                        );
                      ?>
                     </center></td>
                     <td><?php echo TbHtml::imageRounded(Yii::app()->request->baseUrl.'/images/tmea.png', '',array('width'=>100,'height'=>100,'class'=>'tmea'))?></td>
                     <td><?php echo TbHtml::imageRounded(Yii::app()->request->baseUrl.'/images/eac_logo.png', '',array('width'=>100,'height'=>100,'class'=>'eac'))?></td>
                 </tr>
             </table>
        </div>
	<?php if(isset($this->breadcrumbs)):?>
        
               <?php 
               // $this->widget('bootstrap.widgets.TbBreadcrumb', array(
               //                  'links' => $this->breadcrumbs,        
               // )); 

               ?><!-- breadcrumbs -->
	<?php endif?>
        
        <?php foreach(Yii::app()->user->getFlashes() as $key => $message) : ?>
        <?php echo TbHtml::alert($key, $message); ?>
        <?php endforeach; ?>
	<?php echo $content; ?>

	<div class="clear"></div>
	<div id="footer" class="well" style="text-align: center">
            <?php if(!Yii::app()->user->isGuest): ?>
                Currently logged in as: <i><?php echo Yii::app()->user->getState('loggedInUser');?></i> Current date: <?php echo date('Y-m-d @ H:i:s')?>	
                <br />
            <?php endif;?>
		Copyright &copy; <?php echo date('Y'); ?> by  Ministry of Foreign Affairs, East African, Regional and International Cooperation.
		All Rights Reserved.<br/>
               <?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
