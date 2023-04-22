<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\InvoiceItemsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="invoice-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'invoice_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'sender_name') ?>

    <?php // echo $form->field($model, 'receiver_name') ?>

    <?php // echo $form->field($model, 'item_value') ?>

    <?php // echo $form->field($model, 'departure') ?>

    <?php // echo $form->field($model, 'destination') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
