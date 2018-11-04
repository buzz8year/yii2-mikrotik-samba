<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pools-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pools', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'miner_id',
            'dtime:datetime',
            'accepted',
            'best_share',
            //'diff',
            //'diff_shares',
            //'difficulty_accepted',
            //'difficulty_rejected',
            //'difficulty_stale',
            //'discarded',
            //'get_failures',
            //'getworks',
            //'has_gbt',
            //'has_stratum',
            //'last_share_difficulty',
            //'last_share_time',
            //'long_poll',
            //'pool',
            //'pool_rejected_rate',
            //'pool_stale_rate',
            //'priority',
            //'proxy',
            //'proxy_type',
            //'quota',
            //'rejected',
            //'remote_failures',
            //'status',
            //'stale',
            //'stratum_active',
            //'stratum_url:url',
            //'url:url',
            //'worker',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
