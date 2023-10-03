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
            
            <h1 class="title_deg">All Orders</h1>

            <div style="margin: auto; padding-top:12px; ">
                <form action="">
                    <input type="text" name="search" id="" placeholder="Cari Produk Apa?">
                    <input type="submit" value="Search" class="btn btn-outline-primary" id="">

                </form>
            </div>

            <div class="table-container">
            @if(count($orders) > 0)
                <table class="table_deg">

                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No.Hp</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Status Bayar</th>
                    <th>Status Kirim</th>
                    <th>Gambar</th>
                    <th>Delivered</th>
                    <th>Print PDF</th>
                </tr>

                @foreach($orders as $order)

                <tr class="th_deg">
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        <img style="width: 50px; display: block; margin: 0 auto;" src="/product/{{$order->image}}" alt="">
                    </td>
                    <td>
                        @if($order->delivery_status=='processing')
                        
                        <a href="{{ url('delivered/' . $order->created_at . '/' . $order->user_id) }}" onclick="return confirm('Are You Sure to deliver these products?');" class="btn btn-primary delivered">Delivered</a>
                        
                        @else

                        <p style="color:#F3C06B">Delivered</p>
                        
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary pdf">Print PDF</a>
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
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Deliverd</th>
                    </tr>

                    <tr class="th_deg">
                        <td colspan="11" style="text-align: center; padding:10px;">
                            @if(count($orders) === 0)
                                Belum ada produk
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