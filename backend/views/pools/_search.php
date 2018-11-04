<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\PoolsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pools-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'miner_id') ?>

    <?= $form->field($model, 'dtime') ?>

    <?= $form->field($model, 'accepted') ?>

    <?= $form->field($model, 'best_share') ?>

    <?php // echo $form->field($model, 'diff') ?>

    <?php // echo $form->field($model, 'diff_shares') ?>

    <?php // echo $form->field($model, 'difficulty_accepted') ?>

    <?php // echo $form->field($model, 'difficulty_rejected') ?>

    <?php // echo $form->field($model, 'difficulty_stale') ?>

    <?php // echo $form->field($model, 'discarded') ?>

    <?php // echo $form->field($model, 'get_failures') ?>

    <?php // echo $form->field($model, 'getworks') ?>

    <?php // echo $form->field($model, 'has_gbt') ?>

    <?php // echo $form->field($model, 'has_stratum') ?>

    <?php // echo $form->field($model, 'last_share_difficulty') ?>

    <?php // echo $form->field($model, 'last_share_time') ?>

    <?php // echo $form->field($model, 'long_poll') ?>

    <?php // echo $form->field($model, 'pool') ?>

    <?php // echo $form->field($model, 'pool_rejected_rate') ?>

    <?php // echo $form->field($model, 'pool_stale_rate') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'proxy') ?>

    <?php // echo $form->field($model, 'proxy_type') ?>

    <?php // echo $form->field($model, 'quota') ?>

    <?php // echo $form->field($model, 'rejected') ?>

    <?php // echo $form->field($model, 'remote_failures') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'stale') ?>

    <?php // echo $form->field($model, 'stratum_active') ?>

    <?php // echo $form->field($model, 'stratum_url') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'worker') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
