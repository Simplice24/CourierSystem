<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Log $model */

if(Yii::$app->user->isGuest){
    return Yii::$app->getResponse()->redirect(['site/login']);
}

// $this->title = 'Update Log: ' . $model->log_id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->log_id, 'url' => ['view', 'log_id' => $model->log_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
