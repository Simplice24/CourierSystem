<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubscriptionType $model */
if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
  }

// $this->title = 'Create Subscription Type';
$this->params['breadcrumbs'][] = ['label' => 'Subscription Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
