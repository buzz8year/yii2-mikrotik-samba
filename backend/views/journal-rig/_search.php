<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\JournalRigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-rig-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rig_id') ?>

    <?= $form->field($model, 'dtime') ?>

    <?= $form->field($model, 'up') ?>

    <?= $form->field($model, 'request_ip') ?>

    <?php // echo $form->field($model, 'request') ?>

    <?php // echo $form->field($model, 'response') ?>

    <?php // echo $form->field($model, 'response_html') ?>

    <?php // echo $form->field($model, 'miner_version') ?>

    <?php // echo $form->field($model, 'runtime') ?>

    <?php // echo $form->field($model, 'rate_shares') ?>

    <?php // echo $form->field($model, 'rate_details') ?>

    <?php // echo $form->field($model, 'temp_speed') ?>

    <?php // echo $form->field($model, 'pools') ?>

    <?php // echo $form->field($model, 'invalid_switches') ?>

    <?php // echo $form->field($model, 'shares_accepted') ?>

    <?php // echo $form->field($model, 'shares_rejected') ?>

    <?php // echo $form->field($model, 'shares_invalid') ?>

    <?php // echo $form->field($model, 'pci_bus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
