<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Status $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="status-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">
                    <div class="form-group">
    <?= $form->field($model, 'status_value')->textInput() ?>
</div>

                    <div class="form-group">
    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
</div>

                    <div class="form-group">
    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
</div>
                    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-gradient-primary me-2']) ?>
</div>

    </form>
                  </div>
                </div>
              </div>

    <?php ActiveForm::end(); ?>

</div>
