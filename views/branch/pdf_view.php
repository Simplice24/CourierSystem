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
<h2>Branches report</h2>
<table>
  <tr>
      <th>Branch ID</th>
      <th>Branch name</th>
      <th>Created by</th>
      <th>Created at</th>
  </tr>
  <?php foreach ($dataProvider->getModels() as $branch): ?>
  <tr>
      <td><?= $branch->branch_id ?></td>
      <td><?= $branch->branch_name ?></td>
      <td><?= $branch->created_by ?></td>
      <td><?= $branch->created_at ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>