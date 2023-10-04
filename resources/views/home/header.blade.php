<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{url('/redirect')}}"><img width="100" src="images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">

                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/redirect')}}" style="margin-right: -15px;">Beranda<span class="sr-only">(current)</span></a>
                    </li>
                    
                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">About</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                        </ul>
                    </li>-->

                    <li class="nav-item">
                        <a class="nav-link" href="product.html" style="margin-right: -15px;">Produk Kami</a>
                    </li>

                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="blog_list.html">Blog</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html" style="margin-right: -15px;">Kontak</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}" style="margin-right: 0px;">Keranjang <i class="fas fa-shopping-cart"></i></a>
                    </li>

                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>

                    @if (Route::has('login'))

                    @auth
                    <li style="margin-left:-20px;" class="nav-item">
                        <x-app-layout>

                        </x-app-layout>
                    </li>

                    @else

                    <li class="nav-item">
                        <a style="background-color:#F3C06B; margin-left:17px; border: 1px solid white; color:#15304a; font-weight:500; transition: background-color 0.3s; " onmouseover="this.style.backgroundColor = ''; this.style.color = '#ffff';" onmouseout="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';" class="btn btn-primary" id="logincss" href="{{ route('login') }}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a style="background-color:#F3C06B; margin-left:3px; border: 1px solid white; color:#15304a; font-weight:500; transition: background-color 0.3s; " onmouseover="this.style.backgroundColor = ''; this.style.color = '#ffff';" onmouseout="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';" class="btn btn-primary" id="logincss" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth

                    @endif

                </ul>
            </div>
        </nav>
    </div>
</header>
