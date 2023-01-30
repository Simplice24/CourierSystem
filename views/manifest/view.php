<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Manifest $model */

$this->title = $model->manifest_id;
$this->params['breadcrumbs'][] = ['label' => 'Manifests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manifest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'manifest_id' => $model->manifest_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'manifest_id' => $model->manifest_id], [
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
            'manifest_id',
            'departure_date',
            'departure_time',
            'plate_number',
            'driver',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
