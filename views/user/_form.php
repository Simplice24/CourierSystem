<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AuthItem;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var app\models\User $model */
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
            <?php if(\Yii::$app->user->can('View_branch')) {?>
            <li class="nav-item">
              <a class="nav-link">  
              <?= Html::a('Branches', ['/branch'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
              <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_user')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Users', ['/user'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_customer')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Customers', ['/customer'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_item')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Items', ['/item'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Invoice', ['/invoice'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <?php if(\Yii::$app->user->can('View_log')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Logs', ['/log'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_manifest')) {?>    
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Manifests', ['/manifest'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_status')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Status', ['/status'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_subscription')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Subscriptions', ['/subscription'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_subscriptionTypes')) {?>
            <li class="nav-item">
              <a class="nav-link">
              <?= Html::a('Types of subscription', ['/subscription-type'], ['class'=>'menu-title','style'=>'text-decoration:none; font-weight:bold;']) ?>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <?php } ?>
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
                        
                    <div class="user-form">
 
                    <?php $form = ActiveForm::begin(); ?>

<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="forms-sample">

                <div class="row" style="height:90px;">
                    <div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'user_fullname')->textInput(['maxlength' => true]) ?>
</div>
                </div>
            </div>

<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
</div>
                </div>
            </div>
            
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'role')->DropDownList(['ADMIN'=>'ADMIN','Branch_manager'=>'BRANCH MANAGER','Branch_agent'=>'BRANCH AGENT'],['prompt'=>'Select user role'])?>
</div>
                </div>
            </div>
            </div>

            <div class="row" style="height:90px;">
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
</div>
                </div>
            </div>

<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
</div>
                </div>
            </div>

<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'telephone')->input('number',['maxlength' => true]) ?>
</div>
                </div>
            </div>
            </div>

            <div class="row" style="height:90px;">
<div class="col-md-4">
                      <div class="form-group row">
                    <div class="form-group">
                    <?= $form->field($model, 'branche_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \app\models\Branch::find()->all(),
            'branch_id',
            'branch_name'
        ),
        ['prompt'=>'Select branch']
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

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
  </body>


  