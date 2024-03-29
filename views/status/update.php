<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Status $model */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
  }

// $this->title = 'Update Status: ' . $model->status_id;
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->status_id, 'url' => ['view', 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userProfileImage'=>$userProfileImage,
    ]) ?>

</div>
