<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\JournalRig */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journal Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-rig-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rig_id',
            'dtime:datetime',
            'up',
            'request_ip',
            'request:ntext',
            'response:ntext',
            'response_html:ntext',
            'miner_version',
            'runtime:datetime',
            'rate_shares',
            'rate_details',
            'temp_speed',
            'pools',
            'invalid_switches',
            'shares_accepted',
            'shares_rejected',
            'shares_invalid',
            'pci_bus',
        ],
    ]) ?>

</div>
