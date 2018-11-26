<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Rigs;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RigsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cumulative Rate ' . $dataProvider->getTotalCount() . ' / 200';
// $this->params['breadcrumbs'][] = $this->title;


?>



<style type="text/css">
.table {
    width: calc(100vw - 15px);
    margin: 0;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    /*padding: 15px;*/
    border: none!important;
    display: flex!important;
    padding: 0px!important;
}
.table > thead > tr > th {
    /*vertical-align: bottom;*/
    border-bottom: 1px solid #ddd;
}
.container {
    width: 100%;
}
.table tbody tr {
    padding: 0px!important;
    transition: .1s;
    display: inline-block;
    min-width: 200px;
    /*min-width: 16vw;*/
    width: auto;
    float: left;
    text-align: center;
    /*height: 180px;*/
}
/*.table tbody tr.o {*/
.table tbody tr:hover {
    /*height: 250px;*/
    /*filter: grayscale(1);*/

}
.table tbody tr > td {
    transition: .1s;
    overflow: hidden;
    padding-top: 0px!important;
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

    <!-- <h1><?= $this->title ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="chart-container" style="height: 160px; width: 70vw"> <canvas id="chart-mutual"></canvas> </div>

    <div id="rig-first">

        <div class="pull-left chart-container" style="height: 160px; width: 70vw"> <canvas id="chart-first"></canvas> </div>

        <div class="pull-left" style="height: 160px; width: 25vw">
            <span class="span-hostname"><?= $modelFirst->hostname ?></span>
            <small class="span-ip"><?= $modelFirst->ip ?></small>

            <div class="div-temp pull-left" style="width: 100%">
                <?php
                    if (sizeof($modelFirst->lastJournal->tempData)) {
                        foreach ($modelFirst->lastJournal->tempData as $key => $data) {
                            echo '<small class="span-temp ' . 
                                ((int)$data['temp'] > 60 || !(int)$data['temp'] ? 'text-danger' : '') . '">' . 
                                $data['temp'] . '/' . $data['fanspeed'] . '</small>' . 
                                (($key + 1) % 4 == 0 ? '<br/>' : '');
                        }
                    }
                ?>
            </div><br/>

            <small class="span-runtime">
                Runtime: <?= (int)($modelFirst->lastJournal->runtime / 60) . ' h ' . ($modelFirst->lastJournal->runtime % 60) ?> min
            </small><br/>

            <small class="label label-up label-<?= ($modelFirst->lastJournal->up ? 'success' : 'danger') ?>">
                State: <?= ($modelFirst->lastJournal->up ? 'UP' : 'DOWN') ?>
            </small>

            <small class="label label-count label-<?= (count(explode(";", $modelFirst->lastJournal->rate_details)) < 8 ? 'danger' : 'success') ?>">
                GPUs: <?= count(explode(";", $modelFirst->lastJournal->rate_details)) ?>
            </small>

            <small class="label label-rate label-<?= ($modelFirst->lastJournal->totalHashrate < 220 ? 'danger' : ($modelFirst->lastJournal->totalHashrate >= 240 ? 'success' : 'warning')) ?>">
                Rate: <?= $modelFirst->lastJournal->totalHashrate ?> MH/s
            </small><br/>

            <?php echo Html::a('<i class="glyphicon glyphicon-align-left" style="top: 0; font-size: 12px"></i> Raw View', 
                ['rigs/raw', 'id' => $modelFirst->id], 
                [
                    'style' => 'color: #777',
                    'target' => '_blank'
                ]
            ); ?>

        </div>
    </div>

    <br/><br/><br/>


    <?php Pjax::begin(); ?>


    <?php $dataProvider->pagination->pageSize = 200; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader'=> false,
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        'columns' => [

            [
                'label' => 'Data',
                'format'    => 'raw',
                'contentOptions' => [
                    'style' => 'width: auto',
                    'title' => 'Tap to see full info'
                ],
                'value'   => function ($model) {

                    $html = ['<div style="cursor: pointer" class="click-rig" data-rig="' . $model->id . '">'];

                    if ($model->lastJournal) {
                        $html[] = '<small class="label label-' . ($model->lastJournal->up ? 'success' : 'danger') . '">' . ($model->lastJournal->up ? 'UP' : 'DOWN') . '</small>';
                        $html[] = '<small class="label label-' . (count(explode(";", $model->lastJournal->rate_details)) < 8 ? 'danger' : 'success') . '">GPUs: ' . count(explode(";", $model->lastJournal->rate_details)) . '</small>';
                        $html[] = '<small class="label label-' . ($model->lastJournal->totalHashrate < 220 ? 'danger' : ($model->lastJournal->totalHashrate >= 240 ? 'success' : 'warning')) . '">' . $model->lastJournal->totalHashrate . ' MH/s</small><br/>';
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
        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>

<?php 

$this->registerJs('mutualHashrate(' . json_encode(Rigs::mutualData()) . ');');

$this->registerJs('rigFirstHashrate(' . json_encode($modelFirst->dayRate) . ');');

$this->registerJs("
    $(document).on('click', '.click-rig', function(){
        var id = $(this).attr('data-rig');
        var csrfToken = $('meta[name=\"csrf-token\"]').attr(\"content\");
        $.ajax({
            url: 'index.php?r=rigs/info',
            method: 'post',
            data: {'id': id, '_csrf-backend': csrfToken},
            dataType: 'json',
            cache: false,
            error: function(data){
                console.log(data);
            },
            success: function(data){
                // console.log(data);
                rigExpand(data);
            },
        });
    });
"); 

?> 

