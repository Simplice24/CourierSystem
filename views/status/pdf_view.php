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
<h2>Statuses report</h2>
<table>
  <tr>
      <th>No </th>
      <th>Status name </th>
      <th>Status value</th>
      <th>Created by</th>
  </tr>
  <?php foreach ($dataProvider as $status): ?>
  <tr>
        <td><?= ++$no ?></td>
        <td><?= $status->status_name ?></td>
        <td><?= $status->status_value ?></td>
        <td><?= $status->created_by ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>