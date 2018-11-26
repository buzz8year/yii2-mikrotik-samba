<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poll_rig".
 *
 * @property int $id
 * @property int $poll_time poll execution start epoch
 * @property int $exe_time poll execution duration epoch
 * @property int $step_time poll cron step epoch
 * @property int $density number of rigs polled
 *
 * @property JournalRig[] $journalRigs
 */
class Poll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'poll_rig';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['poll_time', 'exe_time', 'step_time'], 'required'],
            [['poll_time', 'exe_time', 'step_time', 'density'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'poll_time' => 'Poll Time',
            'exe_time' => 'Exe Time',
            'step_time' => 'Step Time',
            'density' => 'Density',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournalRigs()
    {
        return $this->hasMany(JournalRig::className(), ['poll_id' => 'id']);
    }
}
