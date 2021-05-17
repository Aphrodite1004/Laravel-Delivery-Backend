<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Home Page</title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link href="{{ url('frontassets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/venobox/venobox.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link href="{{ url('frontassets/css/style.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/css/style2.css') }}" rel="stylesheet">
      <link href="{{ url('frontassets/css/style3.css') }}" rel="stylesheet">

   </head>
   <style type="text/css">
   </style>
   <body>
      @include("web.grocerysubheader")
      @include("web.grocerycategory_slider")
      <div class="container-fluid" style="margin-top: 25px;width: 91.5%;">
         <div class="row">
            <div class="col-xl-12">
               <div class="card shadow">
                  <h3 style="margin: 13px 0px 15px 15px;font-size: 22px;">Review Cart</h3>
               </div>
            </div>
         </div>
      </div>
      <style type="text/css">
         @media only screen and (max-width: 768px) {
         .saved_mob
         {
         width: 98% !important;overflow-x: scroll !important;
         }
         .saved_mob2
         {
         width: 1100px !important;
         }
         }
         @media only screen and (max-width: 1024px) {
         .saved_mob
         {
         width: 98% !important;overflow-x: scroll !important;
         }
         .saved_mob2
         {
         width: 1100px !important;
         }
         }
      </style>
   
      <div class="container-fluid" style="margin-top: 15px;width: 91.5%;">
         <div class="row" style="border-radius: 10px;">
            <div class="col-xl-12 saved_mob" >
               <table class="table table-striped shadow-lg saved_mob2" style="border-radius: 10px;">
                  <thead>
                     <tr>
                        <th scope="col" style="width: 40%;padding-left: 22px;">Item Detail</th>
                        <th scope="col" style="width: 15%;">Unit Price</th>
                        <th scope="col" style="width: 15%;">Qty</th>
                        <th scope="col" style="width: 15%;">SubTotal</th>
                        <th scope="col" style="width: 15%;">Action</th>
                     </tr>
                  </thead>
                  <tbody >
                     <?php  foreach($cartdata as $cartitemkey => $cartitem) { 
                        $productdetails = DB::table('product')->where(array('product_id' => $cartitem->product_id))->first();
                        $productvarient = DB::table('product_varient')->where(array('varient_id' => $cartitem->varient_id))->first();
                         $currency = DB::table('currency')->first();
                        ?>
                        <?php if(count($cartdata)==1){ ?>
                           <tr>
                        <th scope="row ycart_th">
                           <br>
                           <img src="<?php echo $productvarient->varient_image?>" class="ycart_img">
                           <div style="display: inline-block;margin-left: 15px;">
                              <p style="font-size: 17px;"><?php echo $productdetails->product_name ?></p>
                              <p class="ycart_p">Select Size: {{ $productvarient->quantity }} {{ $productvarient->unit }}</p>
                           </div>
                        </th>
                        <td>
                           <p class="ycart_price">{{ $currency->currency_sign}}. {{ $productvarient->price }}</p>
                        </td>
                        <td>
                           <div class="btn-group btn-group-sm outer_but772" style="margin-top: 20px;" role="group" aria-label="...">
                              <button class="plus-one inner_one{{$cartitemkey}}" onclick="getminus({{$productvarient->price }},{{$cartitem->cart_id}},{{$cartitemkey}})" ><i class="fas fa-minus inner_one_i2" ></i></button>
                              <button class="plus-middle inner_two{{$cartitemkey}}" ><span class="inner_two_span_cart_item{{$cartitemkey}}">{{ $cartitem->qty }}</span></button>
                              <button class="plus-two inner_three{{$cartitemkey}}" onclick="getplus({{$productvarient->price }},{{$cartitem->cart_id}},{{$cartitemkey}})"><i class="fas fa-plus inner_three_i2" ></i></button>
                           </div>
                        </td>
                        <td>
                           <p class="ycart_price" id="subtotal{{$cartitemkey}}">{{ $currency->currency_sign}}. {{ $cartitem->qty * $productvarient->price  }}</p>
                        </td>
                        <td><i class="fas fa-trash ycart_trash" onclick="groceryremovecartitem({{ $cartitem->cart_id}})"></i></td>
                     </tr>
                        <?php }else{?> 
                           <tr>
                        <th scope="row ycart_th">
                           <br>
                           <img src="<?php echo $productvarient->varient_image?>" class="ycart_img">
                           <div style="display: inline-block;margin-left: 15px;">
                              <p style="font-size: 17px;"><?php echo $productdetails->product_name ?></p>
                              <p class="ycart_p">Select Size: {{ $productvarient->quantity }} {{ $productvarient->unit }}</p>
                           </div>
                        </th>
                        <td>
                           <p class="ycart_price">{{ $currency->currency_sign}}. {{ $productvarient->price }}</p>
                        </td>
                        <td>
                           <div class="btn-group btn-group-sm outer_but772" style="margin-top: 20px;" role="group" aria-label="...">
                              <button class="plus-one inner_one{{$cartitemkey}}" onclick="getminus({{$productvarient->price }},{{$cartitem->cart_id}},{{$cartitemkey}})" ><i class="fas fa-minus inner_one_i2" ></i></button>
                              <button class="plus-middle inner_two{{$cartitemkey}}" ><span class="inner_two_span_cart_item{{$cartitemkey}}">{{ $cartitem->qty }}</span></button>
                              <button class="plus-two inner_three{{$cartitemkey}}" onclick="getplus({{$productvarient->price }},{{$cartitem->cart_id}},{{$cartitemkey}})"><i class="fas fa-plus inner_three_i2" ></i></button>
                           </div>
                        </td>
                        <td>
                           <p class="ycart_price" id="subtotal{{$cartitemkey}}">{{ $currency->currency_sign}}. {{ $cartitem->qty * $productvarient->price  }}</p>
                        </td>
                        <td><i class="fas fa-trash ycart_trash" onclick="removecartitem({{ $cartitem->cart_id}})"></i></td>
                     </tr>
                        <?php }?>
                
                     <?php }?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <main id="main" class="shadow" style="margin-top: 40px;">
         <!-- ======= About Section ======= -->
         <section id="about" class="about">
            <div class="container" style="margin-top: -50px;margin-bottom: -30px;">
               <div class="row">
                  <div class="col-xl-4 col-lg-4 d-flex justify-content-center align-items-stretch">
                     <div class="icon-box">
                        <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <h4 class="title"><a href="">Best Price & Offers</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 d-flex justify-content-center align-items-stretch">
                     <div class="icon-box">
                        <div class="icon"><i class="fas fa-inbox"></i></div>
                        <h4 class="title"><a href="">Wide Assorment</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 d-flex justify-content-center align-items-stretch">
                     <div class="icon-box">
                        <div class="icon"><i class="fas fa-rupee-sign"></i></div>
                        <h4 class="title"><a href="">Easy Return</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- End About Section -->
      </main>
      <!-- End #main -->
       @include("web.footer")
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
      <!-- Vendor JS Files -->
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
      <!-- Vendor JS Files -->
      <script src="{{ url('frontassets/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/php-email-form/validate.js') }}"></script>
      <script src="{{ url('frontassets/vendor/venobox/venobox.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/counterup/counterup.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
      <script src="{{ url('frontassets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
      <!-- Template Main JS File -->
      <script src="{{ url('frontassets/js/main.js') }}"></script>
   </body>
