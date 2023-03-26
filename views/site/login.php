<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>


   

    <div class="body-content">
    <!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solid Template</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/style.css">
	<script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
   
<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

          <div class="row flex-grow"> 
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-light text-left p-5">
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Log in to continue.</h6>
                <form class="pt-3">
                  <div class="form-group">
                  <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'form-control form-control-lg','placeholder'=>'Username']) ?>
                  </div>
                  <div class="form-group">
                  <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'class'=>'form-control form-control-lg','placeholder'=>'Password']) ?>
                  </div>
                  <div class="mt-3">
                    <?= Html::submitButton('LOG IN', ['class' => 'btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn', 'name' => 'login-button']) ?>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                     
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>

    <?php ActiveForm::end(); ?>

    <script src="dist/js/main.min.js"></script>
</body>
</html>

    </div>
</div>


