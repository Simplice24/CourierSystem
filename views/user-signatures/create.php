<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserSignatures $model */

// $this->title = 'Create User Signatures';
$this->params['breadcrumbs'][] = ['label' => 'User Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-signatures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userProfileImage' => $userProfileImage,
    ]) ?>

</div>
