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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_way')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscription_id')->DropDownList(
        ArrayHelper::map(Subscription::find()->all(),'subscription_id','subscription_name'),['prompt'=>'Select subscription']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
