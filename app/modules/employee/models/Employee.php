<?php

namespace app\modules\employee\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employees".
 */
class Employee extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {\@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
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
            [['employee_id', 'first_name', 'last_name', 'hire_date'], 'required'],
            [['bank_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['salary'], 'number'],
            [['hire_date'], 'date', 'format' => 'php:Y-m-d'],
            [['employee_id'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'first_name_ar', 'last_name_ar', 'email', 'department', 'position', 'bank_account'], 'string', 'max' => 255],
            [['phone', 'national_id'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['employee_id', 'email', 'national_id'], 'unique'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * {\@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'first_name_ar' => 'الاسم الأول',
            'last_name_ar' => 'اسم العائلة',
            'email' => 'Email',
            'phone' => 'Phone',
            'national_id' => 'National ID',
            'department' => 'Department',
            'position' => 'Position',
            'hire_date' => 'Hire Date',
            'salary' => 'Salary',
            'bank_id' => 'Bank',
            'bank_account' => 'Bank Account',
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

    /**
     * Get relation with bank
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(\app\modules\bank\models\Bank::class, ['id' => 'bank_id']);
    }

    /**
     * Get relation with payrolls
     * @return \yii\db\ActiveQuery
     */
    public function getPayrolls()
    {
        return $this->hasMany(\app\modules\payroll\models\Payroll::class, ['employee_id' => 'id']);
    }

    /**
     * Get full name
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get full Arabic name
     * @return string
     */
    public function getFullNameAr()
    {
        if ($this->first_name_ar && $this->last_name_ar) {
            return $this->first_name_ar . ' ' . $this->last_name_ar;
        }
        return $this->getFullName();
    }
}