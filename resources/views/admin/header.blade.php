<style>
    .dropdown-item {
        color: white !important;
    }
    .dropdown-item:hover {
        color: white !important;
        background-color: rgba(0, 0, 0, 0.1) !important; /* Change the background color on hover if needed */
    }
</style>

<div class="container-fluid page-body-wrapper">
    <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <!--<a class="navbar-brand brand-logo-mini" href="index.html">
                <img src="admin/assets/images/logo.svg" alt="logo" />
            </a>-->
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">

        <!--<button class="navbar-toggler navbar-toggler align-self-center d-flex d-md-none" type="button" data-toggle="minimize" onclick="toggleSidebar()">
            <span class="mdi mdi-menu"></span>
        </button>-->

        
            
            <!--<ul class="navbar-nav w-100">
                <li class="nav-item w-100">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                        <input type="text" class="form-control" placeholder="Search products">
                    </form>
                </li>
            </ul>-->

            <ul class="navbar-nav navbar-nav-right d-none d-md-flex" style="margin-right:20px;"> <!-- Visible on medium and larger screens -->
                <li>
                    <x-app-layout></x-app-layout>
                </li>
            </ul>

           <ul class="navbar-nav navbar-nav-left d-flex d-md-none" style="position: absolute; top: 0; left: 0; margin-left:30px; margin-top:15px;">
                <!-- Visible only on smaller screens -->
                <li>
                    <x-app-layout></x-app-layout>
                </li>

            </ul>

            <ul class="navbar-nav navbar-nav-left d-flex d-md-none" style="position: absolute; top: 0; left: 0; margin-left:60px; margin-top:20px;">
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Request::is('redirect'))
                            Dashboard
                        @elseif(Request::is('view_product'))
                            Tambah Produk
                        @elseif(Request::is('show_product'))
                            Lihat Produk
                        @elseif(Request::is('update_product'))
                            Edit Produk
                        @elseif(Request::is('view_category'))
                            Kategori
                        @elseif(Request::is('cart'))
                            Keranjang
                        @elseif(Request::is('order'))
                            Pesanan
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('redirect') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('view_product') }}">Tambah Produk</a>
                        <a class="dropdown-item" href="{{ route('show_product') }}">Lihat Produk</a>
                        <a class="dropdown-item" href="{{ route('view_category') }}">Kategori</a>
                        <a class="dropdown-item" href="{{ route('cart') }}">Keranjang</a>
                        <a class="dropdown-item" href="{{ route('order') }}">Pesanan</a>
                        <!-- Add more pages as needed -->
                    </div>
            </li>
            </ul>

        </div>
    </nav>

    
    <script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar.style.display === 'none') {
            sidebar.style.display = 'block';
        } else {
            sidebar.style.display = 'none';
        }
    }
  </script>




