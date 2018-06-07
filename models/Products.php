<?php

namespace app\models;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
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
            'name' => 'Product Name',
        	'category_id' => 'Category',
        	'color' => 'Color',
        	'weight' => 'Weight',
        ];
    }
    
    // one-to-one
    public function getCategory() {
    	return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
    
    // one-to-many
    public function getJunction() {
    	return $this->hasMany(Junction::className(), ['product_id' => 'id']);
    }
    
    // many-to-many: uses junction relation above which uses an ActiveRecord class
    public function getProperties() {
    	return $this->hasMany(Properties::className(), ['id' => 'prop_id'])
    	->viaTable('junction', 	['product_id' => 'id']);
    }
    
    // get color value data in junction table
    public function getColor() {
    	$color = Junction::find()->where(['product_id' => $this->id, 'prop_id' => 1])->one();
    	
//     	if (count($color) === " ") {
//     		return 'Unkown color';
//     	}
//     	echo '<pre>';
//     	print_r($color->value);
//     	echo '</pre>';

    	return $color->value;
    }
    
    // get weight value data in junction table
    public function getWeight() {
    	$weight = Junction::find()->where(['product_id' => $this->id, 'prop_id' => 2])->one();
    	
    	return $weight->value;
    	   	
    }
}
