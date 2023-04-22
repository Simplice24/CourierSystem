<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\InvoiceItems $model */

$this->title = 'Update Invoice Items: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
