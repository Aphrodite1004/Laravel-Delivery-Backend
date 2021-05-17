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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/4ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontassets/owlcarousel/owl.theme.default.min.css') }}">
    
   </head>
   <style type="text/css">
                  .store_font
                  {
                  font-size: 14px;margin-top: 5px;  
                  }
                  .store_font2
                  {
                  font-size: 14px;margin-top: -7px;  
                  }
               </style>
   <body>
      @include("web.grocerysubheader")
      @include("web.grocerycategory_slider")
      <!-- ======= Services Section ======= -->
      <section id="services" class="services section-bg">
         <div class="container-fluid" style="width: 92.2%;">
            <div class="section-title">
                    @if(count($category)>0)

               <h2>{{ $category[0]->vendor_name }}</h2>
               @else
               <p style="color:red;">Product Not Found</p>
                      @endif
            </div>
            <div class="row">
            @foreach($category as $category)
                  <div class="col-lg-3 col-md-6">
                 
                    <div class="icon-box" >
                     <a href="{{url('groceryproduct')}}/{{$category->category_id}}" style="color: black">
                     
                        <img src="{{ url(''.$category->category_image)}}" width="100%">
                        <br><br>
                        <center><h4><span style="color: #41CF2E;">{{ $category->category_name }}</span></h4></center> <br>
                        </a>
                  </div>
                 
               </div>
               @endforeach
            </div>
         </div>
      </section>
      <!-- End Services Section -->
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
    $( "#owl-two .owl-nav .owl-prev").html('<img src="{{ url('frontassets/image/l1.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;left:8px;top:5px;" >');
      $( "#owl-two .owl-nav .owl-next").html('<img src="{{ url('frontassets/image/r2.png') }}" height="35" class="shadow" style="border-radius:50%;position:absolute;right:8px;top:5px;" >');  
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