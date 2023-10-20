<section class="product_section layout_padding">
         <div class="container" style="position: relative;">
            <div class="heading_container heading_center">
               <h2>
                  Produk <span>Kami</span>
               </h2>

               <br><br>

               <div style="margin-bottom: 50px;">
                  <form action="{{url('product_search')}}" method="GET" style="display: inline-block; margin-right: 10px;">
                     <input style="width: 280px; height:44px;" type="text" name="search" placeholder="Cari Produk Apa?">
                     <input type="submit" value="Cari" name="" id="" style="display: inline-block; transition: box-shadow 0.3s;" onmouseover="this.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5)';" onmouseout="this.style.boxShadow = 'none';">
                  </form>
               </div>

               <div class="category-buttons">
                  <a href="{{ url('products1') }}" class="category-button">Semua</a>
                  <a href="{{ url('category_bahankue1') }}" class="category-button">Bahan Kue</a>
                  <a href="{{ url('category_bumbudapur1') }}" class="category-button">Bumbu Dapur</a>
                  <a href="{{ url('category_peralatandapur1') }}" class="category-button">Peralatan Dapur</a>
                  <a href="{{ url('category_plastik1') }}" class="category-button">Plastik</a>
                  <a href="{{ url('category_aksesoris1') }}" class="category-button">Aksesoris</a>
               </div>
            </div>

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
            @endif
            
            <div class="row">

               @foreach($product as $products)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details', $products->id)}}" class="option1">
                           Detail Produk
                           </a>

                           <form action="{{url('add_cart', $products->id)}}" method="Post" class="product_section form">
                              @csrf
                              <div class="row">

                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" class="product_section input" >
                                 </div>

                                 <div class="col-md-4" >
                                    <input style="" type="submit" value="Tambah Keranjang" class="product_section options option2">
                                 </div>
                              
                              </div>
                           </form>
                           
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>

                        @if($products->discount_price!=null)

                        <h6 style="color:red">
                           Discount price
                           <br>
                           Rp{{$products->discount_price}}
                        </h6>

                        <h6 style="text-decoration: line-through;">
                           <!-- Price <br>--> 
                           Rp{{$products->price}}
                        </h6>

                        @else
                        <h6>
                           <!-- Price <br>--> 
                           Rp{{$products->price}}
                        </h6>

                        @endif

                        
                     </div>
                  </div>
               </div>

               @endforeach

               <span style="padding-top: 20px;  margin-bottom:80px; position:absolute; bottom:0; left:50%; transform:translateX(-50%); ">

               {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
               
               </span>

            </div>
            <div class="btn-box" style="margin-top:100px; margin-bottom:-50px; ">
               <a href="">
               Lihat Semua
               </a>
            </div> 
         </div>
</section>



