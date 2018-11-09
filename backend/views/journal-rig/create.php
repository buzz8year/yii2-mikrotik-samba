<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JournalRig */

$this->title = 'Create Journal Rig';
$this->params['breadcrumbs'][] = ['label' => 'Journal Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-rig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
