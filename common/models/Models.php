<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "models".
 *
 * @property int $id идентификатор
 * @property string $name Название модели
 * @property string $description Описание
 * @property double $hashrate Хешрейт
 * @property string $unit Обозначение мощности
 * @property int $chips Количество чипов
 * @property string $asic
 * @property string $temp_keys Ключ температуры
 */
class Models extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['hashrate'], 'number'],
            [['chips'], 'integer'],
            [['name', 'description'], 'string', 'max' => 150],
            [['unit'], 'string', 'max' => 15],
            [['asic'], 'string', 'max' => 16],
            [['temp_keys'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'hashrate' => 'Hashrate',
            'unit' => 'Unit',
            'chips' => 'Chips',
            'asic' => 'Asic',
            'temp_keys' => 'Temp Keys',
        ];
    }
}
