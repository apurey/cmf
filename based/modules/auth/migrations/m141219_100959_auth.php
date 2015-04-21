<?php

use yii\db\Schema;
use yii\db\Migration;

class m141219_100959_auth extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8' : null;
        $this->createTable(
            '{{%auth}}',
            [
                'id' => Schema::TYPE_PK,
                'login' => Schema::TYPE_STRING . '(32) NOT NULL DEFAULT \'\'',
                'password' => Schema::TYPE_STRING . '(512) NOT NULL DEFAULT \'\'',
                'auth_key' => Schema::TYPE_STRING . '(64) NOT NULL DEFAULT \'\'',
                'access_token' => Schema::TYPE_STRING . '(128) NOT NULL DEFAULT \'\'',
                'email' => Schema::TYPE_STRING . '(64) NOT NULL DEFAULT \'\'',
                'blocked' => Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT \'1\'',
            ],
            $options
        );
        $this->createIndex('auth_member', '{{%auth}}', ['login'], true);
        $this->createIndex('auth_blocked', '{{%auth}}', ['blocked']);

        $this->insert(
            '{{%auth}}',
            [
                'login' => 'webmaster',
                'password' => Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
                'auth_key' => Yii::$app->getSecurity()->generateRandomString(64),
                'access_token' => Yii::$app->getSecurity()->generateRandomString(128),
                'email' => 'webmaster@dev-vps.ru',
                'blocked' => 0,
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth}}');
    }
}
