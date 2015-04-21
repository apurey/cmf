<?php

use yii\db\Schema;
use yii\db\Migration;

class m141226_161842_page extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%page}}', 'layout', Schema::TYPE_STRING . '(32) NOT NULL DEFAULT \'\' AFTER text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%page}}', 'layout');
    }
}
