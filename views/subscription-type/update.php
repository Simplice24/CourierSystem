<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubscriptionType $model */

$this->title = 'Update Subscription Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subscription Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subscription-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
