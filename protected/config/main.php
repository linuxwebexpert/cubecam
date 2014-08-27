<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// set the hostname of this machine and enable/disable weblogs
(isset($_SERVER['HTTP_HOST'])) ? $HOSTMACHINE = $_SERVER['HTTP_HOST'] : $HOSTNAME = exec('hostname');

if (!preg_match('%(ssfrtspa|ironcore|13|41|radon10|devbox)%i',$HOSTMACHINE))
{
	$weblog = true;
}
else
{
	$weblog = false;
}

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Cube Cam',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.adLDAP.*',
		'application.vendors.DateIterator.*',
		'application.vendors.highcharts.*',
		'application.extensions.arrayDataProvider.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'A$tr0',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','*','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'file'=>array(
        'class'=>'application.extensions.file.CFile',
   		 ),
		
	    'email'=>array(
	        'class'=>'application.extensions.email.Email',
	        'delivery'=>'php', //Will use the php mailing function.  
	        //May also be set to 'debug' to instead dump the contents of the email into the view
	    ),
		'ftp'=>array(
		          'class'=>'application.extensions.ftp.EFtpComponent',
/*
		          'host'=>'217.109.2.164',
		          'port'=>21,
		          'username'=>'Gabardan_ZT',
		          'password'=>'KJD!781#fg12',
		          'ssl'=>false,
		          'timeout'=>90,
		          'autoConnect'=>true,
		          'passive'=>true,
*/
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			/*
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			*/
		),
/*		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=motion',
			'emulatePrepare' => true,
			'username' => 'smes',
			'password' => 'A$tr0',
			'charset' => 'utf8',
   		 	'enableProfiling'=>true,
        	'class'=>'CDbConnection',
		),
				'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'info, error, warning',
                    'categories'=>'system.*',
	                'filter' => array(
	                    'class' => 'CLogFilter',
	                    'prefixSession' => false,
	                    'prefixUser' => false,
	                    'logUser' => true,
	                    'logVars' => array(),
                	),
                ),
                array(
                    'class'=>'CDbLogRoute',
                	'connectionID'=>'db',
  					'autoCreateLogTable'=>true,
                    'levels'=>'info, error, warning',
                    'categories'=>'system.*',
	                'filter' => array(
	                    'class' => 'CLogFilter',
	                    'prefixSession' => false,
	                    'prefixUser' => false,
	                    'logUser' => true,
	                    'logVars' => array(),
                	),
				),
                array(
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'categories'=>'system.*',
                	'enabled'=>$weblog,
                ),
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'ghackett@solaria.com',
	                'filter' => array(
	                    'class' => 'CLogFilter',
	                    'prefixSession' => false,
	                    'prefixUser' => false,
	                    'logUser' => true,
	                    'logVars' => array(),
                	),
                ),
//				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
                	'enabled'=>$weblog,
				),
                
            ),
        ),
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'ghackett@solaria.com',
		'webRoot' => dir(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'),
    	'IT'=> array('ghackett','hmilani','vteli','eaustin'),
    	'subscribe' => array('ghackett','rmack','jwang','eaustin'),
    	'users'=> array('ghackett','hmilani','rmack','jwang','vteli','cbaranda','eaustin'),
    	'ftpDelete'=>false,
    	'notifierList'=>"ghackett@solaria.com, eaustin@solaria.com",
    	'testHosts'=>array('devbox.solaria.com','appdev.solaria.com','radon10.solaria.com'),
   		'testFtp'=>array('host'=>'192.168.100.12','user'=>'tisftp1','pass'=>'p4tisT35T'),
   		'meteoFtp'=>array('host'=>'www1.meteocontrol.de','user'=>'solaria','pass'=>'C0lAPiA#21'),
   		'devEmailList'=>('eaustin@solaria.com,ghackett@solaria.com'),
   		'isProduction'=>false,
   		'thumbCount'=>24,
	),	
);