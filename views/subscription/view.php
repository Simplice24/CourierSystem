<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Subscription $model */

$this->title = $model->subscription_id;
$this->params['breadcrumbs'][] = ['label' => 'Subscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subscription-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'subscription_id' => $model->subscription_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'subscription_id' => $model->subscription_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subscription_id',
            'subscription_type',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'customer_id',
        ],
    ]) ?>

</div>
