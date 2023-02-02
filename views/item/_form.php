<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">

                    <div class="row" style="height:90px;">
                        <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'value')->textInput() ?>
    </div>
                    </div>
                </div>
                
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'sender_name')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
                </div>

                <div class="row" style="height:90px;">
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'sender_phone')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'sender_subscription')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
                </div>

                <div class="row" style="height:90px;">
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'receiver_phone')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'receiver_id')->textInput() ?>
    </div>
                </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'departure')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
                </div>

                <div class="row" style="height:90px;">
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'depature_date')->textInput() ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'departure_time')->textInput() ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>
</div>

<div class="row" style="height:90px;">
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>

    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
    </div>
                    </div>
                </div>


                
    <div class="col-md-4">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'manifest_id')->textInput() ?>
    </div>
                    </div>
                </div>
</div>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>


    </form>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
