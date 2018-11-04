<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pools-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'miner_id')->textInput() ?>

    <?= $form->field($model, 'dtime')->textInput() ?>

    <?= $form->field($model, 'accepted')->textInput() ?>

    <?= $form->field($model, 'best_share')->textInput() ?>

    <?= $form->field($model, 'diff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diff_shares')->textInput() ?>

    <?= $form->field($model, 'difficulty_accepted')->textInput() ?>

    <?= $form->field($model, 'difficulty_rejected')->textInput() ?>

    <?= $form->field($model, 'difficulty_stale')->textInput() ?>

    <?= $form->field($model, 'discarded')->textInput() ?>

    <?= $form->field($model, 'get_failures')->textInput() ?>

    <?= $form->field($model, 'getworks')->textInput() ?>

    <?= $form->field($model, 'has_gbt')->textInput() ?>

    <?= $form->field($model, 'has_stratum')->textInput() ?>

    <?= $form->field($model, 'last_share_difficulty')->textInput() ?>

    <?= $form->field($model, 'last_share_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long_poll')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pool')->textInput() ?>

    <?= $form->field($model, 'pool_rejected_rate')->textInput() ?>

    <?= $form->field($model, 'pool_stale_rate')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'proxy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proxy_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quota')->textInput() ?>

    <?= $form->field($model, 'rejected')->textInput() ?>

    <?= $form->field($model, 'remote_failures')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stale')->textInput() ?>

    <?= $form->field($model, 'stratum_active')->textInput() ?>

    <?= $form->field($model, 'stratum_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'worker')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
