<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'graphic site',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abc123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

	// application components
	'components'=>array(
            /*
                'cache'=>array( //cache for db schema
                    'class'=>'CDbCache'
                ),
                */
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
            /*
                'image'=>array(
                    'class'=>'application.extensions.image.CImageComponent',
                    // GD or ImageMagick
                    'driver'=>'GD',
                    // ImageMagick setup path
                    'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
                ),
             * */

		// uncomment the following to enable URLs in path-format
	/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
            */
            /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
             */

		// uncomment the following to use a MySQL database

                'cache'=>array( //cache for db schema
                    'class'=>'CDbCache'
                ),

		'db'=>array(
                        //EXTREME IMPORTANT
                        //http://stackoverflow.com/questions/12033516/system-db-cdbconnection-taking-more-than-1-second-to-execute-in-yii
                        // using localhost will be much slower than 127.0.0.1
			'connectionString' => 'mysql:host=127.0.0.1;dbname=cf',
                        'queryCachingDuration'=>3600,
                        'schemaCachingDuration'=>3600, //seconds to cache the db schema
                        'enableParamLogging'=>true, //for sql profiling
                        'enableProfiling'=>true, //for sql profiling
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
                /*
                'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cf',
			'emulatePrepare' => true,
			'username' => 'cf',
			'password' => '!T1sH4rDt0GuE3s',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

                //Opimization: Symlinking assets
                'assetManager' => array(
                    'linkAssets' => true,
                ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace,info,error, warning',
				),
				// uncomment the following to show log messages on web pages

				array(
					//'class'=>'CWebLogRoute',
                                    'class'=>'CProfileLogRoute', //for sql profiling
                                    'report'=>'summary', //for sql profiling
				),

			),
		),


	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
