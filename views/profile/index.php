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
                </span> Dashboard/Profile
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="profile-pic" class="cursor-pointer">
                            <img src="<?= Yii::getAlias('@web/' . $userProfileImage) ?>" alt="User Profile Picture" class="img-fluid rounded-circle">
                        </label>
                    </div>
                    <div class="col-md-8">
                        <form  method="post" action="<?= Yii::$app->urlManager->createUrl(['profile/username']) ?>">
                        <?php
                            $csrf = Yii::$app->request->csrfToken;
                            echo "<input type='hidden' name='_csrf' value='$csrf'>";
                        ?>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control mr-2" id="username-field" value="<?= $user_name ?>" readonly>
                                <button type="button" class="btn btn-primary" id="change-username-btn">Change</button>
                            </div>
                        </div>
                        <div class="form-group" id="new-username-fields" style="display:none">
                            <label for="new-username-field">New Username:</label>
                            <input type="text" class="form-control" name="new-username" id="new-username-field"><br>
                            <label for="password-field">Password:</label>
                            <input type="password" class="form-control" name="password" id="password-field">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" id="submit-btn" style="display:none">Save</button>
                        </form>
                        <br>
                        <form id="profile-pic-form" style="display:none;" action="<?= Yii::$app->urlManager->createUrl(['profile/image']) ?>" method="post" enctype="multipart/form-data">
                            <?php
                                $csrf = Yii::$app->request->csrfToken;
                                echo "<input type='hidden' name='_csrf' value='$csrf'>";
                            ?>
                            <div class="form-group">
                                <input type="file" class="btn btn-gradient-primary" id="profile-pic" name="profile-pic" >
                            </div>
                            <button type="submit" class="btn btn-primary">Change profile</button>
                        </form><br>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="change-password-btn">Change Password</button>
                        </div>
                        <form method="post" action="<?= Yii::$app->urlManager->createUrl(['profile/password']) ?>">
                        <?php
                            $csrf = Yii::$app->request->csrfToken;
                            echo "<input type='hidden' name='_csrf' value='$csrf'>";
                        ?>
                        <div class="form-group" id="new-password-fields" style="display:none">
                            <label for="current-password-field">Current Password:</label>
                            <input type="password" class="form-control" name="current-password" id="current-password-field"><br>
                            <label for="new-password-field">New Password:</label>
                            <input type="password" class="form-control" name="new-password" id="new-password-field"><br>
                            <label for="confirm-password-field">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirm-password" id="confirm-password-field">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" id="submit-password" style="display:none">Save</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const changeUsernameBtn = document.getElementById("change-username-btn");
            const newUsernameFields = document.getElementById("new-username-fields");
            const submitBtn = document.getElementById("submit-btn");

            changeUsernameBtn.addEventListener("click", () => {
                newUsernameFields.style.display = "block";
                submitBtn.style.display = "block";
                changeUsernameBtn.style.display = "none";
            });
            const changePasswordBtn = document.getElementById("change-password-btn");
            const newPasswordFields = document.getElementById("new-password-fields");
            const savePasswordBtn = document.getElementById("submit-password");
                changePasswordBtn.addEventListener("click", () => {
                newPasswordFields.style.display = "block";
                changePasswordBtn.style.display = "none";
                savePasswordBtn.style.display = "block";
            });
            const profilePicLabel = document.querySelector('.cursor-pointer');
                const profilePicForm = document.querySelector('#profile-pic-form');

                profilePicLabel.addEventListener('click', () => {
                profilePicForm.style.display = 'block';
            });

        </script>
  </body>
 


