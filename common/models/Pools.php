<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pools".
 *
 * @property int $id Идентификатор записи
 * @property int $miner_id
 * @property int $dtime Метка времени
 * @property int $accepted Количество подтверждений
 * @property double $best_share Кол-во шар
 * @property string $diff Текущая сложность шары
 * @property int $diff_shares
 * @property double $difficulty_accepted
 * @property double $difficulty_rejected
 * @property double $difficulty_stale
 * @property double $discarded
 * @property int $get_failures
 * @property int $getworks
 * @property int $has_gbt
 * @property int $has_stratum
 * @property double $last_share_difficulty
 * @property string $last_share_time
 * @property string $long_poll
 * @property int $pool Идентификатор пула
 * @property double $pool_rejected_rate
 * @property double $pool_stale_rate
 * @property int $priority Приоритет
 * @property string $proxy Прокси
 * @property string $proxy_type Тип прокси
 * @property int $quota
 * @property int $rejected Кол-во реджектов
 * @property int $remote_failures
 * @property string $status Статус
 * @property int $stale
 * @property int $stratum_active Активность стратума
 * @property string $stratum_url Хост стратума
 * @property string $url URL стратума
 * @property string $worker Название воркера
 *
 * @property Miners $miner
 */
class Pools extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pools';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['miner_id', 'dtime', 'accepted', 'diff_shares', 'get_failures', 'getworks', 'has_gbt', 'has_stratum', 'pool', 'priority', 'quota', 'rejected', 'remote_failures', 'stale', 'stratum_active'], 'integer'],
            [['dtime', 'diff', 'pool', 'stratum_url', 'url', 'worker'], 'required'],
            [['best_share', 'difficulty_accepted', 'difficulty_rejected', 'difficulty_stale', 'discarded', 'last_share_difficulty', 'pool_rejected_rate', 'pool_stale_rate'], 'number'],
            [['diff', 'last_share_time', 'long_poll', 'proxy', 'proxy_type', 'status'], 'string', 'max' => 16],
            [['stratum_url', 'url', 'worker'], 'string', 'max' => 64],
            [['miner_id'], 'unique'],
            [['miner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Miners::className(), 'targetAttribute' => ['miner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'miner_id' => 'Miner ID',
            'dtime' => 'Dtime',
            'accepted' => 'Accepted',
            'best_share' => 'Best Share',
            'diff' => 'Diff',
            'diff_shares' => 'Diff Shares',
            'difficulty_accepted' => 'Difficulty Accepted',
            'difficulty_rejected' => 'Difficulty Rejected',
            'difficulty_stale' => 'Difficulty Stale',
            'discarded' => 'Discarded',
            'get_failures' => 'Get Failures',
            'getworks' => 'Getworks',
            'has_gbt' => 'Has Gbt',
            'has_stratum' => 'Has Stratum',
            'last_share_difficulty' => 'Last Share Difficulty',
            'last_share_time' => 'Last Share Time',
            'long_poll' => 'Long Poll',
            'pool' => 'Pool',
            'pool_rejected_rate' => 'Pool Rejected Rate',
            'pool_stale_rate' => 'Pool Stale Rate',
            'priority' => 'Priority',
            'proxy' => 'Proxy',
            'proxy_type' => 'Proxy Type',
            'quota' => 'Quota',
            'rejected' => 'Rejected',
            'remote_failures' => 'Remote Failures',
            'status' => 'Status',
            'stale' => 'Stale',
            'stratum_active' => 'Stratum Active',
            'stratum_url' => 'Stratum Url',
            'url' => 'Url',
            'worker' => 'Worker',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMiner()
    {
        return $this->hasOne(Miners::className(), ['id' => 'miner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    static function getUniques()
    {
        if ($all = self::find()->select('url')->all()) {
            # code...
            $data = [];
            foreach ($all as $url) {
                if (!$data || !isset($data[$url->url])) {
                    $data[$url->url] = $url->url;
                }
            }
            return $data;

        } else {
            return [];
        }
    }
}
