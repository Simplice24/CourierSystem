<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Item;

/** @var yii\web\View $this */
/** @var app\models\Log $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <form class="forms-sample">

            <div class="row" style="height:90px;">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'field_name')->textInput(['maxlength' => true]) ?>
        </div>
     </div>
   </div> 

   <div class="col-md-6">
            <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'old_value')->textInput(['maxlength' => true]) ?>
                        </div>
            </div>
        </div>
    </div>

<div class="row" style="height:90px;">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'new_value')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="row" style="height:90px;">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="form-group">
    <?= $form->field($model, 'item_id')->DropDownList(
                   ArrayHelper::map(Item::find()->all(),'item_id','item_name'),['prompt'=>'Select item']
    ) ?>
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
