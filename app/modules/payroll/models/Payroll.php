<?php

namespace app\modules\payroll\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payrolls".
 */
class Payroll extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_DRAFT = 0;
    const STATUS_PROCESSED = 1;

    /**
     * {\@inheritdoc}
     */
    public static function tableName()
    {
        return 'payrolls';
    }

    /**
     * {\@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {\@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'period_month', 'period_year', 'basic_salary', 'gross_salary', 'net_salary'], 'required'],
            [['employee_id', 'period_month', 'period_year', 'status', 'created_at', 'updated_at'], 'integer'],
            [['basic_salary', 'allowances', 'deductions', 'overtime_hours', 'overtime_rate', 'gross_salary', 'net_salary'], 'number'],
            [['period_month'], 'integer', 'min' => 1, 'max' => 12],
            [['period_year'], 'integer', 'min' => 1900],
            [['allowances', 'deductions', 'overtime_hours', 'overtime_rate'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => self::STATUS_DRAFT],
            [['status'], 'in', 'range' => [self::STATUS_DRAFT, self::STATUS_PROCESSED]],
        ];
    }

    /**
     * {\@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee',
            'period_month' => 'Month',
            'period_year' => 'Year',
            'basic_salary' => 'Basic Salary',
            'allowances' => 'Allowances',
            'deductions' => 'Deductions',
            'overtime_hours' => 'Overtime Hours',
            'overtime_rate' => 'Overtime Rate',
            'gross_salary' => 'Gross Salary',
            'net_salary' => 'Net Salary',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        $statusList = self::getStatusList();
        return $statusList[$this->status] ?? 'Unknown';
    }
}