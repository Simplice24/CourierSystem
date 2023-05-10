<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

if(Yii::$app->user->isGuest){
  return Yii::$app->getResponse()->redirect(['site/login']);
}

// $this->title = $model->item_id;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                  <li class="nav-item"> <a class="nav-link" href=""> Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['signature/index']) ?>"> Signature </a></li>
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
                </span> Dashboard/Reports
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


                      <div class="item-view">

<h1><?= Html::encode($this->title) ?></h1>

<div class="col-lg-6 grid-margin stretch-card">
<?php if (isset($message)): ?>
    <div class="alert alert-warning" role="alert">
        <?= $message ?>
    </div>
<?php else: ?>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Report of Items</h4>
                    <?= Html::a('Export PDF report', ['pdf', 'dataProvider' => urlencode(serialize($dataProvider))], ['class' => 'btn btn-info']) ?>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Done By </th>
                          <th>Comment </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($dataProvider as $log): ?>
                        <tr>
                         <td><?= ++$no ?></td>
                         <td><?= $log->done_by ?></td>
                         <td><?= $log->comment ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php endif; ?>
              </div>
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </body>

