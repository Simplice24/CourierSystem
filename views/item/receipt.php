<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
			background-color: #f7f7f7;
			margin: 0;
			padding: 0;
		}
		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 30px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
			border-radius: 5px;
			box-sizing: border-box;
		}
		h1 {
			margin-top: 0;
			font-size: 24px;
			font-weight: bold;
			color: #333;
			text-align: center;
		}
		h2 {
			font-size: 18px;
			font-weight: bold;
			color: #333;
			margin-top: 40px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}
		table td, table th {
			padding: 10px;
			border: 1px solid #ccc;
		}
		table th {
			background-color: #f7f7f7;
			font-weight: bold;
			text-align: left;
		}
		.total {
			font-size: 18px;
			font-weight: bold;
			color: #333;
			margin-top: 40px;
			text-align: right;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Item Receipt</h1>
		<h2>Order #12345</h2>
		<table>
			<thead>
				<tr>
					<th>Item name</th>
					<th>Value</th>
					<th>Sender</th>
					<th>Sender phone</th>
                    <th>subscription</th>
					<th>Departure</th>
					<th>Departure date</th>
					<th>Departure time</th>
                    <th>Destination</th>
					<th>Agent</th>
					<th>Received at</th>
				</tr>
			</thead>
			<tbody>
            <?php foreach ($itemdetails as $item): ?>
				<tr>
                <td><?= $item->item_name ?></td>
                <td><?= $item->value ?></td>
                <td><?= $item->sender_name ?></td>
                <td><?= $item->sender_phone ?></td>
                <td><?= $item->sender_subscription ?></td>
                <td><?= $item->sender_subscription ?></td>
                <td><?= $item->departure ?></td>
                <td><?= $item->depature_date ?></td>
                <td><?= $item->departure_time ?></td>
                <td><?= $item->destination ?></td>
                <td><?=  ?></td>
                <td><?= $item->created_at ?></td>
				</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
		<div class="total">
			Total: $25.00
		</div>
	</div>
</body>
</html>
