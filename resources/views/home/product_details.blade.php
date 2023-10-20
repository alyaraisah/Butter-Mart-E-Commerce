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
   .product-card {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-left: 200px;
      margin-right: 200px;
      margin-top: 25px;
      margin-bottom: 40px;
      padding: 50px;
      border: 1px solid #ccc;
      border-radius: 5px;
   
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
   }

   .img-box {
      width: 300px; 
      overflow: hidden;
      margin-right: 30px;
   }

   .img-box img {
      width: 160px;
      margin-left: 120px;
      object-fit: cover; /* Maintain aspect ratio and cover the container */
   }

   .detail-box {
      flex: 1; /* Take remaining available space */
   }

   .btn.btn-primary.custom-button {
      background-color: white; 
      color: #007bff; 
      padding: 10px 20px;
      border: 2px solid #007bff; 
      border-radius: 5px; 
      text-decoration: none; 
      font-size: 15px;
      display: flex;
      align-items: center; 
      justify-content: center; 
      cursor: pointer; 
      transition: background-color 0.3s ease, color 0.3s ease; 
      width: 150px;
      margin-top: 20px;
   }

   .btn.btn-primary.custom-button:hover {
      background-color: #007bff; 
      color: white; 
   }

   .mx-auto {
      position:fixed;
      margin-bottom: auto;
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
      <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
      

      <div class="product-card">
         
         <div class="img-box">
            <img src="/product/{{$product->image}}" alt="{{$product->title}}">
         </div>

         <div class="detail-box">

            <h5>{{$product->title}}</h5>

            @if($product->discount_price != null)
            
            <h6 class="discount-price">Discount price<br>Rp{{$product->discount_price}}</h6>
            <h6 class="original-price">Rp{{$product->price}}</h6>
            
            @else

            <h6 class="original-price" style="padding-top: 20px;">Rp{{$product->price}}</h6>
            
            @endif

            <h6 class="product-category" style="padding-top: 5px;">Product Category     : {{$product->category}}</h6>
            <h6 class="product-description" style="padding-top: 5px;">Product Description : {{$product->description}}</h6>
            <h6 class="available-quantity" style="padding-top: 5px;">Available Quantity    : {{$product->quantity}}</h6>
            <!-- <a href="" class="btn btn-primary custom-button" style="height: 27px; font-size: 15px; align-items:center;">Add To Cart</a> -->

            <form action="{{url('add_cart', $product->id)}}" method="Post">
               @csrf
               <div class="row">
                  <div class="col-md-4">
                     <input type="number" name="quantity" value="1" min="1" style="margin-top:22px; width:80px; height: 30px; border-radius:5px; font-size: 15px; align-items:center;">
                  </div>

                  <div class="col-md-4">
                     <input type="submit" value="Tambah Keranjang" style="margin-top:20px; margin-left:-120px; height: 35px;  padding: 5px 10px;  border-radius:5px; font-size: 15px; align-items:center; justify-content:center; display: flex;">
                  </div>            
                </div>
            </form>
         </div>
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