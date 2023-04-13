<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Modernism',
    'language' => 'uz',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@api' => dirname(dirname(__DIR__)) . '/v1',
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'main',
                     'extraPatterns' => [
                        'GET getobject' => 'getobject',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'architector'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'route'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'route-object'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'event'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'photo'],


                '/' => 'site',
                '/site/index' => 'site/index',
                '/site/about' => 'site/about',
                '/site/contact' => 'site/contact',
                '/site/login' => 'site/login',
                '/site/logout' => 'site/logout',
                '/admin/main/<action:index|update|view|create|delete>' => 'admin/main/<action>',
                '/admin/main' => 'admin/main/index',

                '/admin/architector/<action:index|update|view|create|delete>' => 'admin/architector/<action>',
                '/admin/architector' => 'admin/architector/index',

                '/admin/event/<action:index|update|view|create|delete>' => 'admin/event/<action>',
                '/admin/event' => 'admin/event/index',

                '/admin/photo/<action:index|update|view|create|delete>' => 'admin/photo/<action>',
                '/admin/photo' => 'admin/photo/index',

                '/admin/route/<action:index|update|view|create|delete>' => 'admin/route/<action>',
                '/admin/route' => 'admin/route/index',

                '/admin/route-object/<action:index|update|view|create|delete>' => 'admin/route-object/<action>',
                '/admin/route-object' => 'admin/route-object/index',



               
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'K8ndmlCfW6HwOj57yEzAKXe5i2vXEOPd',
        ],
        'assetManager' => [
            'bundles' => [
                'alexantr\coordinates\CoordinatesAsset' => [
                    'googleMapsApiKey' => 'UBcsRlxWxBjmZBvrW154fXJ4eJeeO4TFMp9pRLi', // <- put api key here
                    'yandexMapsLang' => 'en_US',
                    'initialCoordinates' => [41.306583, 69.275613], // [latitude, longitude]
                    'initialZoom' => 8, // Default is 10
                ],
            ],
        ],

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
