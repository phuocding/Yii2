<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $message
 * @property int $permissions
 * @property date $created_at
 * @property date $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int de_code
 * @property string de_code_name
 */
class Status extends \yii\db\ActiveRecord
{
	public $de_code_name = "";
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'created_at', 'updated_at', 'de_code'], 'required'],
            [['message'], 'string'],
            [['permissions'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'permissions' => 'Permissions',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'de_code' => 'Decode',
        ];
    }

    const PERMISSIONS_PRIVATE = 10;
    const PERMISSIONS_PUBLIC = 20;

    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function getPermissions() {
        return array (self::PERMISSIONS_PRIVATE=>'Private',self::PERMISSIONS_PUBLIC=>'Public');
    }

    public function getPermissionsLabel($permissions) {
        if ($permissions==self::PERMISSIONS_PUBLIC) {
            return 'Public';
        } else {
            return 'Private';
        }
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getPhuoc() {
        return $this->hasOne(Country::className(), ['id' => 'de_code']);
    }
    
    public function getCodeName() {
    	return $this->hasOne(Country::className(), ['code' => 'de_code_name']);
    }
}
