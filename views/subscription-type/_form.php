<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Subscription;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\SubscriptionType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subscription-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">
                    <div class="form-group">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group">
    <?= $form->field($model, 'payment_way')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group">
    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group">
    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
    </div>
<div class="form-group">
    <?= $form->field($model, 'subscription_id')->DropDownList(
        ArrayHelper::map(Subscription::find()->all(),'subscription_id','subscription_name'),['prompt'=>'Select subscription']
    ) ?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-gradient-primary me-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
