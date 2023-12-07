<!DOCTYPE html>
<html lang="en">
  <head>

  @include('admin.css')

  <style type="text/css">
    .div_center
    {
      text-align: center;
      padding-top: 40px;
    }
    
    .h2_font
    {
      font-size: 40px;
      padding-bottom: 40px;
    }

    .input_color
    {
      color: black;
    }

    .center{
      margin: auto;
      width: 50%;
      text-align: center;
      margin-top: 30px;
      border: 2px solid grey;
      
    }

    tr, td 
    {
        border: 2px solid grey;
    }

    .table-title
    {
      background-color: #191c24;
      width: 100px;
      height: 50px;
    }

    @media (max-width: 767px) {
        .center{
          width: 80%;
          
        }
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

            <div class="div_center">
                <h2 class="h2_font">Tambah Kategori</h2>

                <form action="{{url('/add_category')}}" method="POST">
                  @csrf
                  <input class="input_color" type="text" name="category" placeholder="Tulis Nama Kategori">
                  <input type="submit" class="btn btn-primary" style="margin-left: 5px;" name="submit" value="Tambah">
                </form>

            </div>

              <table class="center">

                <tr>
                  <td class="table-title">Kategori</td>
                  <td class="table-title">Hapus</td>
                </tr>

                @foreach($data as $data)

                <tr>

                  <td style="height: 50px;">{{$data->category_name}}</td>
                  
                  <td>

                    <a onclick="return confirm('Apakah Kamu Yakin ingin Menghapus Kategori Ini?')" class="btn btn-danger" href="{{url('delete_category', $data->id)}}">Hapus</a>

                  </td>

                </tr>

                @endforeach

              </table>

          </div>
    </div>
    @include('admin.script')


  </body>
</html>