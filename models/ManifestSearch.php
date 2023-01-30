<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manifest;

/**
 * ManifestSearch represents the model behind the search form of `app\models\Manifest`.
 */
class ManifestSearch extends Manifest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manifest_id'], 'integer'],
            [['departure_date', 'departure_time', 'plate_number', 'driver', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Manifest::find();

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
            'manifest_id' => $this->manifest_id,
            'departure_date' => $this->departure_date,
            'departure_time' => $this->departure_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'plate_number', $this->plate_number])
            ->andFilterWhere(['like', 'driver', $this->driver])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
