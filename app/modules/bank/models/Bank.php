<?php

namespace app\modules\bank\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $name_ar Arabic name
 * @property string $code Bank code
 * @property string|null $swift_code
 * @property string|null $address
 * @property string|null $address_ar Arabic address
 * @property string|null $phone
 * @property string|null $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Bank extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banks';
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
            [['name', 'code'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['address', 'address_ar'], 'string'],
            [['name', 'name_ar'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['swift_code'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Bank Name',
            'name_ar' => 'اسم البنك',
            'code' => 'Bank Code',
            'swift_code' => 'SWIFT Code',
            'address' => 'Address',
            'address_ar' => 'العنوان',
            'phone' => 'Phone',
            'email' => 'Email',
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