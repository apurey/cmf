<?php

use yii\db\Schema;
use yii\db\Migration;

class m141128_134600_page extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8' : null;
        $this->createTable(
            '{{%page}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(64) NOT NULL DEFAULT \'\'',
                'title' => Schema::TYPE_STRING . '(128) NOT NULL DEFAULT \'\'',
                'text' => Schema::TYPE_TEXT . ' NOT NULL',
                'template' => Schema::TYPE_STRING . '(32) NOT NULL DEFAULT \'\'',
                'description' => Schema::TYPE_STRING . '(256) NOT NULL DEFAULT \'\'',
                'keywords' => Schema::TYPE_STRING . '(256) NOT NULL DEFAULT \'\'',
                'active' => Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT \'0\'',
                'language' => Schema::TYPE_STRING . '(8) NOT NULL DEFAULT \'\'',
            ],
            $options
        );

        $this->createIndex('UNIQUE', '{{%page}}', ['name', 'language'], true);
        $this->createIndex('language', '{{%page}}', ['language']);
        $this->createIndex('active', '{{%page}}', ['active']);

        $this->addForeignKey('page_ibfk_1', '{{%page}}', 'language', '{{%language}}', 'iso', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_ibfk_1', '{{%page}}');
        $this->dropTable('{{%page}}');
    }
}
