<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

$this->title = $model->item_id;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'item_id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'item_id' => $model->item_id], [
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
            'item_id',
            'item_name',
            'value',
            'sender_name',
            'sender_phone',
            'sender_subscription',
            'receiver_name',
            'receiver_phone',
            'receiver_id',
            'departure',
            'depature_date',
            'departure_time',
            'destination',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'manifest_id',
        ],
    ]) ?>

</div>
