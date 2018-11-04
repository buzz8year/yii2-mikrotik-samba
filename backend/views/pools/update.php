<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pools */

$this->title = 'Update Pools: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pools-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
