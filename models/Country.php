<?php

namespace app\models;

// use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 52],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Serial',
            'code' => 'Code',
            'name' => 'Name',
            'population' => 'Population',
            // 'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode() {
        return $this->code;
    }

    // public function getStatuses() {
    //     return $this->hasMany(Status::className(), ['id' => 'status']);
    // }

    // public function getMessageList() {
    //     $arrMessages = [];
    //     $statusMessage = $this->statuses;

    //     foreach ($statusMessage as $messageValue) {
    //         $arrMessages = $messageValue->status;
    //     }

    //     return $arrMessages;
    // }
}
