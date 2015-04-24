<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=database', // PostgreSQL
    'dsn' => 'mysql:host=localhost;dbname=dbname', // MySQL, MariaDB
    'username' => 'username',
    'password' => 'password',
    'charset' => 'utf8',
    'tablePrefix' => 'cmf_',
    'enableSchemaCache' => YII_DEBUG ? false : true,
    'schemaCacheDuration' => 300, // seconds
];
