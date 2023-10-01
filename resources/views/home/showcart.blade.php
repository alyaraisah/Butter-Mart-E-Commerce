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
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Butter Mart</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   
    <style type="text/css">

    .center {
        margin: auto;
        width: 60%;
        text-align: center;
        padding: 30px;
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
    }

    .quantity-input {
        width: 70px; 
        height: 30px;
        margin-right: 10px; 
        margin-top: 20px;
        margin-left: 30px;
        
    }

    .btn.cart {
        background-color: #2E68A2;
        border: 1px solid #F3C06B;
        height: 30px;
        display: flex; /* Use flexbox for centering */
        align-items: center;
        justify-content: center;
        font-size: 15px;
        margin-right: -15px;
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
        display: flex; /* Use flexbox for centering */
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
        position: flex;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #333; /* Choose your background color */
        color: #fff; /* Choose your text color */
        text-align: center;
        padding: 10px 0; /* Adjust padding as needed */
    }

    </style>


    </head>

   <body>
    
      <div>
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

            <div class="center">
                <table class="cart-table">
      
                        <tr>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                
                        
                    @if($cart->isEmpty()) 
                        <tr>
                            <td colspan="3">Your cart is empty.</td>
                        </tr>
                    @else 

                        <?php $totalprice=0; ?>

                        @foreach($cart as $cart)
                            <tr>
                                <td>{{$cart->product_title}}</td>
                                
                                <td>
                                    <form action="{{ route('update_cart', $cart->id) }}" method="POST">
                                        @csrf
                                        <div class="quantity-container">
                                            <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="quantity-input">
                                            <button type="submit" class="btn btn-primary cart">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td>Rp{{$cart->price}}</td>
                                <td style="width: 50px;"><img src="/product/{{$cart->image}}"></td>
                                <td>
                                    <a class="btn btn-danger cart" onclick="return confirm('Are you sure to remove this product?')" href="{{url('/remove_cart',$cart->id)}}">Remove</a>
                                </td>
                            </tr>

                            <?php $totalprice += $cart->price * $cart->quantity; ?> <!-- Update total price here -->

                        @endforeach
                        
                    @endif

                </table>

                <div class="cart-actions">
                    <span>Total price: Rp{{$totalprice}}</span><br>
                    <button>Checkout</button>
                </div>
            </div>

        </div>
        
      
        <!-- footer start 
        @include('home.footer')
        footer end -->

      <div>
         <p  class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a>         
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