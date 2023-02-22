<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ManifestSearch $model */
/** @var yii\widgets\ActiveForm $form */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
}

?>

<div class="manifest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'manifest_id') ?>

    <?= $form->field($model, 'departure_date') ?>

    <?= $form->field($model, 'departure_time') ?>

    <?= $form->field($model, 'plate_number') ?>

    <?= $form->field($model, 'driver') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
