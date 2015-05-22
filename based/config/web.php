<?php

$config = [
    'id' => 'CMF',
    'name' => 'CMF',
    'charset' => 'UTF-8',
    'timeZone' => 'Europe/Moscow',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'bootstrap' => [
        'log',
        'app\modules\language\Bootstrap',
        'app\modules\page\Bootstrap',
        'app\modules\imperavi\Bootstrap',
        'app\modules\translation\Bootstrap',
        'app\modules\cp\Bootstrap',
        'app\modules\auth\Bootstrap',
        'app\modules\magic\Bootstrap',
    ],
    'defaultRoute' => 'page/page/route',
    'modules' => [
        'cp' => [
            'class' => 'app\modules\cp\Cp',
            'modules' => [
                'language' => [
                    'class' => 'app\modules\language\Manage',
                ],
                'imperavi' => [
                    'class' => 'app\modules\imperavi\Manage',
                ],
                'page' => [
                    'class' => 'app\modules\page\Manage',
                    'layouts' => [
                        '//index' => 'Главная',
                        '//common' => 'Типовая',
                    ],
                    'templates' => [
                        'index' => 'Главная',
                        'common' => 'Типовая',
                    ],
                ],
                'translation' => [
                    'class' => 'app\modules\translation\Manage',
                ],
                'auth' => [
                    'class' => 'app\modules\auth\Manage',
                ],
                'magic' => [
                    'class' => 'app\modules\magic\Manage',
                    'uploadDir' => 'uploads' . DIRECTORY_SEPARATOR . 'magic',
                ],
            ],
        ],
        'imperavi' => [
            'class' => 'app\modules\imperavi\Imperavi',
        ],
        'language' => [
            'class' => 'app\modules\language\Language',
        ],
        'page' => [
            'class' => 'app\modules\page\Page',
        ],
        'translation' => [
            'class' => 'app\modules\translation\Translation',
        ],
        'auth' => [
            'class' => 'app\modules\auth\Auth',
        ],
        'magic' => [
            'class' => 'app\modules\magic\Magic',
            'uploadDir' => 'uploads' . DIRECTORY_SEPARATOR . 'magic',
        ],
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => 'app\modules\auth\models\Auth',
            'loginUrl' => ['/cp/login'],
            'returnUrl' => ['/cp'],
            // Whether to enable cookie-based login: Yii::$app->user->login($this->getUser(), 24 * 60 * 60)
            'enableAutoLogin' => false,
            // http://www.yiiframework.com/doc-2.0/yii-web-user.html#$authTimeout-detail
            'authTimeout' => 1 * 60 * 60,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
        ],
        'request' => [
            'class' => 'app\modules\language\components\LangRequest',
            'cookieValidationKey' => hash('sha512', __FILE__ . ':' . hash_file('crc32', __FILE__)),
        ],
        'urlManager' => [
            'class' => 'app\modules\language\components\LangUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'enableStrictParsing' => false,
            'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'rules.php'),
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
        'cache' => [
            'class' => 'yii\redis\Cache',
            'keyPrefix' => hash('crc32', __FILE__),
            'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ],
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
        'errorHandler' => [
            'errorAction' => 'page/page/error',
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

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => [
            '*',
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => [
            '127.0.0.1',
            '::1',
            '192.168.100.1',
        ],
    ];
}

return $config;
