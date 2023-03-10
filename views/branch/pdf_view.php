<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
  <th >Branch ID</th>
  <th >Branch name</th>
  <th >Created By</th>
  
  </tr>
  <?php foreach($dataProvider->getModels() as $model) {?>
    <tr>
        <td><?= $model->branch_id?></td>
        <td><?= $model->branch_name?></td>
        <td><?= $model->created_by?></td>
</tr>

<?php } ?>
</table>
</div>