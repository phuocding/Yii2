<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m180531_092122_extend_status_table_for_create_by
 */
class m180531_092122_extend_status_table_for_create_by extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            # code...
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->addColumn('{{%status}}','created_by',Schema::TYPE_INTEGER.' NOT NULL');
        $this->addForeignKey('fk_status_created_by', '{{%status}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_status_created_by','{{%status}}');
        $this->dropColumn('{{%status}}','created_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180531_092122_extend_status_table_for_create_by cannot be reverted.\n";

        return false;
    }
    */
}
