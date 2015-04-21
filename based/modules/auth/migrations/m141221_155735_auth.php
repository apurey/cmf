<?php

use yii\db\Schema;
use yii\db\Migration;

class m141221_155735_auth extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%auth_assignment}}', 'user_id', Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\'');
        $this->addForeignKey(
            'auth_assignment_ibfk_2',
            '{{%auth_assignment}}',
            'user_id',
            '{{%auth}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('auth_assignment_ibfk_2', '{{%auth_assignment}}');
        $this->alterColumn('{{%auth_assignment}}', 'user_id', Schema::TYPE_STRING . '(64) NOT NULL');
    }
}
