<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pools */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pools-view">

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
            'miner_id',
            'dtime:datetime',
            'accepted',
            'best_share',
            'diff',
            'diff_shares',
            'difficulty_accepted',
            'difficulty_rejected',
            'difficulty_stale',
            'discarded',
            'get_failures',
            'getworks',
            'has_gbt',
            'has_stratum',
            'last_share_difficulty',
            'last_share_time',
            'long_poll',
            'pool',
            'pool_rejected_rate',
            'pool_stale_rate',
            'priority',
            'proxy',
            'proxy_type',
            'quota',
            'rejected',
            'remote_failures',
            'status',
            'stale',
            'stratum_active',
            'stratum_url:url',
            'url:url',
            'worker',
        ],
    ]) ?>

</div>
