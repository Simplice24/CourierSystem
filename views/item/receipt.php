<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>

    <style>
        body{
background:#eee;
margin-top:20px;
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
			<?php foreach ($items as $item): ?>
			<div class="row">
				<div class="receipt-header receipt-header-mid">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<h5> Client's information </h5>
                            <p><b>Sender's name :</b> <?= $item->sender_name ?> </p>
							<p><b>Mobile :</b> <?= $item->sender_phone ?> </p>
                            <p><b>Sender's subscription :</b> <?= $item->sender_subscription ?> </p>
						</div>
					</div>
				</div>
            </div>	
            <div>
                <table class="table table-bordered">
                
                        <tr>
                        <th>Item details</th>  
                        </tr>
                        <tr>
                            <td class="col-md-9">Item name</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->item_name ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Value</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->value ?> Frw</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Departure </td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->departure ?> </td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Departure date</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->depature_date ?> </td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Departure time</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->departure_time ?> </td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Destination</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?= $item->destination ?> </td>
                        </tr>
                    
                </table>
            </div>
			
			<div class="row">
				<div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
                            <p><b>Item received by :</b><?= Yii::$app->user->identity->username ?></p>
							<p><b>Printed :</b><?= date('Y-m-d H:i:s') ?></p>
							<br>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<img src="<?= $signatureImagePath ?>" alt="Signature" style="max-width: 100px; max-height: 100px;">
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
						<div class="receipt-left">
							<h1>Stamp</h1>
						</div>
					</div>
				</div>
            </div>
			<?php endforeach; ?>
        </div>    
	</div>
</div>
</body>
</html>