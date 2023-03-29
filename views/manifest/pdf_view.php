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
<h2>Manifestation report</h2>
<table>
  <tr> 
      <th>No </th>
      <th>Departure date </th>
      <th>Departure time</th>
      <th>Driver</th>
      <th>Plate number</th>
  </tr>
  <?php foreach ($manifests as $manifest): ?>
  <tr>
      <td><?= ++$no ?></td>
      <td><?= $manifest->departure_date ?></td>
      <td><?= $manifest->departure_time ?></td>
      <td><?= $manifest->driver ?></td>
      <td><?= $manifest->plate_number ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>