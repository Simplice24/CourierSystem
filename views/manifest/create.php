<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Manifest $model */

// $this->title = 'Create Manifest';
$this->params['breadcrumbs'][] = ['label' => 'Manifests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manifest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
