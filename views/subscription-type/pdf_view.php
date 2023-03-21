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
<table id="customers">
  <tr>
  <th ></th>
  <th ></th>
  <th ></th>
  <th ></th>
  <th ></th>
  </tr>
  <?php foreach($dataProvider as $subtype) {?>
    <tr>
        <td><?= $subtype->name ?></td>
        <td><?= $subtype->amount ?></td>
        <td><?= $subtype->payment_way ?></td>
        <td><?= $subtype->created_by ?></td>
        <td><?= $subtype->created_at ?></td>
</tr>
<?php } ?>
</table>
</div>