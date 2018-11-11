<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RigsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rigs';
$this->params['breadcrumbs'][] = $this->title;


?>



<style type="text/css">
.table {
    width: calc(100vw - 15px);
    margin: 0 0 0 -15px;
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
    height: 180px;
}
.table tbody tr.o {
    height: 250px;
}
.table tbody tr > td {
    transition: .1s;
    overflow: hidden;
    padding-top: 15px!important;
}
.table tbody tr.o > td {
    padding-top: 40px;
}
.span-temp {
    font-size: 12px; 
    padding: 2px 0 2px 2px; 
    margin: 0 16px 5px 0;
    border-radius: 2px;
}
.span-ip {
    color: #aaa; 
    float: left; 
    width: 50%; 
    text-align: right; 
    position: relative; 
    top: 2px;
}
.span-hostname {
    float: left; 
    width: 50%;
}
</style>



<div class="rigs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rigs', ['create'], ['class' => 'btn btn-success']) ?>
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

                    $this->registerJs(
                        'setTimeout(function(){ rigHashrate(' . $model->dayRate . ', ' . $model->id . '); }, 1000);' 
                    );

                    $data = [];
                    // $data[] = '<span>' . $model->dayRate . '</span>'; 
                    $data[] = '<div class="chart-container" style="max-width: 80vw;"> <canvas id="chart-hashrate-' . $model->id . '"></canvas> </div>';
                    return implode('<br/>', $data);
                },
            ],


            [
                'label' => 'Data',
                'format'    => 'raw',
                'contentOptions' => [
                    'style' => 'width: 20vw'
                ],
                'value'   => function ($model) {

                    $html = ['<div style="width: 80%">'];

                    $html[] = '<span class="span-hostname">' . $model->hostname . '</span>';
                    $html[] = '<small class="span-ip">' . $model->ip . '</small><br/>';

                    if ($model->lastJournal) {
                        $html[] = '<small class="label label-' . ($model->lastJournal->up ? 'success' : 'danger') . '">State: ' . ($model->lastJournal->up ? 'UP' : 'DOWN') . '</small>';
                        $html[] = '<small class="label label-' . (count(explode(";", $model->lastJournal->rate_details)) < 8 ? 'danger' : 'success') . '">GPUs: ' . count(explode(";", $model->lastJournal->rate_details)) . '</small>';
                        $html[] = '<small class="label label-' . ($model->lastJournal->totalHashrate < 220 ? 'danger' : ($model->lastJournal->totalHashrate >= 240 ? 'success' : 'warning')) . '">Rate: ' . $model->lastJournal->totalHashrate . ' MH/s</small><br/>';

                        if (sizeof($model->lastJournal->tempData)) {
                            foreach ($model->lastJournal->tempData as $key => $data) {
                                $html[] = '<small class="span-temp ' . ((int)$data['temp'] > 60 || !(int)$data['temp'] ? 'text-danger' : '') . '">' . $data['temp'] . '/' . $data['fanspeed'] . '</small>' . (($key + 1) % 4 == 0 ? '<br/>' : '');
                            }
                        }

                        $html[] = '<br/><small class="pull-right">Runtime: ' . (int)($model->lastJournal->runtime / 60) . ' h ' . ($model->lastJournal->runtime % 60) . ' min</small><br/>';

                    }

                    $html[] = '</div>';

                    return implode('', $html);
                },
            ],
            // 'rig_id',
            // 'dtime:datetime',
            // 'up',
            // 'request_ip',
            //'request:ntext',
            //'response:ntext',
            // 'response_html:ntext',
            //'miner_version',
            //'runtime:datetime',
            //'rate_shares',
            //'rate_details',
            //'temp_speed',
            //'pools',
            //'invalid_switches',
            //'shares_accepted',
            //'shares_rejected',
            //'shares_invalid',
            //'pci_bus',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
