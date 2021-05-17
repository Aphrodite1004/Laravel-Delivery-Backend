<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Product Page</title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <!-- Vendor CSS Files -->
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
   <body id="productvar">
   @include("web.pharmacysubheader")
   @include("web.pharmacycategory_slider")

      <style type="text/css">
         .product_back
         {
         background: linear-gradient(rgba(0, 0, 0, .65), rgba(0, 0, 0, .65)), url('frontassets/img/back.jpeg');
         height: 100px;
         background-size: cover;background-position: 50% 50%;
         }
      </style>
      <div class="product_back">
         <center>
            <h4 style="color: white;padding-top: 33px;">Products</h4>
         </center>
      </div>
      <!-- <div class="container-fluid" style="width: 92.2%;">
         <img src="{{ url('frontassets/img/back2.jpg') }}" class="product_mainimg">
      </div> -->
      <style type="text/css">
         @media only screen and (max-width: 768px) {
         .select_gram
         {
         width: 100%; 
         }
         .product_sidebar
         {
         min-width:85% !important;margin-top: 61px;margin-left: 7px; 
         }
         .product_sidebar2
         {
         min-width:85% !important;margin-top: 20px;margin-left: 7px;
         }
         .product_mainimg
         {
         height: 150px;width: 100%;border-radius: 10px;margin-top: 30px;margin-bottom: 30px; 
         }
         }
      </style>
      <div style="background-color: #F4FBFE;">
         <div class="container-fluid" style="width: 92.2%;">
         <div class="row">
            <div class="col-lg-2">
                  <div class="card product_sidebar" id="categoryiddata">
                     <h5 class="side_filter" style="background-color: white;">Category </h5>
                     <div class="card-body side_price_scroll">
                        <form style="margin-left: -10px;">
                    
                           <?php $i= 1; foreach($category as $categorydata){?>
                           <input type="checkbox"  id="fruit<?php echo $i;?>" name="fruit-<?php echo $i;?>" value="<?php echo $categorydata->resturant_cat_id;?>" onclick="getproduct('<?php echo $i;?>','<?php echo $categorydata->resturant_cat_id;?>','')">
                           <label for="fruit<?php echo $i;?>"><?php echo $categorydata->cat_name;?></label>
                           <?php $i++;}?>
                      
                        </form>
                     </div>
                  </div>
              
               </div>
               <style type="text/css">
                  @media only screen and (max-width: 768px) {
.pro_mob29
{
min-width: 164% !important;
}
                  }

                  @media only screen and (max-width: 425px) {
.pro_mob29
{
min-width: 176% !important;
}
                  }


                                    @media only screen and (max-width: 375px) {
.pro_mob29
{
min-width: 152% !important;
}
                  }

                  .pro_mob29
{
min-width: 100%;   
}
               </style>
               <div class="col-lg-10">
                  <!-- ======= Team Section ======= -->
                  <section id="team" class="team section-bg">
                     <div class="container">
                        <div class="row" >
                        @if(count($product)>0)
                          @php $i=1; @endphp
                        @foreach($product as $products)
                           <div class="col-lg-3 col-md-6 d-flex align-items-stretch" >
                              <div class="member pro_mob29">
                              <a href="product_detail.php">
                                 <div class="member-img">
                                    <center>
                                    <a href="{{ route('pharmacyproductdetail',['id' =>$products['subcat_id'],'storeid' => $products['vendor_id']]) }}">
                                    <img src="{{ url(''.$products['products_image'])}}" class="img-fluid sel_img23new" alt="">
                                    </a>
                                    </center>
                                 </div>
                                 </a>
                                 <div class="member-info">
                                    <h4>{{ $products['product_name'] }}</h4>
                                    <select class="select_gram" name="varient_id" id="varient_id<?php echo $i;?>">
                                    @foreach($products['data'] as $varient)
                                       <option value="{{ $varient->variant_id }}">{{ $varient->quantity }}{{ $varient->unit }}</option>
                                       @endforeach
                                    </select>
                                    @foreach($products['data'] as $varient)
                                    @if ($loop->first)  
                                    <h4 class="h4_rupee" id="unshow-{{ $varient->product_id }}">{{$currency->currency_sign}}{{ $varient->price }}</h4> 
                                    <h4 class="h4_rupee " id="varientshow-{{ $varient->product_id }}"></h4> 
                                    @endif
                                    @endforeach
                              
                                    <div class="btn-group btn-group-sm outer_but772" role="group" aria-label="...">
                                 <button class="plus-one inner_one<?php echo $i; ?>" onclick="getminus('<?php echo $i; ?>')"><i class="fas fa-minus inner_one_i2"></i></button>
                                 <button class="plus-middle inner_two<?php echo $i; ?>"><span class="inner_two_span<?php echo $i; ?>">1</span></button>
                                 <button class="plus-two inner_three<?php echo $i; ?>" onclick="getplus('<?php echo $i; ?>')"><i class="fas fa-plus inner_three_i2"></i></button>
                              </div>
                                <?php if(session('userid') != '') { ?>
                              <button class="add_but" onclick="addtobag('{{ $products['vendor_id'] }}','<?php echo session('userid')?>','{{ $products['product_id'] }}','<?php echo $i?>')">Add to bag</button>
                              <?php }else { ?>
                              <button class="add_but" onclick="addtobag(0,0,0,0)">Add to bag</button>
                              <?php }?>
                                 </div>
                              </div>
                           </div>
                           @php $i++; @endphp
                           @endforeach
                           @else
                        <div>
                        <center><p style="color:red;">Product Not Found</p></center>
                        </div>
                      @endif
                        </div>
                     </div>
                  </section>
                  <!-- End Team Section -->
               </div>
              
            </div>
         </div>
      </div>
      <main id="main">
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
   $(document).ready(function(){

      $('select[name="varient_id"]').on('change', function() {
        
        var varient_id = $(this).val();
                debugger;
                $.ajax({
                    url: "getbypharmacyvarient/"+encodeURI(varient_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      debugger;
                      if ($.trim(data)){ 
                        var html = data[0].price;
                        var rowID = data[0].product_id;
                        $("#varientshow-"+rowID).html('Rs.'+html);
                        $("#unshow-"+rowID).hide();
                      }
                        
                    }
                });
           
    });


     $('#owl-one').owlCarousel({
       loop:true,
       margin:10,
       nav:true,
                       
   responsive: {
           0:{
               items:1
           },
           600:{
               items:4
           },
           1000:{
               items:7
           }
       }
   })
      $( ".owl-prev").html('<img src="{{ url("frontassets/img/l1.png")}}" height="45" style="margin-left:10px;margin-top:30px;" height="55"  class="imgkl2 shadow">');
      $( ".owl-next").html('<img src="{{ url("frontassets/img/r2.png")}}" height="45" style="margin-right:10px;margin-top:30px;" height="55" class="imgkl2 shadow">');
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
<script type="text/javascript">
   function getminus(count)
   {
      var data = $('.inner_two_span'+count).html();
      
      
      if(data > 0)
      {
         var minusdata = parseInt(data) - 1;
         $('.inner_two_span'+count).html(minusdata);
      }else 
      {
         $('.inner_two_span'+count).html(0);
      }
     
   }
   function getplus(count)
   {
      var data = $('.inner_two_span'+count).html();
      
      var plusdata = parseInt(data) + 1;
      $('.inner_two_span'+count).html(plusdata);
   }
   function addtobag(storeid,userid,pid,count)
   {
         if(userid == 0)
         {
            alert('Please Login !!!');
         }else
         {
            
            var qty = $('.inner_two_span'+count).html();
            var varient = $('#varient_id'+count+'').val();
            
            $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('pharmacyaddtobag') }}",
               type:"POST",
               data:{storeid:storeid,userid: userid,pid:pid,qty:qty,varient:varient},
               success: function(result){
                  if(result == 1)
                  {
                     alert('Product added to cart successfully');
                      location.reload();
                  }else if(result == 2){
                     alert('Product allready added to cart ');
                  }else
                  {
                     alert('Product not added to cart');
                  }

               }
            });
         }
         
   }
   function getproduct(count,cat_id,catidurl)
   {
     
      if ($('#fruit'+count).is(':checked'))
      {
         
         $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
         });
         $.ajax({
            url: "{{ route('pharmacygetproductlist') }}",
            type:"POST",
            data:{cat_id: cat_id},
            success: function(result){
               debugger;

              $("#productvar").html(result);
              
            }
         });
      }
      else
      {
        //  $.ajaxSetup({
        //              headers: {
        //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //              }
        //  });
        //  $.ajax({
        //     url: "{{ route('getproductlist') }}",
        //     type:"POST",
        //     data:{cat_id: catidurl},
        //     success: function(result){

        //       $('#prodctdetailsdiv').html(result);
              
        //     }
        //  });
      }

   }

</script>
<script type="text/javascript">
   var a = 0;
   $(window).scroll(function() {
   
   var oTop = $('#counter').offset().top - window.innerHeight;
   if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-value').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },
   
        {
   
          duration: 3000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }
   
        });
    });
    a = 1;
   }
   
   });
</script>
<script src="{{ url('frontassets/owlcarousel/owl.carousel.min.js') }}"></script>
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