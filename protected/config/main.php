<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

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
			'password'=>'1',
// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

	),

// application components
	'components'=>array(
		'user'=>array(
			'class'=>'WebUser',
// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'mailer' => array(
			'class' => 'application.extensions.mailer.EMailer',
			'pathViews' => 'application.views.email',
			'pathLayouts' => 'application.views.email.layouts',
			'Host' => 'smtp.exmail.qq.com',
			'Port' => 25,
			'Mailer' => 'smtp',
			'SMTPAuth' => true,
			'Username' => 'system@gulu.me',//你的用户名，或者完整邮箱地址
			'Password' => 'gulu!@#321',//邮箱密码
			'From' => 'system@gulu.me',
			'FromName' => '咕噜工坊'
		),
			// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'gii/'=>'gii/default',
				'<controller:\w+>/'=>'<controller>/index',
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
			'connectionString' => 'mysql:host=localhost;dbname=gulu',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
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
					'levels'=>'error, warning',
			),
			// uncomment the following to show log messages on web pages
			/*
			array(
			'class'=>'CWebLogRoute',
			),
			*/
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