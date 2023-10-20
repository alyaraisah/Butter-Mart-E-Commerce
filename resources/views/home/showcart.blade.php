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

    <style type="text/css">

        .center {
            margin: auto;
            width: 60%;
            text-align: center;
            padding: 30px;
            padding-bottom: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
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

        td.action {
            color: red;
            cursor: pointer;
            
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .cart-actions span  {
            font-size:18px; 
            font-weight: bold;

        }

        .quantity-container {
            display: flex;
            align-items: center; 
            justify-content: center;
        }

        .quantity-input {
            width: 70px; 
            height: 30px;
            margin-right: 10px; 
            margin-top: 20px;  
        }

        .btn.cart {
            background-color: #2E68A2;
            border: 1px solid #F3C06B;
            height: 30px;
            display: flex; 
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .btn.btn-primary.cart:hover {
            background-color: #F3C06B;
            border: 1px solid #2E68A2;
            color: #2E68A2;
        }

        .btn.btn-danger.cart {
            background-color: red;
            border: 1px solid #F3C06B;
            height: 30px;
            display: flex; 
            align-items: center;
            justify-content: center;
            font-size: 15px;
            width: 70px;
            margin: auto;
        }

        .btn.btn-danger.cart:hover {
            background-color: #ca150c;
            border: 1px solid white;
            color: white;
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

        .content-footer {
            padding-bottom: 50px; 
        }

        .order-button {
            margin-top: 25px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #DC3545; 
            color: #fff; 
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .order-button:hover {
            background-color: #C82333; 
        }

        .view-order-button {
            margin-top: 25px;
            margin-left: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #007BFF; 
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease; 
        }

        .view-order-button:hover {
            background-color: #0056b3; 
        }
    </style>

   <body>
    
      <div>
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>
        @endif

            <div class="center">
                <table class="cart-table">
      
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kuantitas</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Hapus</th>
                    </tr>
                
                    <?php $totalprice = 0; ?>
                    <?php $totalproduct=0;  ?>
                        
                    @if($cart->isEmpty()) 
                        <tr>
                            <td colspan="5">Keranjang Mu Kosong</td>
                        </tr>
                    @else 

                    @foreach($cart as $cart)
                        <tr>
                            <td>{{$cart->product_title}}</td>
                            <td>
                                <form action="{{ route('update_cart', $cart->id) }}" method="POST">
                                    @csrf
                                    <div class="quantity-container">
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="quantity-input">
                                        <button type="submit" class="btn btn-primary cart">Perbarui</button>
                                    </div>
                                </form>
                            </td>
                            <td>Rp{{$cart->price}}</td>
                            <td style="width: 55px;"><img src="/product/{{$cart->image}}"></td>
                            <td>
                                <a class="btn btn-danger cart" onclick="return confirm('Yakin ingin menghapus produk ini?')" href="{{url('/remove_cart',$cart->id)}}">Hapus</a>
                            </td>
                        </tr>

                    <?php $totalproduct++; ?>
                    <?php $totalprice += $cart->price; ?> <!-- Update total price here -->
                    
                    @endforeach

                        
                    @endif

                </table>

                <div class="cart-actions">
                    <span>Harga Total: Rp{{$totalprice}}</span><br>
                </div>


                <div class="button-container">
                    <!--<h1 style="font-family: 'Montserrat'; font-size:18px; font-weight:600; padding-top:19px; padding-bottom:15px;">Proceed to Order</h1>-->
                    <a onclick="return confirm('Pastikan Pesananmu Telah Sesuai!')" href="{{ url('cash_order', $totalproduct) }}" class="btn btn-danger order-button">Pesan</a>
                    <a href="{{url('show_order')}}" class="btn btn-primary view-order-button">Lihat Pesanan</a>
                </div>


            </div>
        </div>
        
      
        <!-- footer start 
        @include('home.footer')
        footer end -->

      <div class="content-footer">
         <p  class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a>         
         </p>
      </div>

      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
               var scrollpos = localStorage.getItem('scrollpos');
               if (scrollpos) window.scrollTo(0, scrollpos);
         });

         window.onbeforeunload = function(e) {
               localStorage.setItem('scrollpos', window.scrollY);
         };
    </script>
      
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