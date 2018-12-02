<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rigs".
 *
 * @property int $id
 * @property string $ip
 * @property int $port
 * @property string $mac
 * @property string $hostname
 * @property string $description
 * @property int $status
 * @property int $allocation_id
 * @property int $model_id
 * @property string $data
 * @property int $dtime
 *
 * @property JournalRig[] $journalRigs
 */
class Rigs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rigs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['port', 'status', 'allocation_id', 'model_id', 'dtime'], 'integer'],
            [['description', 'data'], 'string'],
            [['ip', 'mac'], 'string', 'max' => 64],
            [['hostname'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'port' => 'Port',
            'mac' => 'Mac',
            'hostname' => 'Hostname',
            'description' => 'Description',
            'status' => 'Status',
            'allocation_id' => 'Allocation ID',
            'model_id' => 'Model ID',
            'data' => 'Data',
            'dtime' => 'Dtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalRigs()
    {
        return $this->hasMany(JournalRig::className(), ['rig_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastJournal()
    {
        return $this->hasOne(JournalRig::className(), ['rig_id' => 'id'])->where(['poll_id' => Poll::getLastId()])->orderBy(['id' => SORT_DESC]);
    }


    public function getDayRate(int $days = 1)
    {
        $data = [];

        foreach ($this->journalRigs as $key => $journal) {
            // if ($key == 0 || $key == 144) {
            //     $data['time'][] = date("Y-m-d H:i:s", substr($journal->dtime, 0, 10));
            // }
            // else {
                $data['time'][] = date("H:i", substr($journal->dtime, 0, 10));
            // }

            // $sum = 0;
            foreach ( ($gpus = explode(";", $journal->rate_details)) as $kee => $rate) {
                $data['rate' . $kee][] = $gpus[$kee] / 1000;
                // $sum = $sum + $gpus[$kee];
            }
            // $data['rate' . count($gpus)][] = $sum / 1000;
            if ($key == (144 * $days)) break; // Getting all records within a day (1 record every 10 min) 
        }

        return $data;
        // return json_encode($data);
    }


    public static function countEnabled()
    {
        return self::find()
            ->where(['status' => 1])
            ->count();
    }

    public static function countDisabled()
    {
        return self::find()
            ->where(['status' => 0])
            ->count();
    }

    public static function mutualData(int $days = 1)
    {   
        $data = [
            'time' => [],
            'rate' => [],
            'rejected' => 0,
            'shares' => 0,
            'gpus' => 0,
            'up' => 0,
        ];

        $polls = Poll::find()->orderBy(['id' => SORT_DESC])->limit(144)->all();

        foreach ($polls as $key => $poll) {

            if (($key + 1) < sizeof($polls)) { // We dont want the last poll, since it can be incomplete, making to assume that total hashrate is down

                $journals = JournalRig::find()->where(['poll_id' => $poll->id])->groupBy(['rig_id'])->distinct()->all();

                $rate = 0;

                foreach ($journals as $kee => $journal) {

                    $exp = [];
                    $exp['rate'] = explode(';', $journal->rate_shares);
                    $exp['pci'] = explode(';', $journal->pci_bus);

                    $rate += $exp['rate'][0] / 1000;

                    $data['up']++;
                    $data['gpus'] += sizeof($exp['pci']);

                    $data['shares'] += $exp['rate'][1];
                    $data['rejected'] += $exp['rate'][2];

                    unset($exp);
                }

                $data['time'][] = date("H:i", substr($poll->poll_time, 0, 10));
                $data['rate'][] = round($rate / 1000, 3);

                unset($rate);

            }

        }

        return array_reverse($data);
    }


    public static function mutualLastRate()
    {
        $data = [];

        $poll = Poll::find()->orderBy('id DESC')->limit(1)->offset(1)->one();

        $journals = JournalRig::find()->where(['poll_id' => $poll->id])->groupBy(['rig_id'])->distinct()->all();

        $rate = 0;

        foreach ($journals as $journal) {
            $exp = explode(';', $journal->rate_shares);
            $rate += $exp[0] / 1000;
        }

        $data['date'] = date("d/m/Y H:i", substr($poll->poll_time, 0, 10));
        $data['rate'] = round($rate / 1000, 3);

        return $data;
    }

}
