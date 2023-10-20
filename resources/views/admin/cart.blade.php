<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')

  <style type="text/css">
    .title_deg  {
        text-align: center;
        font-size: 40px;
        padding-top: 40px;
    }

    .table-container {
        overflow-x: auto;
    }

    .table_deg {
        border: 2px solid grey;
        margin: auto;
        width: 100%;
        border-collapse: collapse;
        text-align: center;
        margin-top: 40px;
    }

    th {
        white-space: nowrap;
        padding: 7px;
        background-color: #191c24;
        border: 2px solid grey;
        
    }

    td {
        border: 2px solid grey;
        
    }

    .btn.btn-primary.delivered {
        padding: 5px;

    }

    .btn.btn-secondary.pdf {
        padding: 5px;

    }

    .btn.btn-outline-primary {
        padding: 9px;
    }


  </style>

  </head>
  <body>
    <div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->

    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">
            
            <h1 class="title_deg">All Carts</h1>

            <div style="margin: auto; padding-top:25px; text-align:center;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input type="text" name="search" id="" placeholder="Cari Apa?" style="color: black;">
                    <input type="submit" value="Search" class="btn btn-outline-primary" id="">

                </form>
            </div>

            <div class="table-container">
            @if($carts !== null && count($carts) > 0)
                <table class="table_deg">

                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No.Hp</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Accepted</th>
                </tr>

                @foreach($carts as $cart)

                <tr class="th_deg">
                    <td>{{$cart->name}}</td>
                    <td>{{$cart->email}}</td>
                    <td>{{$cart->address}}</td>
                    <td>{{$cart->phone}}</td>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->price}}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        <img style="width: 50px; display: block; margin: 0 auto;" src="/product/{{$cart->image}}" alt="">
                    </td>
                    <td>
                        <a href="{{ route('cart.accept', $cart->id) }}" class="btn btn-primary accepted">Accepted</a>
                    </td>


                </tr>

                @endforeach

                </table>

            @else
                <table class="table_deg">

                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Deliverd</th>
                    </tr>

                    <tr class="th_deg">
                        <td colspan="11" style="text-align: center; padding:10px;">
                            @if(count($carts) === 0)
                                Belum ada order
                            @endif
                        </td>
                    </tr>
                </table>

            @endif
            </div>
        </div>
    </div>
    <!-- Plugin js for this page -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>