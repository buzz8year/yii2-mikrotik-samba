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

    public function getDayRate(int $days = 1)
    {
        $data = [];

        foreach ($this->journalRigs as $key => $journal) {
            // if ($key == 0 || $key  144) {
            //     $data['time'][] = date("Y-m-d H:i:s", substr($journal->dtime, 0, 10));
            // }
            // else {
                $data['time'][] = date("H:i", substr($journal->dtime, 0, 10));
            // }

            foreach ( ($gpus = explode(";", $journal->rate_details)) as $key => $rate) {
                $data['rate' . $key][] = $gpus[$key] / 1000;
            }
            if ($key == (144 * $days)) break; // Getting all records within a day (1 record every 10 min) 
        }

        return json_encode($data);
    }
}
