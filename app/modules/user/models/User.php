<?php

namespace app\modules\user\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "hr_users".
 */
class User extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {\@inheritdoc}
     */
    public static function tableName()
    {
        return 'hr_users';
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
            [['username', 'email', 'password_hash', 'first_name', 'last_name', 'role'], 'required'],
            [['status', 'created_at', 'updated_at', 'last_login_at'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['email', 'password_hash', 'first_name', 'last_name', 'first_name_ar', 'last_name_ar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['username', 'email'], 'unique'],
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
            'username' => 'Username',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'first_name_ar' => 'الاسم الأول',
            'last_name_ar' => 'اسم العائلة',
            'phone' => 'Phone',
            'role' => 'Role',
            'status' => 'Status',
            'last_login_at' => 'Last Login',
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