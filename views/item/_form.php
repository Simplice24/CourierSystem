<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Branch;

/** @var yii\web\View $this */
/** @var app\models\Item $model */
/** @var yii\widgets\ActiveForm $form */

if(Yii::$app->user->isGuest){
  return Yii::$app->getResponse()->redirect(['site/login']);
}

?>

<body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <!-- <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  
                </div> -->
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?= \Yii::$app->user->identity->username ;?></span>
                  <span class="text-secondary text-small"><?= Yii::$app->getUser()->identity->role; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Dashboard', ['/dashboard'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Branches', ['/branch'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Users', ['/user'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Customers', ['/customer'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Customers</span> -->
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Items', ['/item'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Items</span> -->
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Logs', ['/log'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Logs</span> -->
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li> -->

            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Manifests', ['/manifest'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Manifests</span> -->
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Status', ['/status'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Status</span> -->
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Subscriptions', ['/subscription'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Subscriptions</span> -->
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Types of subscription', ['/subscription-type'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <!-- <span class="menu-title">Types of subscription</span> -->
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>



            <!-- <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div>
              </span>
            </li> -->
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <div class="branch-index">


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
<?= $form->field($model, 'value')->input('number') ?>
</div>
                </div>
            </div>
            
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
<?= $form->field($model, 'sender_name')->input('string',['maxlength' => true]) ?>
</div>
                </div>
            </div>
            </div>

            <div class="row" style="height:90px;">
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
<?= $form->field($model, 'sender_phone')->input('number',['maxlength' => true]) ?>
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
<?= $form->field($model, 'receiver_phone')->input('number',['maxlength' => true]) ?>
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
                    <?= $form->field($model, 'departure')->DropDownList(
                        ArrayHelper::map(Branch::find()->all(),'branch_name','branch_name'),['prompt'=>'Select Departure']
                    ) ?>
</div>
                </div>
            </div>
            </div>

            <div class="row" style="height:90px;">
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
<?= $form->field($model, 'depature_date')->input('date') ?>
</div>
                </div>
            </div>

<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
<?= $form->field($model, 'departure_time')->input('time') ?>
</div>
                </div>
            </div>

<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'destination')->DropDownList(
                        ArrayHelper::map(Branch::find()->all(),'branch_name','branch_name'),['prompt'=>'Select Customer item']
                    ) ?>
</div>
                </div>
            </div>
</div>

<div class="row" style="height:90px;">
        
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
<?= $form->field($model, 'manifest_id')->textInput() ?>
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


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
  </body>

