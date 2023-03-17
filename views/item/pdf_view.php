<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title ='Items';
$this->params['breadcrumbs'][]= $this->title;
?>

<div class="container">
<h2><?= Html::encode($this->title)?></h2>
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>
                    <table class="table table-striped">
                      <thead>
                        <tr>
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
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach($dataProvider->getModels() as $item) {?>
                          <tr>
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

<?php } ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>