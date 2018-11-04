<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Pools */

$this->title = 'Create Pools';
$this->params['breadcrumbs'][] = ['label' => 'Pools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pools-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
