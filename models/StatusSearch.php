<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Status;

/**
 * StatusSearch represents the model behind the search form of `app\models\Status`.
 */
class StatusSearch extends Status
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return [
    		[['id', 'permissions'], 'integer'],
    		[['message', 'created_at', 'updated_at', 'created_by', 'updated_by', 'de_code'], 'safe'],
    	];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
    	return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
    	$query = Status::find();

        // add conditions that should always apply here

    	$dataProvider = new ActiveDataProvider([
    		'query' => $query,
    		'pagination' => [
    			'pageSize' => 5
    		],
            'sort' => [
                'attributes' => ['id', 'message', 'permissions', 'created_at', 'updated_at', 'created_by', 'updated_by', 'de_code'],
            ],
    	]);

    	$this->load($params);

    	if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
    		return $dataProvider;
    	}

        // grid filtering conditions
    	$query->andFilterWhere([
    		'id' => $this->id,
    		'permissions' => $this->permissions,
    		// 'created_at' => $this->created_at,
    		// 'updated_at' => $this->updated_at,
            'de_code' => $this->de_code,
    	]);

    	$query->andFilterWhere(['like', 'message', $this->message]);
    	$query->andFilterWhere(['like', 'created_by', $this->created_by]);
    	$query->andFilterWhere(['like', 'updated_by', $this->updated_by]);

    	return $dataProvider;
    }
}
