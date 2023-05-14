<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.nav-link {
  font-size: 14px;
  text-decoration: none;
  font-weight: bold;
  color: #000000;
}
.menu-icon {
  font-size: 24px;
  margin-right: 8px;
}
.menu-title {
  display: inline-block;
}
</style> 
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
              <div class="nav-profile-image">
                  <img src="<?= Yii::getAlias('@web/' . $userProfileImage) ?>" alt="profile">
                  <span class="login-status online"></span>
              </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?= \Yii::$app->user->identity->username ;?></span>
                  <span class="text-secondary text-small"><?= Yii::$app->getUser()->identity->role; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['dashboard/index']) ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <?php if(\Yii::$app->user->can('View_branch')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['branch/index']) ?>">  
              <span class="menu-title">Branches</span>
              <i class="mdi mdi-bank menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_user')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['user/index']) ?>">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_customer')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['customer/index']) ?>">
                <span class="menu-title">Customers</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_item')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['item/index']) ?>">
                <span class="menu-title">Items</span>
                <i class="mdi mdi-archive menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <!-- <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['documents/index']) ?>">
                <span class="menu-title">Documents</span>
                <i class="mdi mdi-book menu-icon"></i>
              </a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['invoice/index']) ?>">
                <span class="menu-title">Invoices</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <?php if(\Yii::$app->user->can('View_log')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['log/index']) ?>">
                <span class="menu-title">Logs</span>
                <i class="mdi mdi-animation menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_manifest')) {?>    
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['manifest/index']) ?>">
                <span class="menu-title">Manifests</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_status')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['status/index']) ?>">
                <span class="menu-title">Status</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_subscription')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['subscription/index']) ?>">
                <span class="menu-title">Subscriptions</span>
                <i class="mdi mdi-comment-check menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <?php if(\Yii::$app->user->can('View_subscriptionTypes')) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['subscription-type/index']) ?>">
                <span class="menu-title">Subscription types</span>
                <i class="mdi mdi-apps menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-settings menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['profile/index']) ?>"> Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['user-signatures/index']) ?>"> Signature </a></li>
                </ul>
              </div>
            </li>
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
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Branches <i class="mdi mdi-bank mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $branches ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">System users <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $users ; ?></h2>
                    <!-- <h6 class="card-text">Decreased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Customers <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $customers ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-secondary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Items <i class="mdi mdi-archive mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $items ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Logs <i class="mdi mdi-animation mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $logs ; ?></h2>
                    <!-- <h6 class="card-text">Decreased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-dark card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Manifests <i class="mdi mdi-contacts mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $manifests ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Status <i class="mdi mdi-format-list-bulleted mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $status ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Subscriptions <i class="mdi mdi-comment-check  mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $subscriptions ; ?></h2>
                    <!-- <h6 class="card-text">Decreased by </h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Types of subscriptions <i class="mdi mdi-apps mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?= $subscriptiontypes ; ?></h2>
                    <!-- <h6 class="card-text">Increased by </h6> -->
                  </div>
                </div>
              </div>
            </div>
        </div>
  </body>
 


