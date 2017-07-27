<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0rWCHSrKQxNZ-_WH85LsY51_2_WgKs4t',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
//            'class' => 'app\components\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        //.......mary add these................
        'urlManager' => [
             'enablePrettyUrl' => true,
             'enableStrictParsing' => true,
             'showScriptName' => false,
             'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                 'post' => 'post/index',
                 'post/<id:\d+>' => 'post/view',
                 'dashboard' => 'dashboard/index',
                 '/' => 'site/index',
                 'site' => 'site/index',
                 'site/login' => 'site/login',
                 'site/contact' => 'site/contact',
             ],
         ],
          'request' => [
             'parsers' => [
                'application/json' => 'yii\web\JsonParser',
             ]
          ],
         //............................
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
