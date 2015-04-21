<?php

use yii\db\Schema;
use yii\db\Migration;

class m150307_123253_magic extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%magic}}', 'position', Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\' AFTER mime');
        $this->createIndex('magic_position', '{{%magic}}', ['position']);
    }

    public function safeDown()
    {
        $this->dropColumn('{{%magic}}', 'position');
    }
}
