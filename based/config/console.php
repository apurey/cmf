<?php

return [
    'id' => 'Console',
    'name' => 'Console',
    'charset' => 'UTF-8',
    'timeZone' => 'Europe/Moscow',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'bootstrap' => ['log', 'gii', 'auth'],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => '{{%migrate}}',
        ],
        'auth' => [
            'class' => 'app\modules\auth\console\AuthController',
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'auth' => 'app\modules\auth\Auth',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'db' => [
                    'sourceLanguage' => 'ru-RU',
                    'class' => 'yii\i18n\DbMessageSource',
                    'messageTable' => '{{%i18n_message}}',
                    'sourceMessageTable' => '{{%i18n_source}}',
                    'enableCaching' => YII_DEBUG ? false : true,
                    'on missingTranslation' => [
                        'app\modules\translation\components\TranslationEventHandler',
                        'handleMissingTranslation'
                    ],
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app' . DIRECTORY_SEPARATOR . 'messages',
                ],
                'project' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app' . DIRECTORY_SEPARATOR . 'messages',
                ],
            ],
        ],
        /*
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        */
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'keyPrefix' => hash('crc32', __FILE__),
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 1,
                    'persistent' => true,
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false, // @runtime/mail/
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error', 'warning'],
                    'message' => [
                        'to' => [
                            'webmaster@dev-vps.ru',
                        ],
                        'from' => [
                            'logging@dev-vps.ru',
                        ],
                        'subject' => 'Logging',
                    ],
                ],
            ],
        ],
        'db' => require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    ],
    'params' => require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
];
