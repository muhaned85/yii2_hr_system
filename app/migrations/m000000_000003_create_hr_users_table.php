<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hr_users}}`.
 */
class m000000_000003_create_hr_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hr_users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'first_name_ar' => $this->string(),
            'last_name_ar' => $this->string(),
            'phone' => $this->string(50),
            'role' => $this->string(50)->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'last_login_at' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add indexes
        $this->createIndex('idx-hr_users-status', '{{%hr_users}}', 'status');
        $this->createIndex('idx-hr_users-username', '{{%hr_users}}', 'username');
        $this->createIndex('idx-hr_users-email', '{{%hr_users}}', 'email');
        $this->createIndex('idx-hr_users-role', '{{%hr_users}}', 'role');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hr_users}}');
    }
}