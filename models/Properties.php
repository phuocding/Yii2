<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "properties".
 *
 * @property int $id
 * @property string $name
 */
class Properties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    
    public function getJunction()
    {
    	return $this->hasMany(Junction::className(), ['prop_id' => 'id']);
    }
}
