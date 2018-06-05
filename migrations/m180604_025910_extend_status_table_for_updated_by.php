<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m180604_025910_extend_status_table_for_updated_by
 */
class m180604_025910_extend_status_table_for_updated_by extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180604_025910_extend_status_table_for_updated_by cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->addColumn('{{%status}}','updated_by',Schema::TYPE_VARCHAR.' NOT NULL');
      $this->addForeignKey('fk_status_updated_by', '{{%status}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_status_updated_by','{{%status}}');
        $this->dropColumn('{{%status}}','updated_by');
    }
    
}
