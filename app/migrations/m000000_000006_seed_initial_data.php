<?php

use yii\db\Migration;

/**
 * Class m000000_000006_seed_initial_data
 */
class m000000_000006_seed_initial_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Insert sample banks
        $this->batchInsert('{{%banks}}', [
            'name', 'name_ar', 'code', 'swift_code', 'address', 'address_ar', 'phone', 'email', 'status', 'created_at', 'updated_at'
        ], [
            ['National Bank of Egypt', 'البنك الأهلي المصري', 'NBE', 'NBEGEGCX', 'Kasr El Nil Branch, Cairo', 'فرع قصر النيل، القاهرة', '+20227702222', 'info@nbe.com.eg', 1, time(), time()],
            ['Banque Misr', 'بنك مصر', 'BM', 'BMISEGCX', 'Mohamed Farid St, Cairo', 'شارع محمد فريد، القاهرة', '+20225911000', 'info@banquemisr.com', 1, time(), time()],
            ['Commercial International Bank', 'البنك التجاري الدولي', 'CIB', 'CIBEEGCX', 'Corniche El Nil, Cairo', 'كورنيش النيل، القاهرة', '+20227281111', 'info@cibeg.com', 1, time(), time()],
        ]);

        // Insert sample partners
        $this->batchInsert('{{%partners}}', [
            'name', 'name_ar', 'code', 'type', 'contact_person', 'phone', 'email', 'address', 'address_ar', 'status', 'created_at', 'updated_at'
        ], [
            ['ABC Technology Solutions', 'ايه بي سي للحلول التقنية', 'ABC-TECH', 'Technology Provider', 'John Smith', '+20101234567', 'john@abc-tech.com', '123 Tech Street, New Cairo', '123 شارع التكنولوجيا، القاهرة الجديدة', 1, time(), time()],
            ['Elite Training Center', 'مركز النخبة للتدريب', 'ETC', 'Training Provider', 'Ahmed Hassan', '+20121234567', 'ahmed@elite-training.com', '456 Training Ave, Maadi', '456 شارع التدريب، المعادي', 1, time(), time()],
            ['Premium Office Supplies', 'اللوازم المكتبية المميزة', 'POS', 'Office Supplier', 'Sara Mohamed', '+20131234567', 'sara@premium-office.com', '789 Office St, Heliopolis', '789 شارع المكاتب، مصر الجديدة', 1, time(), time()],
        ]);

        // Insert sample HR users with proper password hashes
        $this->batchInsert('{{%hr_users}}', [
            'username', 'email', 'password_hash', 'auth_key', 'first_name', 'last_name', 'first_name_ar', 'last_name_ar', 'phone', 'role', 'status', 'created_at', 'updated_at'
        ], [
            ['admin', 'admin@company.com', '$2y$10$C03wwWbea.crKPCz4eiLt.aTytiTCUtpCHWT9d9o.klD11XLpFq0a', 'auth-key-admin', 'Admin', 'User', 'مدير', 'النظام', '+20101111111', 'admin', 1, time(), time()], // password: admin123
            ['hr_manager', 'hr@company.com', '$2y$10$C03wwWbea.crKPCz4eiLt.aTytiTCUtpCHWT9d9o.klD11XLpFq0a', 'auth-key-hr', 'HR', 'Manager', 'مدير', 'الموارد البشرية', '+20101111112', 'hr', 1, time(), time()], // password: admin123
            ['finance_manager', 'finance@company.com', '$2y$10$C03wwWbea.crKPCz4eiLt.aTytiTCUtpCHWT9d9o.klD11XLpFq0a', 'auth-key-finance', 'Finance', 'Manager', 'مدير', 'المالية', '+20101111113', 'finance', 1, time(), time()], // password: admin123
        ]);

        // Insert sample employees
        $this->batchInsert('{{%employees}}', [
            'employee_id', 'first_name', 'last_name', 'first_name_ar', 'last_name_ar', 'email', 'phone', 'national_id', 'department', 'position', 'hire_date', 'salary', 'bank_id', 'bank_account', 'status', 'created_at', 'updated_at'
        ], [
            ['EMP001', 'Mohamed', 'Ali', 'محمد', 'علي', 'mohamed.ali@company.com', '+20101234560', '12345678901234', 'IT', 'Software Developer', '2024-01-15', 15000.00, 1, '1234567890123456', 1, time(), time()],
            ['EMP002', 'Fatma', 'Ahmed', 'فاطمة', 'أحمد', 'fatma.ahmed@company.com', '+20101234561', '12345678901235', 'HR', 'HR Specialist', '2024-02-01', 12000.00, 2, '1234567890123457', 1, time(), time()],
            ['EMP003', 'Omar', 'Hassan', 'عمر', 'حسن', 'omar.hassan@company.com', '+20101234562', '12345678901236', 'Finance', 'Accountant', '2024-03-01', 13000.00, 3, '1234567890123458', 1, time(), time()],
            ['EMP004', 'Aisha', 'Mahmoud', 'عائشة', 'محمود', 'aisha.mahmoud@company.com', '+20101234563', '12345678901237', 'Marketing', 'Marketing Specialist', '2024-04-01', 11000.00, 1, '1234567890123459', 1, time(), time()],
        ]);

        echo "Initial data seeded successfully.\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%employees}}');
        $this->delete('{{%hr_users}}');
        $this->delete('{{%partners}}');
        $this->delete('{{%banks}}');
        
        echo "Initial data removed.\n";
    }
}