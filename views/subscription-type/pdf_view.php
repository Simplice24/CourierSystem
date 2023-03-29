<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title ='Items report';
$this->params['breadcrumbs'][]= $this->title;
?>

<div class="container">
<h2><?= Html::encode($this->title)?></h2>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<h2>Subscription type report</h2>
<table>
  <tr>
      <th>No </th>
      <th>Subscription name </th>
      <th>Amount </th>
  </tr>
  <?php foreach ($dataProvider as $sub): ?>
  <tr>
      <td><?= ++$no ?></td>
      <td><?= $sub->name ?></td>
      <td><?= $sub->amount ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>