<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserSignatures $model */

// $this->title = 'Update User Signatures: ' . $model->signature_id;
$this->params['breadcrumbs'][] = ['label' => 'User Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->signature_id, 'url' => ['view', 'signature_id' => $model->signature_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-signatures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userProfileImage' => $userProfileImage,
    ]) ?>

</div>
