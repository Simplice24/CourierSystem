<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Log $model */

$this->title = $model->log_id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'log_id' => $model->log_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'log_id' => $model->log_id], [
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
            'log_id',
            'field_name',
            'old_value',
            'new_value',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'item_id',
        ],
    ]) ?>

</div>
