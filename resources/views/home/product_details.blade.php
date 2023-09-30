<!DOCTYPE html>
<html>
   <style>
   .product-card {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-left: 200px;
      margin-right: 200px;
      margin-top: 25px;
      margin-bottom: 40px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
   
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
   }

   .img-box {
      width: 300px; /* Set a fixed width for the image container */
      height: 50%; /* Set a fixed height for the image container */
      overflow: hidden;
      margin-right: 20px;
   }

   .img-box img {
      width: 100%;
      height: 100%;
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

   </style>

   <head>
      <!-- Basic -->
      <base href="/public">
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
   </head>

   <body>
      <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
      

      <div class="product-card">
         <div class="img-box">
            <img src="product/{{$product->image}}" alt="{{$product->title}}">
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
                     <input type="number" name="quantity" value="1" min="1" style="margin-top:22px; width:90px; height: 30px; border-radius:5px; font-size: 15px; align-items:center;">
                  </div>

                  <div class="col-md-4">
                     <input type="submit" value="Tambah Keranjang" style="margin-top:20px; margin-left:-120px; height: 35px;  padding: 5px 10px;  border-radius:5px; font-size: 15px; align-items:center; justify-content:center; display: flex;">
                  </div>            
                </div>
            </form>
         </div>
      </div>

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
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