<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partners}}`.
 */
class m000000_000002_create_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partners}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_ar' => $this->string(),
            'code' => $this->string(50)->notNull()->unique(),
            'type' => $this->string(50)->notNull(),
            'contact_person' => $this->string(),
            'phone' => $this->string(50),
            'email' => $this->string(),
            'address' => $this->text(),
            'address_ar' => $this->text(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add indexes
        $this->createIndex('idx-partners-status', '{{%partners}}', 'status');
        $this->createIndex('idx-partners-code', '{{%partners}}', 'code');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partners}}');
    }
}