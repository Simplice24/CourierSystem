<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
}

// $this->title = 'Update Customer: ' . $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_id, 'url' => ['view', 'customer_id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
