<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="/images/favicon.png" type="">
      <title>Butter Mart</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <!-- icon -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   </head>

   <style>
    .center {
        margin: auto;
        width: 65%;
        text-align: center;
        padding: 30px;
        padding-bottom: 50px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 50px;
    }

    th {
        background-color: #f2f2f2;
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 18px;
        border: 1px solid grey;
        text-align: center;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        border: 1px solid grey;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .mx-auto {
        position:fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 15px 0;
        z-index: 100;
    }

   </style>

   <body>
      <div>
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div class="center">
            <table>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Status Bayar</th>
                    <th>Status Kirim</th>
                    <th>Gambar</th>
                    <!--<th>Batalkan Pesanan</th>-->
                </tr>

                @if($order->isEmpty()) 
                    <tr>
                        <td colspan="7">Belum Ada Pesanan</td>
                    </tr>
                @else 

                @foreach($order as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img style="width: 55px;" src="product/{{$order->image}}" alt="">
                    </td>

                    <!--<td>
                        @if($order->delivery_status=='processing')
                        <a onclick="return confirm ('Yakin membatalkan pesanan ini?')" class="btn btn-danger" href="{{ url('cancel_order', $order->id) }}">Batalkan</a>
            
                        @else
                        <p>-</p>

                        @endif
                    </td>-->

                </tr>
                @endforeach

                @endif

            </table>
        </div>
         

      <div>
         <p class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a>         
         </p>
      </div>
      
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
