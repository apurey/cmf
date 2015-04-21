<?php

use yii\db\Schema;
use yii\db\Migration;

class m141219_160301_session extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8' : null;
        $this->createTable(
            '{{%session}}',
            [
                'id' => Schema::TYPE_STRING . '(22) NOT NULL PRIMARY KEY',
                'expire' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\'',
                'data' => $this->hasDriver(),
            ],
            $options
        );
        $this->createIndex('session_expire', '{{%session}}', ['expire']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }

    /**
     * @return null|string
     */
    private function hasDriver()
    {
        switch ($this->db->getDriverName()) {
            case 'mysql':
                return 'LONGBLOB';
            case 'pgsql':
                return 'BYTEA';
            default :
                return null;
        }
    }
}
