<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RigsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
.show-disabled {
    float: left;
    text-align: center;
    margin-bottom: 30px;
}
.show-disabled label {
    font-weight: normal!important;
    font-size: 14px;
}
.show-disabled input {
    filter: invert(1);
    position: relative;
    top: 2px;
}
</style>

<div class="rigs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'ip') ?>

    <?php //echo $form->field($model, 'port') ?>

    <?php //echo $form->field($model, 'mac') ?>

    <?php //echo $form->field($model, 'hostname') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php echo $form->field($model, 'status')->checkboxList([0 => 'show disabled'], ['class' => 'show-disabled pull-right container'])->label(false) ?>

    <?php // echo $form->field($model, 'allocation_id') ?>

    <?php // echo $form->field($model, 'model_id') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'dtime') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-success hidden search-rig']) ?>
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
