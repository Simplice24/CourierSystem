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
<h2>Items report</h2>
<table>
  <tr>
      <th>No </th>
      <th>Item </th>
      <th>Value</th>
      <th>Sender</th>
      <th>Sender's phone</th>
      <th>Sender's subscription</th>
      <th>Receiver</th>
      <th>Receiver's phone</th>
      <th>Receiver ID No</th>
      <th>Departure</th>
      <th>Departure date</th>
      <th>Departure time</th>
      <th>Destination</th>
  </tr>
  <?php foreach ($dataProvider as $item): ?>
  <tr>
      <td><?= ++$no ?></td>
      <td><?= $item->item_name ?></td>
      <td><?= $item->value ?></td>
      <td><?= $item->sender_name ?></td>
      <td><?= $item->sender_phone ?></td>
      <td><?= $item->sender_subscription ?></td>
      <td><?= $item->receiver_name ?></td>
      <td><?= $item->receiver_phone ?></td>
      <td><?= $item->receiver_id ?></td>
      <td><?= $item->departure ?></td>
      <td><?= $item->depature_date ?></td>
      <td><?= $item->departure_time ?></td>
      <td><?= $item->destination ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>