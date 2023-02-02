<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Branch;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample">
                    <div class="row" style="height:90px;">
                        <div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'user_fullname')->textInput(['maxlength' => true]) ?>
</div>
</div>
</div>
<div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'role')->DropDownList(["ADMIN"=>"Admin","BRANCH-MANAGER"=>"Branch manager","BRANCH-AGENT"=>"Agent"],["prompt"=>"Select user's Role"]) ?>
    </div>
</div>
</div>
</div>
<div class="row" style="height:90px;">
<div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    </div>
</div>
</div>
<div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    </div>
</div>
</div>
</div>
<div class="row" style="height:90px;">
<div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    </div>
</div>
</div>
<div class="col-md-6">
                          <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'branch_id')->DropDownList(
        ArrayHelper::map(Branch::find()->all(),'branch_id','branch_name'),["prompt"=>"Select Branch"]
    ) ?>
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
    </form>
                  </div>
                </div>
              </div>

    <?php ActiveForm::end(); ?>

</div>
