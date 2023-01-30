<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Log $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'log_id')->textInput() ?>

    <?= $form->field($model, 'field_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
