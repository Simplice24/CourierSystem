<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subscription;

/**
 * SubscriptionSearch represents the model behind the search form of `app\models\Subscription`.
 */
class SubscriptionSearch extends Subscription
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscription_id', 'amount', 'created_at', 'updated_at', 'customer_id'], 'integer'],
            [['customer', 'subscription_type', 'created_by', 'updated_by'], 'safe'],
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
        $query = Subscription::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'subscription_id' => $this->subscription_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'subscription_type', $this->subscription_type])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
