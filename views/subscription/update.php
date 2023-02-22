<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Subscription $model */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
}

// $this->title = 'Update Subscription: ' . $model->subscription_id;
$this->params['breadcrumbs'][] = ['label' => 'Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subscription_id, 'url' => ['view', 'subscription_id' => $model->subscription_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subscription-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
