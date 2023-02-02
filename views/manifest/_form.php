<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Manifest $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="manifest-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">

                    <div class="row" style="height:90px;">
                        <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'departure_date')->textInput() ?>
    </div>
                    </div>
                </div>

                <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'departure_time')->textInput() ?>
    </div>
                    </div>
                </div>
</div>

<div class="row" style="height:90px;">
                        <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

                <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
</div>

<div class="row" style="height:90px;">
                        <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

                <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-gradient-primary me-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
