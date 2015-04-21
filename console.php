#!/usr/bin/env php
<?php
/**
 * Yii2 console bootstrap file.
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php');

$config = require(__DIR__ . DIRECTORY_SEPARATOR . 'based' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'console.php');

die((new yii\console\Application($config))->run());
