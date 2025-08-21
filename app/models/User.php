<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * User model for hr_users table
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $first_name_ar
 * @property string $last_name_ar
 * @property string $phone
 * @property string $role
 * @property int $status
 * @property int $last_login_at
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    const ROLE_ADMIN = 'admin';
    const ROLE_HR = 'hr';
    const ROLE_FINANCE = 'finance';
    const ROLE_EMPLOYEE = 'employee';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hr_users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'last_name', 'role'], 'required'],
            [['status', 'last_login_at', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['email', 'password_hash', 'first_name', 'last_name', 'first_name_ar', 'last_name_ar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['role'], 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_HR, self::ROLE_FINANCE, self::ROLE_EMPLOYEE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'اسم المستخدم',
            'email' => 'البريد الإلكتروني',
            'password_hash' => 'كلمة المرور',
            'auth_key' => 'مفتاح المصادقة',
            'first_name' => 'الاسم الأول',
            'last_name' => 'اسم العائلة',
            'first_name_ar' => 'الاسم الأول (عربي)',
            'last_name_ar' => 'اسم العائلة (عربي)',
            'phone' => 'رقم الهاتف',
            'role' => 'الدور',
            'status' => 'الحالة',
            'last_login_at' => 'آخر تسجيل دخول',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Not implemented for this example
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Updates last login timestamp
     */
    public function updateLastLogin()
    {
        $this->last_login_at = time();
        $this->save(false, ['last_login_at']);
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

    /**
     * Get role label
     * @return string
     */
    public function getRoleLabel()
    {
        $roles = [
            self::ROLE_ADMIN => 'مدير النظام',
            self::ROLE_HR => 'موارد بشرية',
            self::ROLE_FINANCE => 'مالية',
            self::ROLE_EMPLOYEE => 'موظف',
        ];
        return $roles[$this->role] ?? $this->role;
    }

    /**
     * Get status label
     * @return string
     */
    public function getStatusLabel()
    {
        return $this->status == self::STATUS_ACTIVE ? 'نشط' : 'غير نشط';
    }

    /**
     * Check if user has a specific role
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert && !$this->auth_key) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }
}
