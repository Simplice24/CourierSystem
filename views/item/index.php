<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'item_id',
            'item_name',
            // 'value',
            'sender_name',
            'sender_phone',
            //'sender_subscription',
            'receiver_name',
            'receiver_phone',
            //'receiver_id',
            //'departure',
            //'depature_date',
            //'departure_time',
            //'destination',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'manifest_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Item $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'item_id' => $model->item_id]);
                 }
            ],
        ],
    ]); ?>


</div>
