<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_rig".
 *
 * @property int $id
 * @property int $rig_id
 * @property int $dtime record epoch
 * @property int $up 1 - online, 0 - offline
 * @property string $request_ip rigs bunch is polled by mac - this value would help if rig accidentally changes its intranet ip address
 * @property string $request whole json request data
 * @property string $response whole json response data
 * @property string $response_html if requesting http (http respons also includes jsonrpc response for "miner_getstat2" method)
 * @property string $miner_version
 * @property int $runtime running time in minutes
 * @property string $rate_shares total ETH hashrate in MH/s, number of ETH shares, number of ETH rejected shares
 * @property string $rate_details detailed ETH hashrate for all GPUs
 * @property string $temp_speed Temperature and Fan speed(%) pairs for all GPUs
 * @property string $pools
 * @property string $invalid_switches number of ETH invalid shares, number of ETH pool switches, number of DCR invalid shares, number of DCR pool switches
 * @property string $shares_accepted for every GPU (single coin)
 * @property string $shares_rejected for every GPU (single coin)
 * @property string $shares_invalid for every GPU (single coin)
 * @property string $pci_bus PCI bus index for every GPU
 *
 * @property Rigs $rig
 */
class JournalRig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_rig';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rig_id', 'dtime', 'up', 'request', 'response', 'miner_version', 'runtime', 'rate_shares', 'rate_details', 'temp_speed', 'pools', 'invalid_switches', 'shares_accepted', 'shares_rejected', 'shares_invalid', 'pci_bus'], 'required'],
            [['rig_id', 'dtime', 'up', 'runtime'], 'integer'],
            [['request', 'response', 'response_html'], 'string'],
            [['request_ip'], 'string', 'max' => 15],
            [['miner_version'], 'string', 'max' => 6],
            [['rate_shares', 'rate_details', 'temp_speed', 'pools', 'invalid_switches', 'shares_accepted', 'shares_rejected', 'shares_invalid', 'pci_bus'], 'string', 'max' => 255],
            [['rig_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rigs::className(), 'targetAttribute' => ['rig_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rig_id' => 'Rig ID',
            'dtime' => 'Dtime',
            'up' => 'Up',
            'request_ip' => 'Request Ip',
            'request' => 'Request',
            'response' => 'Response',
            'response_html' => 'Response Html',
            'miner_version' => 'Miner Version',
            'runtime' => 'Runtime',
            'rate_shares' => 'Rate Shares',
            'rate_details' => 'Rate Details',
            'temp_speed' => 'Temp Speed',
            'pools' => 'Pools',
            'invalid_switches' => 'Invalid Switches',
            'shares_accepted' => 'Shares Accepted',
            'shares_rejected' => 'Shares Rejected',
            'shares_invalid' => 'Shares Invalid',
            'pci_bus' => 'Pci Bus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRig()
    {
        return $this->hasOne(Rigs::className(), ['id' => 'rig_id']);
    }

    public function getTotalHashrate()
    {
        $exp = explode(";", $this->rate_shares);
        return number_format($exp[0] / 1000, 2);
    }

    public function getTempData()
    {
        $data = [];
        foreach ( ($exp = explode(";", $this->temp_speed)) as $key => $value) {
            if ($key % 2 == 0) {
                $data[$key / 2] = [
                    'temp' => $value,
                    'fanspeed' => $exp[$key + 1],
                ];
            }
            else {
                $data[($key - 1) / 2] = [
                    'temp' => $exp[$key - 1] . '&#176;C',
                    'fanspeed' => ($value ?? '--') . '%',
                ];
            }
        }
        if (sizeof($exp) / 2 < 8) {
            for ($i = sizeof($exp) / 2; $i < 8; $i++) { 
                $data[$i] = [
                    'temp' => '--&#176;C',
                    'fanspeed' => '--%',
                ];
            }
        }
        return $data;
    }
}
