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
<h2>Customers report</h2>
<table>
  <tr>
      <th>No</th>
      <th>Customer name </th>
      <th>Subscriptions type</th>
      <th>Customer's ID</th>
      <th>Phone number</th>
  </tr>
  <?php foreach ($customers as $customer): ?>
  <tr>
      <td><?= ++$no ?></td>
      <td><?= $customer->fullname ?></td>
      <td><?= $customer->subscription ?></td>
      <td><?= $customer->idn ?></td>
      <td><?= $customer->telephone ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>