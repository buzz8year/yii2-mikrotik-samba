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
body {
    background-color: #333;
    color: #aaa;
    min-height: 100vh;
    height: auto;
    overflow-x: hidden;
}
footer {
    background-color: transparent!important;
    border: none!important;
    color: #aaa;
}
.wrap {
    padding: 0;
    margin-bottom: 100px;
}
.table {
    /*width: calc(100vw - 15px);*/
    width: 100%;
    margin: 0;
}
.table tbody {
    display: flex;
    justify-content: center;
    flex-flow: row wrap;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    /*padding: 15px;*/
    border: none!important;
    padding: 0px!important;
}
.table > thead > tr > th {
    /*vertical-align: bottom;*/
    border-bottom: 1px solid #ddd;
}
.container {
    width: 100%;
    padding-bottom: 0!important;
}
.table tbody tr {
    padding: 0px!important;
    transition: .1s;
    display: inline-flex;
    min-width: 220px;
    /*min-width: 16vw;*/
    width: 220px;
    /*float: left;*/
    text-align: center;
    /*height: 180px;*/
    filter: grayscale(.3);
    /*margin-bottom: 1px;*/
}
.table-striped > tbody > tr:nth-of-type(odd) {
    background-color: transparent;
}
.table tbody tr:hover {
    /*filter: grayscale(0);*/
}
/*.table tbody tr.o {*/
.table tbody tr:hover .label, .click-rig.selected .label {
    /*height: 250px;*/
    background-color: #08c!important;
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
#rig-first {
    margin: 60px 0 120px;
    float: left;
}
.chart-mutual {
    position: relative; 
    bottom: -10px; 
    left: 0;
    height: 160px; 
    width: calc(100vw + 35px); 
    margin-left: -30px;
    /*filter: grayscale(1) opacity(.5);*/
}
/*.chart-mutual:hover {
    filter: grayscale(0) opacity(1);
}*/
.info-first {
    padding-left: 60px;
}
#raw-html {
    width: calc(100vw - 35px);
    height: 300px;
    overflow-x: hidden;
    overflow-y: scroll;
    padding: 30px 0 5px 20px;
    background-color: #3a3a3a;
    font-size: 12px;
    margin: -30px 0 0 -15px;
    box-sizing: content-box;
    /*opacity: .6;*/
}
/*#raw-html:hover {
    opacity: 1;
}*/
::-webkit-scrollbar {
    background: rgba(255,255,255,.02);
}
::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,.05);
}
#raw-html::-webkit-scrollbar {
    background: transparent;
}
.raw-corner {
    position: absolute;
    right: 0;
    top: 300px;
    right: 30px;
    width: 150px;
    color: rgba(255,255,255,.3);
}
#count-sec {
    position: absolute;
}
.count-unit {
    margin-left: 14px;
}
.link-raw {
    color: rgba(255,255,255,.3);
    font-size: 14px;
    text-decoration: none!important;
    cursor: pointer;
}
.link-raw:hover, .link-raw:focus  {
    color: rgba(255,255,255,1);
}
</style>



