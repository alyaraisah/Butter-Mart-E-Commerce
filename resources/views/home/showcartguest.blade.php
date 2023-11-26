<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png" type="">
    <title>Butter Mart</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}">
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<style type="text/css">
    .center {
        margin: auto;
        width: 60%;
        text-align: center;
        padding: 30px;
        padding-bottom: 50px;
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
        border: 1px solid grey;
        font-size: 18px;
        text-align: center;
    }

    td {
        padding: 10px;
        border: 1px solid grey;
    }

    td.action {
        color: red;
        cursor: pointer;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .cart-actions span {
        font-size: 18px;
        font-weight: bold;
    }

    .quantity-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-input {
        width: 70px;
        height: 30px;
        margin-right: 10px;
        margin-top: 20px;
    }

    .btn.cart {
        background-color: #2E68A2;
        border: 1px solid #F3C06B;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .btn.cart:hover {
        background-color: #F3C06B;
        border: 1px solid #2E68A2;
        color: #2E68A2;
    }

    .btn.btn-danger.cart {
        background-color: red;
        border: 1px solid #F3C06B;
        height: 30px;
        display: flex;
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
        position: fixed;
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

    .content-footer {
        padding-bottom: 50px;
    }

    .order-button {
        margin-top: 25px;
        padding-left: 20px;
        padding-right: 20px;
        background-color: #DC3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .order-button:hover {
        background-color: #C82333;
    }

    .view-order-button {
        margin-top: 25px;
        margin-left: 10px;
        padding-left: 20px;
        padding-right: 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .view-order-button:hover {
        background-color: #0056b3;
    }
</style>


<body>
    <div>
        @include('home.header')
        
        @if(session()->has('message'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif

        <div class="center">
            <table class="cart-table">
                <tr>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Hapus</th>
                </tr>
                <?php $totalprice = 0; ?>
                <?php $totalproduct=0;  ?>
                @if(empty($cart))
                    <tr>
                        <td colspan="5">Keranjang Mu Kosong</td>
                    </tr>
                @else
                    @foreach($cart as $cartItem)
                        <tr>
                            <td>{{ $cartItem['product_title'] }}</td>
                            <td>
                                <form action="{{ route('update_cart', $cartItem['product_id']) }}" method="POST">
                                    @csrf
                                    <div class="quantity-container">
                                        <input type="hidden" name="title" value="{{ $cartItem['product_title'] }}">
                                        <input type="number" name="quantity" value="{{ $cartItem['quantity'] }}" min="1" class="quantity-input">
                                        <button type="submit" class="btn btn-primary cart">Perbarui</button>
                                    </div>
                                </form>
                            </td>
                            <td>Rp{{ $cartItem['price'] }}</td>
                            <td style="width: 55px;"><img class="w-100" src="/product/{{ $cartItem['image'] }}"></td>
                            <td>
                                <a class="btn btn-danger cart" onclick="return confirm('Yakin ingin menghapus produk ini?')" href="{{ url('/remove_cart', $cartItem['product_id']) }}">Hapus</a>
                            </td>
                        </tr>
                        @php
                            $totalproduct++;
                            $totalprice += $cartItem['price'];
                        @endphp
                    @endforeach
                @endif
            </table>

            <div class="cart-actions">
                <span>Harga Total: Rp{{ $totalprice }}</span><br>
            </div>

            <div class="button-container">
                <a onclick="return confirm('Pastikan Pesananmu Telah Sesuai!')" href="{{ url('cash_order', $totalproduct) }}" target="_blank" class="btn btn-danger order-button">Pesan</a>
            </div>
        </div>
    </div>

    <div class="content-footer">
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
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <script src="home/js/popper.min.js"></script>
    <script src="home/js/bootstrap.js"></script>
    <script src="home/js/custom.js"></script>
</body>
</html>
