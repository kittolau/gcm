<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'web_db',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
            'application.components.FileSystemModule.*',
                'application.components.ThumbnailModule.*',
                'application.components.SpecificModule.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abc123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
                'comment'=>array(
            'class'=>'ext.comment-module.CommentModule',
            'commentableModels'=>array(
                // define commentable Models here (key is an alias that must be lower case, value is the model class name)
                'post'=>'Illust',
                'groupproduct'=>'GroupProduct',
            ),
            // set this to the class name of the model that represents your users
            'userModelClass'=>'User',
            // set this to the username attribute of User model class
            'userNameAttribute'=>'user_name',
            // set this to the email attribute of User model class
            'userEmailAttribute'=>'email',
            // you can set controller filters that will be added to the comment controller {@see CController::filters()}
//          'controllerFilters'=>array(),
            // you can set accessRules that will be added to the comment controller {@see CController::accessRules()}
//          'controllerAccessRules'=>array(),
            // you can extend comment class and use your extended one, set path alias here
//	        'commentModelClass'=>'comment.models.Comment',
        ),
	),

	// application components
	'components'=>array(

                'cache'=>array( //cache for db schema
                    'class'=>'CDbCache'
                ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class' => 'WebUser',
		),

                'image'=>array(
                    'class'=>'application.extensions.image.CImageComponent',
                    // GD or ImageMagick
                    'driver'=>'GD',
                    // ImageMagick setup path
                    //'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
                ),


		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
                        'appendParams'=>true,
                        'showScriptName'=>false,
                        'caseSensitive'=>true,
			'rules'=>array(
                                '<controller:\w+>/<id:\d+>/<seotitle:(?:\w+-|\w+)+>'=>'<controller>/view',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

            /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
             */

		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=web_db',
                        'queryCachingDuration'=>3600,
                        //'schemaCachingDuration'=>3600, //seconds to cache the db schema
                        //'enableParamLogging'=>true, //for sql profiling
                        //'enableProfiling'=>true, //for sql profiling
			'emulatePrepare' => true,
			'username' => 'web_db',
			'password' => 'web_db',
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
            /*
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
		*/


	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
