<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Manifest $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="manifest-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'manifest_id')->textInput() ?> -->

    <?= $form->field($model, 'departure_date')->textInput() ?>

    <?= $form->field($model, 'departure_time')->textInput() ?>

    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
