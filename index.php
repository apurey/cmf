<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev'); // prod | dev | test

require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php');

$config = require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'web.php');

(new yii\web\Application($config))->run();
