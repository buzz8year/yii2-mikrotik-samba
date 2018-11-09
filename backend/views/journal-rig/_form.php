<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JournalRig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-rig-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rig_id')->textInput() ?>

    <?= $form->field($model, 'dtime')->textInput() ?>

    <?= $form->field($model, 'up')->textInput() ?>

    <?= $form->field($model, 'request_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'response')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'response_html')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'miner_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'runtime')->textInput() ?>

    <?= $form->field($model, 'rate_shares')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp_speed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pools')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invalid_switches')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shares_accepted')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shares_rejected')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shares_invalid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pci_bus')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
