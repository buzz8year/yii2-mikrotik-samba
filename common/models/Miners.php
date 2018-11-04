<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "miners".
 *
 * @property int $id Идентификатор
 * @property string $ip ip адрес
 * @property int $port Порт получения статистики
 * @property string $mac
 * @property int $model_id Модель
 * @property int $allocation_id Местоположение
 * @property string $name Название майнера
 * @property string $description Описание майнера
 * @property int $dtime Дата добавления
 * @property int $status Статус: 0 - неактивный, 1 - активный
 *
 * @property Journal[] $journals
 * @property LastStats $lastStats
 * @property Allocation $allocation
 * @property Models $model
 * @property Pools $pools
 * @property UptimeRecord[] $uptimeRecords
 */
class Miners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'miners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['port', 'model_id', 'allocation_id', 'dtime', 'status'], 'integer'],
            [['allocation_id'], 'required'],
            [['ip', 'mac'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 255],
            [['allocation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Allocation::className(), 'targetAttribute' => ['allocation_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Models::className(), 'targetAttribute' => ['model_id' => 'id']],
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
            'model_id' => 'Model ID',
            'allocation_id' => 'Allocation ID',
            'name' => 'Name',
            'description' => 'Description',
            'dtime' => 'Dtime',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['miner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastStats()
    {
        return $this->hasOne(LastStats::className(), ['miner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllocation()
    {
        return $this->hasOne(Allocation::className(), ['id' => 'allocation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPools()
    {
        return $this->hasOne(Pools::className(), ['miner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUptimeRecords()
    {
        return $this->hasMany(UptimeRecord::className(), ['miner_id' => 'id']);
    }
}
