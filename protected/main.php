<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'LAYOUT PROJECT',
    'theme' => 'default',
    'language' => 'th',
    // preloading 'log' component
    //'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.Controller',
        'application.components.UserIdentity',
        'application.components.Helpers',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.components.shoppingCart.*',
        'application.extensions.UserCounter',
		 'application.extensions.LnwUpload'
    ),
    /* 'clientScript' => array(
      'class' => 'CClientScript',
      'scriptMap' => array(
      'jquery.js' => true, // ปิด ตัวเก่าไป
      ), */
    /* 'packages' => array(
      'jquery' => array(
      'baseUrl' => 'js/', // path ที่เก็บ javascript
      'js' => array('jquery-1.9.1.js') // file javascript ที่ต้องการ
      ),
      )
      ), */
    'modules' => array(
        // uncomment the following to enable the Gii tool
        /*
          'gii'=>array(
          'class'=>'system.gii.GiiModule',
          'password'=>'Enter Your Password Here',
          // If removed, Gii defaults to localhost only. Edit carefully to taste.
          'ipFilters'=>array('127.0.0.1','::1'),
          ),
         */
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        /* 'user' => array(
          'tableUsers' => 'user',
          ), */
        'rights' => array(//add this
            'superuserName' => 'admin',
            'authenticatedName' => 'Authenticated',
            'layout' => 'rights.views.layouts.main',
            'appLayout' => 'webroot.themes.admin.views.layouts.main',
        // 'install' => true, 
        )
    ),
    // application components
    'components' => array(
        'session' => array(

                        'autoStart'=> true

                )
,  'lnwupload'=>array(
            'class'=>'LnwUpload'
        ),
        'counter' => array(
            'class' => 'UserCounter',
        ),
        'user' => array(
            'class' => 'RWebUser',
            'allowAutoLogin' => true,
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'defaultRoles' => array('Guest')
        ),
        'shoppingCart' =>
        array(
            'class' => 'application.components.shoppingCart.EShoppingCart',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=panyasys_yii', //override my_database for you actual db
            'username' => 'panyasys_yii',
            'password' => 'admin12345',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    /*      'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
      array(
      'class' => 'CFileLogRoute',
      'levels' => 'error, warning',
      ),
      array(
      'class' => 'CProfileLogRoute',
      'levels' => 'profile',
      'enabled' => true,
      )
      // uncomment the following to show log messages on web pages
      /*
      array(
      'class'=>'CWebLogRoute',
      ),

      ),
      ), */
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'tony_panya@hotmail.com',
    )
);
?>