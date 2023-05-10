<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        body{
background:#eee;
margin-top:10px;
}
.text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
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
    <?php
    $branch = \app\models\Branch::findOne(Yii::$app->user->identity->branche_id);
    ?>
<div class="col-md-12">   
 <div class="row">
		
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
    			<div class="receipt-header">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="receipt-left">
							<!-- <img class="img-responsive" alt="iamgurdeeposahan" src="" style="width: 71px; border-radius: 43px;"> -->
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 text-right">
						<div class="receipt-right">
							<h5>LAP Ltd</h5>
							<p> 0785495363 <i class="fa fa-phone"></i></p>
							<p>www.lapafrica.com <i class="fa fa-envelope-o"></i></p>
							<p>Kicukiro,Gatenga, Hyundai Building<i class="fa fa-location-arrow"></i></p>
						</div>
					</div>
				</div>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h5> Billed To: </h5>
                            <p> <b><?= $customer->customer_name ?></b> </p>
							<p> <?= date('Y-m-d') ?> </p>
						</div>
					</div>
				</div>
            </div>	

			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h5> Payment Method: </h5>
                            <p> <b>MoMo Pay: *182*8*1*------#</b> </p>
							<p> <b></b> </p>
						</div>
					</div>
				</div>
            </div>
            <div>
			<div><b>Invoice items</b></div>
			<table>		
  <tr>
      <th>Item name</th>
      <th>Value</th>
      <th>Sender</th>
	  <th>Amount</th>
  </tr>
  <?php foreach ($invoiceItems as $item): ?>
  <tr>
      <td><?= $item->item_name ?></td>
      <td><?= $item->item_value ?></td>
      <td><?= $item->sender_name ?></td>
      <td>-</td>
  </tr>
  <?php endforeach; ?>
</table>
            </div>
			<div class="row">
				<div class="col-6"><b>Total</b></div>
				<div class="col-6 text-right"><?= $customer->amount_due ?> Frw</div>
			</div>

			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
						    <p><b>Invoice number :</b><?= $invoice_id ?></p>
                            <p><b>Invoice printed by :</b><?= Yii::$app->user->identity->username ?></p>
							<p><b>Printed at :</b><?= date('Y-m-d H:i:s') ?></p>
							<h5 style="color: rgb(140, 140, 140);">Thanks for working with us!</h5>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h1>Stamp</h1>
						</div>
					</div>
				</div>
            </div>
			
        </div>    
	</div>
</div>
</body>
</html>