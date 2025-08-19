<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m000000_000004_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->string(50)->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'first_name_ar' => $this->string(),
            'last_name_ar' => $this->string(),
            'email' => $this->string()->unique(),
            'phone' => $this->string(50),
            'national_id' => $this->string(50)->unique(),
            'department' => $this->string(),
            'position' => $this->string(),
            'hire_date' => $this->date()->notNull(),
            'salary' => $this->decimal(10,2),
            'bank_id' => $this->integer(),
            'bank_account' => $this->string(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add indexes
        $this->createIndex('idx-employees-status', '{{%employees}}', 'status');
        $this->createIndex('idx-employees-employee_id', '{{%employees}}', 'employee_id');
        $this->createIndex('idx-employees-bank_id', '{{%employees}}', 'bank_id');
        $this->createIndex('idx-employees-department', '{{%employees}}', 'department');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}