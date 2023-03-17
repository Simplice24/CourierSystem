<?php
use yii\helpers\Html;

$this->title = 'Report Generator';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Please enter the starting and ending dates to generate the report:</p>

<?= Html::beginForm(['report/generate'], 'post') ?>

    <div class="form-group">
        <?= Html::label('Start Date', 'start_date') ?>
        <?= Html::textInput('start_date', null, ['class' => 'form-control', 'required' => true]) ?>
    </div>

    <div class="form-group">
        <?= Html::label('End Date', 'end_date') ?>
        <?= Html::textInput('end_date', null, ['class' => 'form-control', 'required' => true]) ?>
    </div>

    <?= Html::submitButton('Generate Report', ['class' => 'btn btn-primary']) ?>

<?= Html::endForm() ?>

