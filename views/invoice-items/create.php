<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\InvoiceItems $model */

$this->title = 'Create Invoice Items';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'invoice_id' => $model->invoice_id,
        'userProfileImage' => $userProfileImage,
    ]) ?>

</div>
