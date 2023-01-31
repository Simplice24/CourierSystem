<?php

use app\models\Log;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'log_id',
            'field_name',
            'old_value',
            'new_value',
            'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'item_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Log $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'log_id' => $model->log_id]);
                 }
            ],
        ],
    ]); ?>


</div>
