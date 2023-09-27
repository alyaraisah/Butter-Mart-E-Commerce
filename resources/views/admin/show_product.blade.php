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

        <h2 class="font_size">All Products</h2>

        <table class="center">

            <tr class="th_color">
                <th class="th_deg">No.</th>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Description</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Category</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Discount Price</th>
                <th class="th_deg">Product Image</th>
                <th class="th_deg">Delete</th>
                <th class="th_deg">Edit</th>
            </tr>

            @php
                $counter = 1; 
            @endphp

            @foreach($product as $product)

            <tr>
                <td>{{$counter}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount_price}}</td>
                <td>
                    <img class="img_size" src="/product/{{$product->image}}">
                </td>
                <td>
                    <a class="btn btn-danger" onclick="return confirm('Are You Sure to Delete This')" href="{{url('delete_product', $product->id)}}">Delete</a>
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

    @include('admin.script')
  </body>
</html>