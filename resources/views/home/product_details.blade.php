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
            overflow: hidden;
            margin-right: 30px;
            margin-top: 40px;
        }

        .img-box img {
            max-width: 50%;
            height: auto;
            object-fit: cover;
            margin-left: 100px;
        }

        .detail-box {
            flex: 1;
            margin-top: 15px;
        }

         .btn-custom {
            height: 35px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 15px;
            margin-bottom: 20px;
            background-color: #FFFFFF; /* Default background color */
            color: #000000; /* Default font color */
            border: none; /* Remove border */
         }

         .btn-custom:hover {
            background-color: #F3C06B !important; /* Hover background color */
            color: #2E68A2 !important; /* Hover font color */
         }

        .mx-auto {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            z-index: 100;
            margin-bottom: auto;
        }

        .btn-custom1 {
            height: 35px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 100px;
            margin-left: 0px;
            text-decoration: none;
            background-color: #F3C06B; /* Default background color */
            color: #2E68A2; /* Default font color */
            display: inline-block;
        }

        .btn-custom1:hover {
            background-color: #F3C06B; /* Default background color */
            color: #2E68A2; 
        }

        .btn-custom1.clicked {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }



        @media (max-width: 768px) {
            .card{
                border: 0px;
            }
            .img-box {
                overflow: hidden;
                margin-right: 30px;
                margin-top: -20px;
            }
        }
    </style>




<body>
    <div>
        <!-- Include Header Section -->
        @include('home.header')
        <!-- End Header Section -->
        
        <!-- Alert Messages -->
        @if(session()->has('message'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>
        @endif
        
        <!-- Product Details -->
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row" style="margin-top: 30px;">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="img-box">
                                <img src="/product/{{ $product->image }}" alt="{{ $product->title }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="detail-box">
                                <h5 style="margin-top: 35px;">{{ $product->title }}</h5>
                                @if ($product->discount_price != null)
                                    <h6 class="discount-price">Discount price<br>Rp{{ $product->discount_price }}</h6>
                                    <h6 class="original-price">Rp{{ $product->price }}</h6>
                                @else
                                    <h6 class="original-price" style="padding-top: 20px;"><strong>Harga :</strong><br> 
                                       <span>Rp{{ $product->price }}</span></h6>
                                @endif
                                
                                <h6 class="product-category" style="padding-top: 5px;"><strong>Product Category :</strong><br>
                                    <span>{{ $product->category }}</span></h6>
                                <h6 class="product-description" style="padding-top: 5px;"><strong>Product Description :</strong><br>
                                    <span>{{ $product->description }}</span></h6>
                                <h6 class="available-quantity" style="padding-top: 5px;"><strong>Available Quantity :</strong><br>
                                    <span>{{ $product->quantity }}</span></h6>
                                <!-- <a href="" class="btn btn-primary custom-button" style="height: 27px; font-size: 15px; align-items:center;">Add To Cart</a> -->

                                <form action="{{ url('add_cart', $product->id) }}" method="Post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <input type="number" name="quantity" value="1" min="1"
                                                style="margin-top: 22px; width: 80px; height: 30px; border-radius: 5px; font-size: 15px; align-items:center;">
                                        </div>
                                    </div>

                                    <div class="row">
                                       <div class="col-md-4 col-12 d-none d-md-block">
                                             <input type="submit" value="Tambah Keranjang" class="btn-custom"
                                                style="height: 35px; padding: 5px 10px; border-radius: 5px; font-size: 15px; margin-bottom: 20px;">
                                       </div>
                                    </div>     

                                    <div class="row">
                                       <div class="col-md-4 col-12 d-md-none">
                                             <input type="submit" value="Tambah Keranjang" class="btn-custom"
                                                style="height: 35px; padding: 5px 10px; border-radius: 5px; font-size: 15px; margin-bottom: 10px; margin-left: 0px;">
                                       </div>
                                    </div>  
                                    
                                    <div class="row">
                                       <div class="col-md-6 col-12 d-md-none">
                                          <a href="{{ url('show_cart') }}" class="btn-custom1"
                                             style="height: 35px; padding: 5px 10px; border-radius: 5px; font-size: 15px; margin-bottom: 100px; margin-left: 0px; text-decoration: none;">
                                                Lihat Keranjang
                                          </a>
                                       </div>
                                    </div>

                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>

    <!-- Copyright -->
    <div>
      <p class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a></p>
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

   <script>
        // Add and remove class to handle box-shadow effect
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.querySelector('.btn-custom1');
            button.addEventListener('click', function() {
                button.classList.toggle('clicked');
            });
        });
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
