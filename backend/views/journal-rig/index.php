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
.table > thead > tr > th {
    /*vertical-align: bottom;*/
    border-bottom: 1px solid #ddd;
}
.container {
    width: 100%;
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
                'contentOptions' => [
                    'style' => 'width: 200px'
                ],
                'value'   => function ($model) {
                    $html = [];
                    $html[] = '<span>' . $model->rig->hostname . '</span> &nbsp;';
                    $html[] = '<small style="color: #ccc">' . $model->rig->ip . '</small><br/>';
                    $html[] = '<small class="bg-success">State: ' . ($model->up ? 'UP' : 'DOWN') . '</small><br/>';
                    $html[] = '<small class="bg-info">Runtime: ' . $model->runtime . ' min</small><br/>';
                    $html[] = '<small class="bg-warning">Hashrate: ' . explode(";", $model->rate_shares)[0] / 1000 . ' MH/s</small><br/>';

                    if (sizeof($model->tempData)) {
                        foreach ($model->tempData as $key => $data) {
                            $html[] = '<small style="font-size: 12px; padding: 2px 5px; margin: 0 5px 5px 0" class="bg-' . ((int)$data['temp'] > 60 ? 'danger' : 'success') . '">' . $data['temp'] . '&#176;C/' . $data['fanspeed'] . '%</small>' . (($key + 1) % 4 == 0 ? '<br/>' : '');
                        }
                    }

                    $html[] = '<small class="bg-' . (count(explode(";", $model->rate_details)) < 8 ? 'danger' : 'success') . '">GPU quantity: ' . count(explode(";", $model->rate_details)) . '</small><br/>';

                    return implode('', $html);
                },
            ],

            [
                'label' => 'Data',
                'format'    => 'raw',
                'value'   => function ($model, $index) {

                    $this->registerJs(
                        'setTimeout(function(){ rigHashrate(' . $model->rig->dayRate . ', ' . $model->id . '); }, 1000);' 
                    );

                    $data = [];
                    // $data[] = '<span>' . $model->rig->dayRate . '</span>'; 
                    $data[] = '<div class="chart-container" style="max-width: 60vw"> <canvas id="chart-hashrate-' . $model->id . '"></canvas> </div>';
                    return implode('<br/>', $data);
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