<div class="rigs-index">

    <!-- <h1><?= $this->title ?></h1> -->


    <div id="raw-html" data-id="<?= $modelFirst->id ?>">
        <span class="raw-corner">
            <span>
                Scrollable <br/>  
                <span id="count-sec">Auto-updating (15s)</span>
                <!-- <span class="count-unit">s</span>  -->
            </span><br/>
            <span>
                <a class="link-raw" target="_blank"><i class="glyphicon glyphicon-align-left" style="top: 0; font-size: 12px"></i> New tab</a>
            </span>
        </span>
        <div id="div-raw">
            <?php //echo $modelFirst->lastJournal->response_html; ?>
        </div>
    </div>

    <div id="rig-first">

        <div class="pull-left chart-container" style="height: 160px; width: 70vw"> <canvas id="chart-first"></canvas> </div>

        <div class="pull-left info-first" style="height: 160px; width: 25vw; margin-top: 5px;">
            <span class="span-hostname"><?= $modelFirst->hostname ?></span>
            <small class="span-ip"><?= $modelFirst->ip ?></small><br/><br/>

            <small class="span-runtime">
                Runtime: <?= (int)($modelFirst->lastJournal->runtime / 60) . ' h ' . ($modelFirst->lastJournal->runtime % 60) ?> min
            </small><br/>

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
            </div><br/><br/><br/>

            <small class="label label-up label-<?= ($modelFirst->lastJournal->up ? 'success' : 'danger') ?>">
                State: <?= ($modelFirst->lastJournal->up ? 'UP' : 'DOWN') ?>
            </small>

            <small class="label label-count label-<?= (count(explode(";", $modelFirst->lastJournal->rate_details)) < 8 ? 'danger' : 'success') ?>">
                GPUs: <?= count(explode(";", $modelFirst->lastJournal->rate_details)) ?>
            </small>

            <small class="label label-rate label-<?= ($modelFirst->lastJournal->totalHashrate < 210 ? 'danger' : ($modelFirst->lastJournal->totalHashrate >= 230 ? 'success' : 'warning')) ?>">
                Rate: <?= $modelFirst->lastJournal->totalHashrate ?> MH/s
            </small><br/>

        </div>
    </div>

    <br/><br/><br/>


    <?php Pjax::begin(); ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $dataProvider->pagination->pageSize = 220; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader'=> false,
        'tableOptions' => [
            'class' => 'table table-striped',
        ],
        // 'layout'=> "{summary}\n{items}\n{pager}",
        'layout'=> '{items}',
        'columns' => [

            [
                'label' => 'Data',
                'format'    => 'raw',
                'contentOptions' => [
                    'style' => 'width: auto',
                    'title' => 'Tap to see full info'
                ],
                'value'   => function ($model) {

                    $exp = explode('.', $model->ip);

                    $html = ['<div style="cursor: pointer" class="pull-left click-rig" data-rig="' . $model->id . '">'];

                    if ($model->lastJournal) {
                        $html[] = '<span class="label label-default" style="width:40px; direction: rtl; text-align: right">' . end($exp) . '.</span>';
                        $html[] = '<span class="label label-' . ($model->lastJournal->up ? 'success' : 'danger') . '">' . ($model->lastJournal->up ? 'UP' : 'DOWN') . '</span>';
                        $html[] = '<span class="label label-' . (count(explode(";", $model->lastJournal->rate_details)) < 8 ? 'danger' : 'success') . '">' . count(explode(";", $model->lastJournal->rate_details)) . '</span>';
                        $html[] = '<span class="label label-' . ($model->lastJournal->totalHashrate < 210 ? 'danger' : ($model->lastJournal->totalHashrate >= 230 ? 'success' : 'warning')) . '">' . $model->lastJournal->totalHashrate . ' MH/s</span>';
                    }
                    else {
                        $html[] = '<span class="label label-default" style="width:40px; direction: rtl; text-align: right">' . end($exp) . '.</span>';
                        $html[] = '<span class="label label-default">Error: no response</span>';
                        // $html[] = '<span class="label label-default" style="width: 206px">Error: empty record data</span>';
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

    <div class="pull-left text-center container" style="margin-top: 100px">
        <div><?php echo 'Total: ' . (Rigs::countEnabled() + Rigs::countDisabled()); ?></div>
        <div><?php echo 'Responding: ' . Rigs::countEnabled(); ?></div>
        <div><?php echo 'Disabled: ' . Rigs::countDisabled(); ?></div><br/><br/>
        <div><?php echo 'Hashrate: ' . Rigs::mutualLastRate()['rate'] . ' GH/s (' . Rigs::mutualLastRate()['date'] . ')'; ?></div>
    </div>

    <?php Pjax::end(); ?>


</div>


<?php 

$this->registerJs('mutualHashrate(' . json_encode(Rigs::mutualData()) . ');');

$this->registerJs('rigFirstHashrate(' . json_encode($modelFirst->dayRate) . ');');

$this->registerJs('

    rawHtml(getFirstRig());
    rawScroll();

    setInterval(function () {
        rawHtml(getFirstRig());
    }, 15000);

'); 

?>