</html>
<script>
   function getminus(baseprice,cartid,count)
   {
      var data = $('.inner_two_span_cart_item'+count).html();
      
      if(data > 0)
      {
         var minusdata = parseInt(data) - 1;
          $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('updateqtycart') }}",
               type:"POST",
               data:{cartid: cartid,data:minusdata},
               success: function(result){
                if(result == 1)
                {
                    $('.inner_two_span_cart_item'+count).html(minusdata);
                    var total = parseFloat(baseprice) * parseFloat(minusdata);
                    $('#subtotal'+count).html('Rs. '+total);
                }else 
                {

                }
                }
            });
        
      }else 
      {
         $('.inner_two_span_cart_item'+count).html(0);
      }
      
     
   }
   function getplus(baseprice,cartid,count)
   {
      var data = $('.inner_two_span_cart_item'+count).html();
      
      var plusdata = parseInt(data) + 1;


          $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('updateqtycart') }}",
               type:"POST",
               data:{cartid: cartid,data:plusdata},
               success: function(result){
                if(result == 1)
                {
                    $('.inner_two_span_cart_item'+count).html(plusdata);
                     var total = parseFloat(baseprice) * parseFloat(plusdata);
                    $('#subtotal'+count).html('Rs. '+total);
                }else 
                {

                }
                }
            });
      
   }
   function groceryremovecartitem(cartid)
    {
      debugger;
         $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('removecartitem') }}",
               type:"POST",
               data:{cartid: cartid},
               success: function(result){
                    if(result == 1)
                    {
                      alert('Item Remove From Cart Successfully');
                      window.location.href="{{route('index')}}";
                    }else
                    {
                      alert('Somthing Went Wrong');
                      location.reload();
                    }
                }
            });
    }
</script>
<script>
   $(document).ready(function(){
     $('#owl-two').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:8
           }
       }
   })
    $( "#owl-two .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:20px;" >');
      $( "#owl-two .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:20px;" >');  
   });
   
   
</script>
<script>
   $(document).ready(function(){
     $('#owl-three').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:4          
                }
       }
   })
    $( "#owl-three .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:115px;" >');
      $( "#owl-three .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:115px;" >');  
   });
   
   
</script>
<script>
   $(document).ready(function(){
     $('#owl-four').owlCarousel({
       loop:true,
       margin:10,
       autoplay:true,
       nav:true,
   
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:1
           },
           1000:{
               items:3          
                }
       }
   })
    $( "#owl-four .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:145px;" >');
      $( "#owl-four .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:145px;" >');  
   });
   
   
</script>
<style type="text/css">
   .imgkl2{
   background-color: white;
   }
   .imgkl2:hover
   {
   background: white !important;
   }
</style>