<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "allocation".
 *
 * @property int $id Идентификатор записи
 * @property string $name Наименование помещения
 * @property string $description Описание
 * @property string $networks Выделенные подсети
 *
 * @property Miners[] $miners
 */
class Allocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allocation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description', 'networks'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'networks' => 'Networks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMiners()
    {
        return $this->hasMany(Miners::className(), ['allocation_id' => 'id']);
    }
}
