<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="/images/favicon.png" type="">

    <title>Butter Mart</title>

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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


        @media (max-width: 767px) {
            .product_section.layout_padding .container .row .col-sm-6 {
                width: 50% !important;
                box-sizing: border-box;
                padding: 0 5px;
            }
            .product_section.layout_padding .container .row .col-sm-6 .box {
                padding: 15px;
                margin-bottom: 20px;
            }
            .product_section.layout_padding .container .row .col-sm-6 .detail-box {
                text-align: center;
            }
            .product_section.layout_padding .container .row .col-sm-6 .detail-box h5,
            .product_section.layout_padding .container .row .col-sm-6 .detail-box h6 {
                margin: 5px 0;
            }
            .product_section.layout_padding .container .row .col-sm-6 .img-box img {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
            }

        }

    </style>
</head>
<body>
    <div class="hero_area" id="top">

        @include('home.header')

        <div style="padding-top:100px;">

            @if(session()->has('message'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
            @endif

            <section class="product_section layout_padding">
                <div class="container" style="position: relative;">
                    <!-- Heading container -->
                    <div class="heading_container heading_center">
                        <!-- Search form -->
                        <div class="heading_container heading_center"  style="margin-top: -20px;">
                        <br><br>
                        <div style="margin-top: -100px; margin-bottom:50px;">
                            <form action="{{url('category_search')}}" method="GET" style="display: inline-block; margin-right: 10px;">
                                <input style="width: 280px; height:44px;" type="text" name="search" placeholder="Cari Produk Apa?" >
                                <input type="submit" value="Cari" name="" id="" 
                                style="display: inline-block; transition: box-shadow 0.3s;"
                                    onmouseover="this.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';"
                                    onmouseout="this.style.boxShadow = 'none';">
                            </form>
                        </div>
                        <!-- Category buttons -->
                        <div class="container">
                            <div class="row category-buttons">
                                <!-- Category links -->
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('products') }}" class="category-button">Semua</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('category_bahankue') }}" class="category-button">Bahan Kue</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('category_bumbudapur') }}" class="category-button">Bumbu Dapur</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('category_peralatandapur') }}" class="category-button">Peralatan
                                        Dapur</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('category_plastik') }}" class="category-button">Plastik</a>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-2">
                                    <a href="{{ url('category_aksesoris') }}" class="category-button">Aksesoris</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product listing -->
                    <div class="row">
                        <!-- Product cards -->
                        @foreach ($product as $products)
                            <!-- Product card -->
                            <div class="col-sm-6 col-md-4 col-lg-4 d-none d-md-block">
                                <!-- Product details -->
                                <div class="box">
                                    <div class="option_container">
                                        <div class="options">
                                            <a href="{{ url('product_details', $products->id) }}" class="option1">
                                                Detail Produk
                                            </a>
                                            <form action="{{ url('add_cart', $products->id) }}" method="Post"
                                                class="product_section form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-4">
                                                        <input type="number" name="quantity" value="1" min="1"
                                                            class="product_section input">
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-8">
                                                        <input style="" type="submit" value="Tambah Keranjang"
                                                            class="product_section options option2">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="img-box">
                                        <img src="product/{{ $products->image }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ $products->title }}
                                        </h5>
                                    </div>
                                    <div class="detail-box">
                                        @if ($products->discount_price != null)
                                            <h6 style="color:red">
                                                Discount price
                                                <br>
                                                Rp{{ $products->discount_price }}
                                            </h6>

                                            <h6 style="text-decoration: line-through;">
                                                <!-- Price <br>-->
                                                Rp{{ $products->price }}
                                            </h6>
                                        @else
                                            <h6>
                                                <!-- Price <br>-->
                                                Rp{{ $products->price }}
                                            </h6>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 d-md-none">
                                <!-- Product details for smaller screens -->
                                <div class="box">
                                    <div class="option_container">
                                        <div class="options">
                                            <a href="{{ url('product_details', $products->id) }}" class="option1" style="margin-right:-20px; width:80%;">
                                                Detail
                                            </a>
                                            <form action="{{ url('add_cart', $products->id) }}" method="Post" class="product_section form">
                                                @csrf
                                                <div class="row">
                                                    <div class="">
                                                        <input style="" type="number" name="quantity" value="1" min="1" class="product_section input1">
                                                    </div>
                                                    <div class="">
                                                        <input style="width:40%; margin-left:5px;" type="submit" value="+" class="product_section options option2">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="img-box">
                                        <img src="product/{{ $products->image }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            {{ strlen($products->title) > 15 ? substr($products->title, 0, 14) . '...' : $products->title }}
                                        </h5>
                                    </div>
                                    <div class="detail-box">
                                        @if ($products->discount_price != null)
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
                    </div>

                    <!-- Pagination -->
                    <span style="padding-top: 20px; margin-bottom: 80px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">
                        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                    </span>

                    <!-- Button box -->
                    <div class="btn-box" style="margin-top: 100px; margin-bottom: 50px;">
                        <a href="{{url('/products')}}">Lihat Semua</a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <div>
        <p class="mx-auto">© 2023 All Rights Reserved By <a>Butter Mart</a></p>
    </div>

    <!-- JavaScript -->
    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

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
                scrollToTop();
            }
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };

    </script>


    <!-- JavaScript dependencies -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <script src="home/js/popper.min.js"></script>
    <script src="home/js/bootstrap.js"></script>
    <script src="home/js/custom.js"></script>
    
</body>
</html>
