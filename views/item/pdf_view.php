<?php


use yii\helpers\Html;
use yii\grid\GridView;

$this->title='pdf view';
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="container">
<h2><?= Html::encode($this->title)?></h2>

<table id="item">
    <tr>
    <th>Item name</th>
    <th>Sender name</th>
    <th>Receiver name</th>
    </tr>

<?php foreach($dataProvider->getModels() as $model) {?>

<tr>
    
<th><?= $model->item_name?></th>
<th><?= $model->sender_name?></th>
<th><?= $model->receiver_name?></th>

</tr>
<?php }?>
</table>
</div>