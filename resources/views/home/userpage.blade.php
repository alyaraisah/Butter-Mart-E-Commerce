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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   </head>

   <style>
      @media (max-width: 767px) {
         .padding-hero{
            padding-top: 50px;
         }
      }
   </style>

   

   <body>

      @include('sweetalert::alert')

      <!-- header section strats -->
      @include('home.header')
      <!-- end header section -->
   
      <div class="padding-hero">
         <div class="hero_area">
            <!-- slider section -->
            @include('home.slider')
            <!-- end slider section -->
         </div>

         <!-- why section -->
         @include('home.why')
         <!-- end why section -->
         
         <!-- arrival section -->
         @include('home.new_arrival')
         <!-- end arrival section -->
         
         <!-- product section -->
         @include('home.product')
         <!-- end product section -->

         <!-- subscribe section -->
         <!-- end subscribe section -->

         <!-- client section -->
         @include('home.client')
         <!-- end client section -->

         <!-- footer start -->
         @include('home.footer')
         <!-- footer end -->

         <div class="cpy_">
            <p class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a>         
            </p>
         </div>

      </div>

      
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      <!-- jQuery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- Popper.js -->
      <script src="home/js/popper.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="home/js/bootstrap.js"></script>
   </body>
</html>