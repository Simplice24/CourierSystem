<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserSiganturesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-signatures-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'signature_id') ?>

    <?= $form->field($model, 'signature_name') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'signature_image') ?>

    <?= $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
