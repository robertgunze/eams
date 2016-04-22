<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Cron',

	// preloading 'log' component
	'preload'=>array('log'),
    
        'import'=>array(
            'application.components.*',
            'application.models.*',
            ),

	// application components
	'components'=>array(
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=eams_country_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'meac_db@2015',
			'charset' => 'utf8',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                                array(
                                    'class'=>'CFileLogRoute',
                                    'logFile'=>'cron.log',
                                    'levels'=>'error, warning',
                                ),
                                array(
                                    'class'=>'CFileLogRoute',
                                    'logFile'=>'cron_trace.log',
                                    'levels'=>'trace',
                                ),
                        ),
		),
	),
);
