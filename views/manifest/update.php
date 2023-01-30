<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Manifest $model */

$this->title = 'Update Manifest: ' . $model->manifest_id;
$this->params['breadcrumbs'][] = ['label' => 'Manifests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->manifest_id, 'url' => ['view', 'manifest_id' => $model->manifest_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manifest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
