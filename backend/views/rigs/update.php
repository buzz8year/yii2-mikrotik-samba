<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rigs */

$this->title = 'Update Rigs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rigs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
