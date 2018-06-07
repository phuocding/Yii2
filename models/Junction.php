<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "junction".
 *
 * @property int $product_id
 * @property int $prop_id
 * @property string $value
 */
class Junction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'junction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'prop_id', 'value'], 'required'],
            [['product_id', 'prop_id'], 'integer'],
            [['value'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'prop_id' => 'Prop ID',
            'value' => 'Value',
        ];
    }
    
    public function getProperty() {
    	return $this->hasOne(Properties::className(), ['id' => 'prop_id']);
    }
    
    public function getProduct() {
    	return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
