<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

$this->title = 'Update Invoice: ' . $model->invoice_id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoice_id, 'url' => ['view', 'invoice_id' => $model->invoice_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userProfileImage' => $userProfileImage,
    ]) ?>

</div>
