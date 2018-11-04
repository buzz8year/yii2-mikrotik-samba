<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pools;

/**
 * PoolsSearch represents the model behind the search form of `common\models\Pools`.
 */
class PoolsSearch extends Pools
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'miner_id', 'dtime', 'accepted', 'diff_shares', 'get_failures', 'getworks', 'has_gbt', 'has_stratum', 'pool', 'priority', 'quota', 'rejected', 'remote_failures', 'stale', 'stratum_active'], 'integer'],
            [['best_share', 'difficulty_accepted', 'difficulty_rejected', 'difficulty_stale', 'discarded', 'last_share_difficulty', 'pool_rejected_rate', 'pool_stale_rate'], 'number'],
            [['diff', 'last_share_time', 'long_poll', 'proxy', 'proxy_type', 'status', 'stratum_url', 'url', 'worker'], 'safe'],
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
        $query = Pools::find();

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
            'miner_id' => $this->miner_id,
            'dtime' => $this->dtime,
            'accepted' => $this->accepted,
            'best_share' => $this->best_share,
            'diff_shares' => $this->diff_shares,
            'difficulty_accepted' => $this->difficulty_accepted,
            'difficulty_rejected' => $this->difficulty_rejected,
            'difficulty_stale' => $this->difficulty_stale,
            'discarded' => $this->discarded,
            'get_failures' => $this->get_failures,
            'getworks' => $this->getworks,
            'has_gbt' => $this->has_gbt,
            'has_stratum' => $this->has_stratum,
            'last_share_difficulty' => $this->last_share_difficulty,
            'pool' => $this->pool,
            'pool_rejected_rate' => $this->pool_rejected_rate,
            'pool_stale_rate' => $this->pool_stale_rate,
            'priority' => $this->priority,
            'quota' => $this->quota,
            'rejected' => $this->rejected,
            'remote_failures' => $this->remote_failures,
            'stale' => $this->stale,
            'stratum_active' => $this->stratum_active,
        ]);

        $query->andFilterWhere(['like', 'diff', $this->diff])
            ->andFilterWhere(['like', 'last_share_time', $this->last_share_time])
            ->andFilterWhere(['like', 'long_poll', $this->long_poll])
            ->andFilterWhere(['like', 'proxy', $this->proxy])
            ->andFilterWhere(['like', 'proxy_type', $this->proxy_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'stratum_url', $this->stratum_url])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'worker', $this->worker]);

        return $dataProvider;
    }
}
