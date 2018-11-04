<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Miners */

$this->title = 'Create Miners';
$this->params['breadcrumbs'][] = ['label' => 'Miners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
