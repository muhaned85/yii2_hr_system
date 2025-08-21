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
            'name_ar' => $this->string(),
            'code' => $this->string(20)->notNull()->unique(),
            'swift_code' => $this->string(50),
            'address' => $this->text(),
            'address_ar' => $this->text(),
            'phone' => $this->string(50),
            'email' => $this->string(),
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