<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Miners */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Miners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

foreach($model->journals as $journal) {
    $stats['history']['currentHashrate'][] = $journal->hashrate;
    $stats['history']['time'][] = $journal->dtime;
}

if (isset($stats['history'])) {
    $this->registerJs(
        'minerHashrate(' . json_encode($stats['history']) . ');' 
        // .
        // 'minerShares(' . json_encode($stats['history']) . ');'
    );
}

?>

<div class="miners-view">

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
            'ip',
            'port',
            'mac',
            'model_id',
            'allocation_id',
            'name',
            'description',
            'dtime:datetime',
            'status',
        ],
    ]) ?>

    <div class="wrap-charts">

        <h3>Hashrate Effective* <small class="title-info" style="display: none">last <span class="count-hashrate"></span> records</small>
        </h3><br/>

        <div class="chart-container">
            <canvas id="chart-hashrate"></canvas>
        </div><br/><br/>

    </div>

</div>
