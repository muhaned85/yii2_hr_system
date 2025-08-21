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
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PROCESSED => 'Processed',
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

    /**
     * Get relation with employee
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(\app\modules\employee\models\Employee::class, ['id' => 'employee_id']);
    }

    /**
     * Get month name
     * @return string
     */
    public function getMonthName()
    {
        $months = [
            1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
            5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
            9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر'
        ];
        return $months[$this->period_month] ?? $this->period_month;
    }

    /**
     * Get period display
     * @return string
     */
    public function getPeriodDisplay()
    {
        return $this->getMonthName() . ' ' . $this->period_year;
    }

    /**
     * Calculate gross salary before save
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Calculate overtime amount
            $overtimeAmount = $this->overtime_hours * $this->overtime_rate;
            
            // Calculate gross salary
            $this->gross_salary = $this->basic_salary + $this->allowances + $overtimeAmount;
            
            // Calculate net salary
            $this->net_salary = $this->gross_salary - $this->deductions;
            
            return true;
        }
        return false;
    }
}