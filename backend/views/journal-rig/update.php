<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JournalRig */

$this->title = 'Update Journal Rig: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Journal Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="journal-rig-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
