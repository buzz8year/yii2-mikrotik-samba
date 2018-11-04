<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Miners;

/**
 * MinersSearch represents the model behind the search form of `common\models\Miners`.
 */
class MinersSearch extends Miners
{
    public $stratum;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'port', 'model_id', 'allocation_id', 'dtime', 'status'], 'integer'],
            [['ip', 'mac', 'name', 'description', 'stratum'], 'safe'],
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
        $query = Miners::find()
            ->join('left join', 'pools p', 'p.miner_id = miners.id')
            ->groupBy(['miners.id']);

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
            'id' => $this->id,
            'port' => $this->port,
            'model_id' => $this->model_id,
            'allocation_id' => $this->allocation_id,
            'dtime' => $this->dtime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'mac', $this->mac])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        $query->andFilterWhere(['like', 'url', $this->stratum]);

        return $dataProvider;
    }
}
