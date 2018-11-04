<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MinersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Miners';
$this->params['breadcrumbs'][] = $this->title;



?>

<style type="text/css">
th {
    border-bottom: none!important;
}    
.miners-index {
    width: 100%;
}
</style>


<div class="miners-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Miners', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table striped'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
            'port',
            'mac',
            [
                'label' => 'Location',
                'attribute' => 'allocation_id',
                'filter'    =>  \yii\helpers\ArrayHelper::map( 
                    \common\models\Allocation::find()->all(), 
                    'id', 
                    'name' 
                ),
                'value' => function($model){
                    return $model->allocation->name;
                },
            ],
            [
                'label' => 'Model',
                'format' => 'raw',
                'value' => function($model){
                    return $model->model->name;
                    // return '<canvas id="chart-hashrate-' . $model->id . '"></canvas>';
                },
            ],
            [
                'attribute' => 'stratum',
                'attribute' => 'stratum',
                'filter'    =>  \common\models\Pools::getUniques(), 
                'label' => 'Pool/Stratum',
                'value' => function($model){
                    return $model->pools->url;
                },
            ],
            'name',
            'description',
            'dtime:datetime',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
