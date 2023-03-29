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
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Report of Items</h4>
                    <?= Html::a('Export PDF report', ['pdf', 'dataProvider' => urlencode(serialize($dataProvider))], ['class' => 'btn btn-info']) ?>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No </th>
                          <th>Customer </th>
                          <th>Subscription type </th>
                          <th>Amount </th>
                          <th>Created by </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($dataProvider as $subscription): ?>
                        <tr>
                         <td><?= ++$no ?></td>
                         <td><?= $subscription->customer ?></td>
                         <td><?= $subscription->subscription_type ?></td>
                         <td><?= $subscription->amount ?></td>
                         <td><?= $subscription->created_by ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </body>

