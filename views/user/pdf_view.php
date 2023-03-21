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
<h2>Users report</h2>
<table>
  <tr>
      <th>Full name </th>
      <th>Username</th>
      <th>Role</th>
      <th>Email</th>
      <th>Telephone</th>
  </tr>
  <?php foreach ($users as $user): ?>
  <tr>
      <td><?= $user->user_fullname ?></td>
      <td><?= $user->username ?></td>
      <td><?= $user->role ?></td>
      <td><?= $user->email ?></td>
      <td><?= $user->telephone ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
</div>