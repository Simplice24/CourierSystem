<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

$this->title = $model->invoice_id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
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


                      <div class="invoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'invoice_id' => $model->invoice_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'invoice_id' => $model->invoice_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add items', ['invoice-items/create', 'invoice_id' => $model->invoice_id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'invoice_id',
            'customer_name',
            'invoice_date',
            'amount_due',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
  </body>

