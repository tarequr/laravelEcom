<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <h1><b>Hey, {{$orderMail['c_name']}}</b>. Your Order placed successfully</h1>
    <strong>Order Id: {{ $orderMail['order_id'] }}</strong><br>
    <strong>Order Date: {{ date('d-M-Y',strtotime($orderMail['date'])) }}</strong><br>
    <strong>Total Amount: {{ $orderMail['total'] }}</strong><br><br>
    <strong>Name: {{ $orderMail['c_name'] }}</strong><br>
    <strong>Phone: {{ $orderMail['c_phone'] }}</strong><br>
    <strong>Address: {{ $orderMail['c_address'] }}</strong><br>
</body>
</html>
