<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banks}}`.
 */
class m000000_000001_create_banks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banks}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_ar' => $this->string()->notNull(),
            'code' => $this->string(20)->notNull()->unique(),
            'swift_code' => $this->string(20)->null(),
            'address' => $this->text()->null(),
            'address_ar' => $this->text()->null(),
            'phone' => $this->string(20)->null(),
            'email' => $this->string()->null(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add indexes
        $this->createIndex('idx-banks-status', '{{%banks}}', 'status');
        $this->createIndex('idx-banks-code', '{{%banks}}', 'code');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banks}}');
    }
}