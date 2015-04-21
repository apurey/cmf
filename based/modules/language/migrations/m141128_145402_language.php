<?php

use yii\db\Schema;
use yii\db\Migration;

class m141128_145402_language extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8' : null;
        $this->createTable(
            '{{%language}}',
            [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING . '(16) NOT NULL DEFAULT \'\'',
                'iso' => Schema::TYPE_STRING . '(8) NOT NULL DEFAULT \'\'',
            ],
            $options
        );
        $this->createIndex('iso', '{{%language}}', ['iso'], true);

        $this->insert('{{%language}}', ['title' => 'Русский', 'iso' => 'ru-RU']);
        $this->insert('{{%language}}', ['title' => 'English', 'iso' => 'en-US']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
