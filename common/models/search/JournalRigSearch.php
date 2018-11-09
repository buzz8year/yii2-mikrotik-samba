<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\JournalRig;

/**
 * JournalRigSearch represents the model behind the search form of `common\models\JournalRig`.
 */
class JournalRigSearch extends JournalRig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rig_id', 'dtime', 'up', 'runtime'], 'integer'],
            [['request_ip', 'request', 'response', 'response_html', 'miner_version', 'rate_shares', 'rate_details', 'temp_speed', 'pools', 'invalid_switches', 'shares_accepted', 'shares_rejected', 'shares_invalid', 'pci_bus'], 'safe'],
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
        $query = JournalRig::find();

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
            'rig_id' => $this->rig_id,
            'dtime' => $this->dtime,
            'up' => $this->up,
            'runtime' => $this->runtime,
        ]);

        $query->andFilterWhere(['like', 'request_ip', $this->request_ip])
            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'response', $this->response])
            ->andFilterWhere(['like', 'response_html', $this->response_html])
            ->andFilterWhere(['like', 'miner_version', $this->miner_version])
            ->andFilterWhere(['like', 'rate_shares', $this->rate_shares])
            ->andFilterWhere(['like', 'rate_details', $this->rate_details])
            ->andFilterWhere(['like', 'temp_speed', $this->temp_speed])
            ->andFilterWhere(['like', 'pools', $this->pools])
            ->andFilterWhere(['like', 'invalid_switches', $this->invalid_switches])
            ->andFilterWhere(['like', 'shares_accepted', $this->shares_accepted])
            ->andFilterWhere(['like', 'shares_rejected', $this->shares_rejected])
            ->andFilterWhere(['like', 'shares_invalid', $this->shares_invalid])
            ->andFilterWhere(['like', 'pci_bus', $this->pci_bus]);

        return $dataProvider;
    }
}
