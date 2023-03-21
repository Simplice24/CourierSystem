<?php

use yii\helpers\Html;
use yii\grid\GridView;

if(Yii::$app->user->isGuest){
  return Yii::$app->getResponse()->redirect(['site/login']);
}

$this->title ='Items';
$this->params['breadcrumbs'][]= $this->title;
?>

<div class="container">
<h2><?= Html::encode($this->title)?></h2>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}


#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color:black;
  color: white;
}
</style>
<!-- <table class="table" id="customers">
    <thead>
<tr>
  <th scope="col">Item Name</th>
  <th scope="col">Sender</th>
  <th scope="col">Receiver</th>
  <th scope="col">Receiver phone</th>
  <th scope="col">Receiver ID</th>
  <th scope="col">Departure</th>
  <th scope="col">Destination</th>
</tr> 
</thead>
<?php foreach($dataProvider->getModels() as $model) {?>
    <tr>
        <th><?= $model->item_name?></th>
        <th><?= $model->sender_name?></th>
        <th><?= $model->receiver_name?></th>
        <th><?= $model->receiver_phone?></th>
        <th><?= $model->receiver_id?></th>
        <th><?= $model->departure?></th>
        <th><?= $model->destination?></th>
</tr>

<?php } ?>
</table> -->
<table id="customers">
  <tr>
  <th >Item Name</th>
  <th >Sender</th>
  <th >Receiver</th>
  <th >Receiver phone</th>
  <th >Receiver ID</th>
  <th >Departure</th>
  <th >Destination</th>
  </tr>
  <?php foreach($dataProvider->getModels() as $model) {?>
    <tr>
        <td><?= $model->item_name?></td>
        <td><?= $model->sender_name?></td>
        <td><?= $model->receiver_name?></td>
        <td><?= $model->receiver_phone?></td>
        <td><?= $model->receiver_id?></td>
        <td><?= $model->departure?></td>
        <td><?= $model->destination?></td>
</tr>

<?php } ?>
</table>
</div>