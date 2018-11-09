<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Rigs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rigs-view">

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
            'hostname',
            'description:ntext',
            'status',
            'allocation_id',
            'model_id',
            'data:ntext',
            'dtime:datetime',
        ],
    ]) ?>

</div>
