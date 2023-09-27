<section class="product_section layout_padding">
         <div class="container" style="position: relative;">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">

               @foreach($product as $products)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="" class="option1">
                           Tambah
                           </a>
                           <a href="" class="option2">
                           Beli Sekarang
                           </a>
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
            <div class="btn-box" style="margin-top:100px; margin-bottom:0px; ">
               <a href="">
               View All products
               </a>
            </div> 
         </div>
</section>