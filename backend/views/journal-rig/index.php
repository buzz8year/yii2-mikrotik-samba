<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\JournalRigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Journal Rigs';
$this->params['breadcrumbs'][] = $this->title;







?>



<style type="text/css">
.table {
    table-layout: fixed;
    font-size: 14px;
}
.table > thead > tr > th {
    /*vertical-align: bottom;*/
    border-bottom: 1px solid #ddd;
}
.container {
    width: 100%;
}
.table tbody tr {
    transition: .1s;
    /*height: 180px;*/
}
.table tbody tr.o {
    /*height: 250px;*/
}
.table tbody tr > td {
    transition: .1s;
    overflow: hidden!important;
    padding-top: 15px!important;
}
.table tbody tr.o > td {
    padding-top: 40px;
}
</style>




<div class="journal-rig-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Journal Rig', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',

            [
                'label' => 'Data',
                'format'    => 'raw',
                'value'   => function ($model, $index) {
                    return $model->rig->hostname;
                },
            ],
            // 'rig_id',
            'dtime:datetime',
            [
                'label' => 'Data',
                'format'    => 'raw',
                'value'   => function ($model, $index) {
                    return $model->up ? '<span class="label label-success">UP</span>' : '<span class="label label-danger">DOWN</span>';
                },
            ],
            // 'request_ip',
            //'request:ntext',
            //'response:ntext',
            // 'response_html:ntext',
            //'miner_version',
            [
                'label' => 'Data',
                'format'    => 'raw',
                'value'   => function ($model, $index) {
                    return '<small class="bg-info">Runtime: ' . (int)($model->runtime / 60) . ' h ' . ($model->runtime % 60) . ' min</small>';
                },
            ],
            'rate_shares',
            'rate_details',
            'temp_speed',
            'pools',
            //'invalid_switches',
            //'shares_accepted',
            //'shares_rejected',
            //'shares_invalid',
            'pci_bus',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
