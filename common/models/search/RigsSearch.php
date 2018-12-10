<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Rigs;

/**
 * RigsSearch represents the model behind the search form of `common\models\Rigs`.
 */
class RigsSearch extends Rigs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'port', 'allocation_id', 'model_id', 'dtime'], 'integer'],
            [['ip', 'mac', 'status', 'hostname', 'description', 'data'], 'safe'],
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
        $query = Rigs::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'shelf' => SORT_ASC
                ]
            ]
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
            'port' => $this->port,
            'status' => $this->status == '' ? 1 : $this->status,
            'allocation_id' => $this->allocation_id,
            'model_id' => $this->model_id,
            'dtime' => $this->dtime,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'mac', $this->mac])
            ->andFilterWhere(['like', 'hostname', $this->hostname])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
