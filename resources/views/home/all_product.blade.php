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


   </style>

   <body>
        <div class="hero_area">
            <!-- header section strats -->
            @include('home.header')
            <!-- end header section -->

            @if(session()->has('message'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
            @endif
         
            <section class="product_section layout_padding">
                <div class="container" style="position: relative;">
                    <div class="heading_container heading_center">
                        <!--<h2>
                            Produk <span>Kami</span>
                        </h2>-->
                        <br><br>

                        <div style="margin-top: -100px; margin-bottom:50px;">
                            <form action="{{url('category_search')}}" method="GET" style="display: inline-block; margin-right: 10px;">
                                <input style="width: 280px; height:44px;" type="text" name="search" placeholder="Cari Produk Apa?" >
                                <input type="submit" value="Cari" name="" id="" style="display: inline-block; transition: box-shadow 0.3s;" onmouseover="this.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';" onmouseout="this.style.boxShadow = 'none';">
                            </form>
                        </div>

                        <div class="category-buttons">
                            <a href="{{ url('products') }}" class="category-button">Semua</a>
                            <a href="{{ url('category_bahankue') }}" class="category-button">Bahan Kue</a>
                            <a href="{{ url('category_bumbudapur') }}" class="category-button">Bumbu Dapur</a>
                            <a href="{{ url('category_peralatandapur') }}" class="category-button">Peralatan Dapur</a>
                            <a href="{{ url('category_plastik') }}" class="category-button">Plastik</a>
                            <a href="{{ url('category_aksesoris') }}" class="category-button">Aksesoris</a>
                        </div>

                    </div>
      
                    <div class="row">
                        @foreach($product as $products)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box">
                                <div class="option_container">
                                    <div class="options">
                                        <a href="{{ url('product_details', $products->id) }}" class="option1">
                                            Detail Produk
                                        </a>
                                        <form action="{{ url('add_cart', $products->id) }}" method="POST" class="product_section form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" name="quantity" value="1" min="1" class="product_section input">
                                                </div>

                                                <div class="col-md-4" >
                                                    <input type="submit" value="Tambah Keranjang" class="product_section options option2">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="img-box">
                                    <img src="product/{{ $products->image }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>{{ $products->title }}</h5>
                                    @if($products->discount_price != null)
                                        <h6 style="color:red">
                                            Discount price
                                            <br>
                                            Rp{{ $products->discount_price }}
                                        </h6>
                                        <h6 style="text-decoration: line-through;">
                                            Rp{{ $products->price }}
                                        </h6>
                                    @else
                                        <h6>
                                            Rp{{ $products->price }}
                                        </h6>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @endforeach
                        <span style="padding-top: 20px;  margin-bottom: 80px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">
                            {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                        </span>
                    </div>

                    <div class="btn-box" style="margin-top: 100px; margin-bottom: 50px;">
                        <a href="{{url('/products')}}">
                            Lihat Semua
                        </a>
                    </div> 
                </div>
            </section>


            <div>
                <p class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a>         
                </p>
            </div>
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

<script>
    function isScrolledIntoView(elem) {
        var rect = elem.getBoundingClientRect();
        var elemTop = rect.top;
        var elemBottom = rect.bottom;

        // Check if the element is at least partially visible
        var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);

        return isVisible;
    }

    document.addEventListener("DOMContentLoaded", function(event) { 
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);

        var alertMessage = document.querySelector('.alert-danger');
        if (alertMessage) {
            if (!isScrolledIntoView(alertMessage)) {
                // Scroll to the alert message if it's not in view
                alertMessage.scrollIntoView({ behavior: "smooth" });
            }
        }
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>