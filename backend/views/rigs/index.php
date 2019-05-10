<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

use common\models\Rigs;
use common\models\Poll;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RigsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cumulative Rate ' . $dataProvider->getTotalCount() . ' / 200';
// $this->params['breadcrumbs'][] = $this->title;

// $this->registerJs('mutualHashrate(' . json_encode(Rigs::mutualData()) . ');');




// $this->registerJs('rigFirstHashrate(' . json_encode($modelFirst->dayRate) . ');');
$this->registerJs('
    $(document).ready(function(){
        $.ajax({
            url: \'index.php?r=rigs/get-model\',
            type: \'post\',
            data: { rig_id: ' . $modelID . ' },
            success: function(data) {
                console.log(4444444);
                console.log(data);
                var e = document.getElementById(\'wrap-rig\');
                $(e).html(data);

                rigFirstHashrate(' . json_encode($modelFirst->dayRate) . ');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
');


?>





<?php 
    // ALGORITHM HAShRATE EXPLANATION
    Modal::begin([
        'header' => false,
        'id' => 'modal-config',
        'size' => 'modal-lg',
    ]);
     
    echo 'Sometext...';
     
    Modal::end(); 
?>



<div class="rigs-index">

    <!-- <h1><?= $this->title ?></h1> -->
    <div id="raw-id" data-id="<?= $modelID ?>">

    <div id="wrap-rig">
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

                    // $exp = explode('.', $model->ip);

                    $html = ['<div style="cursor: pointer" class="pull-left click-rig" data-rig="' . $model->id . '">'];

                    if ($model->lastJournal) {
                        // $html[] = '<span class="label label-default" style="width:40px; direction: rtl; text-align: right">' . end($exp) . '.</span>';
                        $html[] = '<span class="label gpu-state label-' . ($model->lastJournal->up ? 'default' : 'danger') . '">' . ($model->shelf ? $model->shelf : '---') . '</span>';
                        $html[] = '<span class="label gpu-count label-' . (count(explode(";", $model->lastJournal->rate_details)) < 8 ? 'warning' : 'success') . '">' . count(explode(";", $model->lastJournal->rate_details)) . '</span>';
                        $html[] = '<span class="label gpu-rate  label-' . ($model->lastJournal->totalHashrate < 210 ? 'warning' : ($model->lastJournal->totalHashrate >= 230 ? 'success' : 'warning')) . '">' . $model->lastJournal->totalHashrate . ' MH/s</span>';
                    }
                    else {
                        $html[] = '<span class="label gpu-state label-danger">' . ($model->shelf ? $model->shelf : '---') . '</span>';
                        $html[] = '<span class="label gpu-count label-danger visible-xs">0</span>';
                        $html[] = '<span class="label label-danger no-response">Error: no response</span>';
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
        <div><?php echo 'Total (enabled): ' . $pollLast->total; ?></div>
        <div><?php echo 'Responding: ' . ($pollLast->total - $pollLast->fails); ?></div>
        <div><?php echo 'Disabled: ' . Rigs::countDisabled(); ?></div><br/><br/>
        <div><?php echo 'Hashrate: ' . Rigs::mutualLastRate()['rate'] . ' GH/s (' . Rigs::mutualLastRate()['date'] . ')'; ?></div>
        <!-- <a href="index.php?r=rigs/mass-config">Mass Configuration</a> -->
    </div>

    <?php Pjax::end(); ?>





</div>

