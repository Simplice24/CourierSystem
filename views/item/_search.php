<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'sender_name') ?>

    <?= $form->field($model, 'sender_phone') ?>

    <?php // echo $form->field($model, 'sender_subscription') ?>

    <?php // echo $form->field($model, 'receiver_name') ?>

    <?php // echo $form->field($model, 'receiver_phone') ?>

    <?php // echo $form->field($model, 'receiver_id') ?>

    <?php // echo $form->field($model, 'departure') ?>

    <?php // echo $form->field($model, 'depature_date') ?>

    <?php // echo $form->field($model, 'departure_time') ?>

    <?php // echo $form->field($model, 'destination') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'manifest_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
