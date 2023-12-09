<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')

  <style type="text/css">

    .center 
    {
        margin: auto;
        width: 50%;
        border: 2px solid grey;
        text-align: center;
        margin-top: 40px;
    }

    /*   .h2_class : For "All Products"  */
    .h2_class 
    {
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
    }

    th 
    {
        white-space: nowrap;
        padding: 15px;
        background-color: #191c24;
    }

    th, td 
    {
        border: 2px solid grey;
    }

    .font_size
    {
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
    }

    .th_deg
    {
        padding: 20px;
    }

    
 

  </style>

  </head>
  <body>
    <div class="container-scroller">

        @include('admin.sidebar')

        @include('admin.header')

        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                    </div>
                @endif

                <h2 class="font_size">Lihat Produk</h2>

                <div style="margin: auto; padding-top:25px; text-align:center;">
                    <form action="{{ url('search3') }}" method="get">
                        @csrf
                        <input type="text" name="search3" id="" placeholder="Cari Produk?" style="color: black;">
                        <input type="submit" value="Cari" class="btn btn-outline-primary" id="">
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="center">

                        <tr class="th_color">
                            <th class="th_deg">No.</th>
                            <th class="th_deg">Nama Produk</th>
                            <th class="th_deg">Deskripsi</th>
                            <th class="th_deg">Kuantitas</th>
                            <th class="th_deg">Kategori</th>
                            <th class="th_deg">Harga</th>
                            <!--<th class="th_deg">Discount Price</th>-->
                            <th class="th_deg">Gambar</th>
                            <th class="th_deg">Hapus</th>
                            <th class="th_deg">Edit</th>
                        </tr>

                        @php
                            $counter = 1; 
                        @endphp

                        @foreach($product as $product)

                        <tr>
                            <td>{{$counter}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{ Illuminate\Support\Str::limit($product->description, 30) }}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <!-- <td>{{$product->discount_price}}</td> -->
                            <td style="text-align: center; vertical-align: middle;">
                                <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img style="width: 70px;" class="img_size" src="/product/{{$product->image}}">
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin ingin Menghapus Produk Ini?')" href="{{url('delete_product', $product->id)}}">Hapus</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('update_product', $product->id)}}">Edit</a>
                            </td>
                        </tr>

                        @php
                            $counter++; 
                        @endphp

                        @endforeach

                    </table>
                </div>

            </div>
        </div>
    </div>
    @include('admin.script')
  </body>
</html>