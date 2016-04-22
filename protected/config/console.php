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
<<<<<<< HEAD
			'password' => 'meac_db@2015',
=======
			'password' => 'pass',
>>>>>>> 806963d894912dc7752682d5cde4e8a909f3d8de
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
