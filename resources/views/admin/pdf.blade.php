<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order PDF Butter Mart</title>
</head>
<body>
    <h1>Order Details</h1>
    Nama    :<h3>{{$order->name}}</h3>
    Email   :<h3>{{$order->email}}</h3>
    No. HP  :<h3>{{$order->phone}}</h3>
    Alamat  :<h3>{{$order->address}}</h3>
    ID      :<h3>{{$order->user_id}}</h3>

    Produk      :<h3>{{$order->product_title}}</h3>
    Harga       :<h3>{{$order->price}}</h3>
    Kuantitas   :<h3>{{$order->quantity}}</h3>
    Status Bayar:<h3>{{$order->payment_status}}</h3>
    ID Produk   :<h3>{{$order->product_id}}</h3>
    <br><br>
    <img width="150px" src="product/{{$order->image}}" alt="">
</body>
</html>