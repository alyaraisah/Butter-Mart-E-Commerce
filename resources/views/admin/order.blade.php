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

            <div style="margin: auto; padding-top:25px; text-align:center;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input type="text" name="search" id="" placeholder="Cari Apa?" style="color: black;">
                    <input type="submit" value="Cari" class="btn btn-outline-primary" id="">

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
                    <th>Dikirim</th>
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
                        <a href="{{ url('delivered/' . $order->created_at . '/' . $order->user_id) }}" onclick="return confirm('Apakah Yakin Ingin Mengirim Produk Ini?');" class="btn btn-primary delivered">Dikirim</a>
                        @else
                        <p style="color:#F3C06B">Terkirim</p>
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
                        <th>Dikirim</th>
                        <th>Print PDF</th>
                    </tr>

                    <tr class="th_deg">
                        <td colspan="12" style="text-align: center; padding:10px;">
                            @if(count($orders) === 0)
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