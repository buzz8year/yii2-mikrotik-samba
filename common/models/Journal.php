<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal".
 *
 * @property int $id Идентификатор
 * @property int $miner_id Идентификатор майнера
 * @property string $unique_id Уникальный идентификатор
 * @property int $up 1 - онлайн, 0 - не в сети
 * @property int $dtime Метка времени
 * @property int $year Год
 * @property int $month Месяц
 * @property int $day День
 * @property int $hour Час
 * @property int $minute Минуты
 * @property int $uptime Ко-во секунд с момента начала работы
 * @property string $type Тип майнера
 * @property string $bmminer Версия bmminer
 * @property string $hardware Аппаратная версия
 * @property int $firmware Версия прошивки
 * @property string $model Модель чипов
 * @property string $hashrate Хешрейт последние 5 секунд
 * @property string $hashrate_avg Средний рабочий хешрейт
 * @property string $freq_avg Средняя рабочая частота
 * @property double $freq_total Общая частота
 * @property int $miner_count Количечество плат
 * @property int $fan_num Кол-во вентиляторов
 * @property string $fan_speed Скорость вентиляторов
 * @property string $chips Кол-во чипов по платам
 * @property int $chips_alive Количество рабочих чипов
 * @property int $chips_bad Количество дефектных чипов
 * @property int $chips_lost Количество неактивных чипов
 * @property string $chain_rate Текущий хэшрейт плат GH/S
 * @property string $chain_rate_total Общий хэшрейт всех плат GH/S
 * @property string $chain_rateideal Идеальный хэшрейт плат GH/S
 * @property string $chain_rateideal_total Общий идеальный хэшрейт всех плат GH/S
 * @property string $chain_offside
 * @property string $hw_error_rate Процент hw
 * @property string $chain_hw Показания ошибок на платах
 * @property string $chain_xtime Неизвестная информация
 * @property string $temp_chips Температура чипов на платах
 * @property int $temp_chips_max Максимальная температура чипов
 * @property string $temp_boards Температура плат
 * @property int $temp_board_max Максимальная температура плат
 *
 * @property Miners $miner
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['miner_id', 'dtime'], 'required'],
            [['miner_id', 'up', 'dtime', 'year', 'month', 'day', 'hour', 'minute', 'uptime', 'firmware', 'miner_count', 'fan_num', 'chips_alive', 'chips_bad', 'chips_lost', 'temp_chips_max', 'temp_board_max'], 'integer'],
            [['hashrate', 'hashrate_avg', 'freq_total', 'chain_rate_total', 'chain_rateideal_total', 'hw_error_rate'], 'number'],
            [['chain_xtime'], 'string'],
            [['unique_id', 'freq_avg', 'chain_rate', 'chain_rateideal', 'chain_offside', 'chain_hw', 'temp_chips', 'temp_boards'], 'string', 'max' => 64],
            [['type', 'bmminer', 'hardware', 'fan_speed', 'chips'], 'string', 'max' => 16],
            [['model'], 'string', 'max' => 5],
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
            'unique_id' => 'Unique ID',
            'up' => 'Up',
            'dtime' => 'Dtime',
            'year' => 'Year',
            'month' => 'Month',
            'day' => 'Day',
            'hour' => 'Hour',
            'minute' => 'Minute',
            'uptime' => 'Uptime',
            'type' => 'Type',
            'bmminer' => 'Bmminer',
            'hardware' => 'Hardware',
            'firmware' => 'Firmware',
            'model' => 'Model',
            'hashrate' => 'Hashrate',
            'hashrate_avg' => 'Hashrate Avg',
            'freq_avg' => 'Freq Avg',
            'freq_total' => 'Freq Total',
            'miner_count' => 'Miner Count',
            'fan_num' => 'Fan Num',
            'fan_speed' => 'Fan Speed',
            'chips' => 'Chips',
            'chips_alive' => 'Chips Alive',
            'chips_bad' => 'Chips Bad',
            'chips_lost' => 'Chips Lost',
            'chain_rate' => 'Chain Rate',
            'chain_rate_total' => 'Chain Rate Total',
            'chain_rateideal' => 'Chain Rateideal',
            'chain_rateideal_total' => 'Chain Rateideal Total',
            'chain_offside' => 'Chain Offside',
            'hw_error_rate' => 'Hw Error Rate',
            'chain_hw' => 'Chain Hw',
            'chain_xtime' => 'Chain Xtime',
            'temp_chips' => 'Temp Chips',
            'temp_chips_max' => 'Temp Chips Max',
            'temp_boards' => 'Temp Boards',
            'temp_board_max' => 'Temp Board Max',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMiner()
    {
        return $this->hasOne(Miners::className(), ['id' => 'miner_id']);
    }
}
