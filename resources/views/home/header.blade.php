<style>
    @media (max-width: 767px) {
        .navbar-collapse {
            text-align: left;
        }

        .navbar-nav {
            margin-top: 10px;
        }

        .navbar-toggler {
            margin-left: 10px;
        }

        .navbar-nav {
            width: 100%;
        }

        .navbar-nav>li {
            text-align: left;
            width: 100%;
            margin: 0;
        }

        .navbar-nav>li>a {
            padding: 10px 15px;
            width: 100%;
            display: block;
        }

        .dashboard {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        @media (max-width: 767px) {
            .dropdown-menu {
                text-align: center;
                border-radius: 10px;
            }
        }
    }
</style>

<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ url('/redirect') }}">
                <img width="100" src="/images/logo.png" alt="#" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span> </span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/redirect') }}" style="margin-right: -15px;">Beranda
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}" style="margin-right: -15px;">Produk Kami</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="margin-right: -15px;"
                        role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="nav-label">Kontak<span class="caret"></span></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="contactDropdown"> <!-- Add ID here -->
                            <a class="dropdown-item" href="https://wa.me/6285888273995" target="_blank" style="color: #15304a;">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a class="dropdown-item" href="https://www.instagram.com/butter.mart" target="_blank" style="color: #15304a;">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                            <a class="dropdown-item" href="https://www.facebook.com/butter.mart" target="_blank" style="color: #15304a;">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}" style="margin-right: 0px;">
                            <div class="nav-cart"
                                onmouseover="this.querySelector('.fas').style.color='#2E68A2';"
                                onmouseout="this.querySelector('.fas').style.color='rgba(21, 48, 74, 0.9)';">
                                <span>Keranjang </span>
                                <i class="fas fa-shopping-cart" style="color: rgba(21, 48, 74, 0.9);"></i>
                            </div>
                        </a>
                    </li>
                    <!--<form class="nav-item" id="scrollToProductsForm">
                        <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" style="color: rgba(21, 48, 74, 0.9);" aria-hidden="true"
                                onmouseover="this.style.color='#2E68A2';"
                                onmouseout="this.style.color='rgba(21, 48, 74, 0.9)';"></i>
                        </button>
                    </form>-->
                    @if (Route::has('login'))
                    @auth
                    <div class="dashboard">
                        <li class="nav-item">
                            <x-app-layout>
                            </x-app-layout>
                        </li>
                    </div>
                    @else
                    <li class="nav-item d-none d-md-block">
                        <a style="background-color: #F3C06B; margin-left: 17px; border: 1px solid white; color: #15304a; font-weight: 500; transition: background-color 0.3s;"
                            onmouseover="this.style.backgroundColor = ''; this.style.color = '#ffff';"
                            onmouseout="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            onclick="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            class="btn btn-primary" id="logincss" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a style="background-color: #F3C06B; margin-bottom:4px; margin-left: 3px; border: 1px solid white; color: #15304a; font-weight: 500; transition: background-color 0.3s;"
                            onmouseover="this.style.backgroundColor = ''; this.style.color = '#ffff';"
                            onmouseout="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            onclick="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            class="btn btn-primary" id="logincss" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a style="background-color: #F3C06B; margin-left: 3px; border: 1px solid white; color: #15304a; font-weight: 500; transition: background-color 0.3s;"
                            onmouseover="this.style.backgroundColor = ''; this.style.color = '#ffff';"
                            onmouseout="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            onclick="this.style.backgroundColor = '#F3C06B'; this.style.color = '#15304a';"
                            class="btn btn-primary" id="logincss" href="{{ route('register') }}">Daftar</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
