<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rigs */

$this->title = 'Create Rigs';
$this->params['breadcrumbs'][] = ['label' => 'Rigs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rigs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
