<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;

/**
 * ItemSearch represents the model behind the search form of `app\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'value', 'receiver_id', 'manifest_id'], 'integer'],
            [['item_name', 'sender_name', 'sender_phone', 'sender_subscription', 'receiver_name', 'receiver_phone', 'departure', 'depature_date', 'departure_time', 'destination', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Item::find();

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
            'item_id' => $this->item_id,
            'value' => $this->value,
            'receiver_id' => $this->receiver_id,
            'depature_date' => $this->depature_date,
            'departure_time' => $this->departure_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'manifest_id' => $this->manifest_id,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'sender_subscription', $this->sender_subscription])
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'receiver_phone', $this->receiver_phone])
            ->andFilterWhere(['like', 'departure', $this->departure])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
