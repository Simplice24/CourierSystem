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
<h2>Subscriptions report</h2>
<table>
  <tr>
      <th>Customer </th>
      <th>Subscription </th>
      <th>Amount </th>
      <th>Created by </th>
  </tr>
  <?php foreach ($dataProvider as $sub): ?>
  <tr>
      <td><?= $sub->customer ?></td>
      <td><?= $sub->subscription_type ?></td>
      <td><?= $sub->amount ?></td>
      <td><?= $sub->created_by ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>