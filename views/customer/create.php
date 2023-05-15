<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
}

// $this->title = 'Create Customer';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userProfileImage' => $userProfileImage,
    ]) ?>

</div>
