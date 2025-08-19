<?php

namespace app\modules\partner\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "partners".
 */
class Partner extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {\@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
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
            [['name', 'code', 'type'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['address', 'address_ar'], 'string'],
            [['name', 'name_ar', 'contact_person'], 'string', 'max' => 255],
            [['code', 'type'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            [['code'], 'unique'],
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
            'name' => 'Partner Name',
            'name_ar' => 'اسم الشريك',
            'code' => 'Partner Code',
            'type' => 'Partner Type',
            'contact_person' => 'Contact Person',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'address_ar' => 'العنوان',
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