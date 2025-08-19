<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payrolls}}`.
 */
class m000000_000005_create_payrolls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payrolls}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'period_month' => $this->integer()->notNull(),
            'period_year' => $this->integer()->notNull(),
            'basic_salary' => $this->decimal(10,2)->notNull(),
            'allowances' => $this->decimal(10,2)->defaultValue(0),
            'deductions' => $this->decimal(10,2)->defaultValue(0),
            'overtime_hours' => $this->decimal(5,2)->defaultValue(0),
            'overtime_rate' => $this->decimal(8,2)->defaultValue(0),
            'gross_salary' => $this->decimal(10,2)->notNull(),
            'net_salary' => $this->decimal(10,2)->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add indexes
        $this->createIndex('idx-payrolls-status', '{{%payrolls}}', 'status');
        $this->createIndex('idx-payrolls-employee_id', '{{%payrolls}}', 'employee_id');
        $this->createIndex('idx-payrolls-period', '{{%payrolls}}', ['period_year', 'period_month']);
        $this->createIndex('idx-payrolls-unique-period', '{{%payrolls}}', ['employee_id', 'period_year', 'period_month'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payrolls}}');
    }
}