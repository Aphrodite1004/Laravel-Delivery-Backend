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
      <script src="{{ url('frontassets/vendor/jquery/jquery.min.js') }}"></script>
    
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

      @include("web.parcelsubheader")
      @include("web.parcelcategory_slider")
      
      <!-- ======= Services Section ======= -->
      <section id="services" class="services section-bg">
         <div class="container-fluid" style="width: 92.2%;padding-top: 55px;">
            <div class="section-title">
               <h2>{{ $category[0]->vendor_name }}</h2>
            </div>
            <div class="row">
            <div class="col-md-3"></div>
            <div class="card col-md-6">
            <div class="card-body">
            <form method="POST" action="{{ route('addorder') }}">
              <input type="hidden" name="sessionuserid" id="sessionuserid"  value="@if(session('orderid') != ''){{session('orderid')}} @endif">
             {{ csrf_field()}}

           
            
             <div class="modal fade " id="cong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="top: 50px;">
                       <div class="modal-content">
                          <div class="modal-header" style="border-bottom: 0">
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             </button>
                          </div>
                          <div class="modal-body" style="padding: 30px 20px 20px 40px;">
                             <center>
                                <!-- <img src="assets/img/cong.PNG" style="height: 150px;margin-top: -50px;margin-bottom: 20px;"> -->
                                <h3 style="color: #4BA345;">Congratulations!</h3>
                                <h3 style="margin-top: -2px;"><b>Your Order Has Been Placed</b></h3>
                                <p style="font-size: 18px;font-weight: 500;">Order ID :</p>
                                <p style="font-size: 18px;margin-top: -15px;" id="orderid">{{session('orderid')}}</p>
                               <button style="background-color: #1461C9;color: white;height: 47px;width: 64%;border-radius: 25px;font-size: 17px;margin-top: 13px;border: 0;font-weight: 500;margin-bottom: 20px;" class="shadow"> <a href="{{ route('parcalindex') }}">Continue Shopping</a></button>
                             </center>
                          </div>
                       </div>
                    </div>
                 </div>

           
               <!--  <div class="col-md-2"></div> -->
               <input type="hidden" name="storeid" value="{{$storeid}}" id="storeid">
                <input type="hidden" name="praceldetailid" value="{{$praceldetailid}}" >
               
            
                
             
                <div class="row" style="padding-top: 10px">
                  <div class="col-md-6"><h5>Sender Address</h5><hr></div>
                  
                  <div class="col-md-6"><h5>Receiver Address</h5><hr></div>
                  
                  <div class="col-md-3">Name</div>
                  <div class="col-md-3">{{$sourceaddress->source_name}}</div>
                   <div class="col-md-3">Name</div>
                  <div class="col-md-3">{{$recieveraddress->destination_name}}</div>
                   <div class="col-md-3">Phone</div>
                  <div class="col-md-3">{{$sourceaddress->source_phone}}</div>
                   <div class="col-md-3">Phone</div>
                  <div class="col-md-3">{{$recieveraddress->destination_phone}}</div>
                   <div class="col-md-3">House Number</div>
                  <div class="col-md-3">{{$sourceaddress->source_houseno}}</div>
                   <div class="col-md-3">House Number</div>
                  <div class="col-md-3">{{$recieveraddress->destination_houseno}}</div>
                   <div class="col-md-3">Landmark</div>
                  <div class="col-md-3">{{$sourceaddress->source_landmark}}</div>
                  <div class="col-md-3">Landmark</div>
                  <div class="col-md-3">{{$recieveraddress->destination_landmark}}</div>
                   <div class="col-md-3">Address</div>
                  <div class="col-md-3">{{$sourceaddress->source_add}}</div>
                  <div class="col-md-3">Address</div>
                  <div class="col-md-3">{{$recieveraddress->destination_add}}</div>
                   <div class="col-md-3">City</div>
                  <div class="col-md-3">{{$sourceaddress->source_city}}</div>
                  <div class="col-md-3">City</div>
                  <div class="col-md-3">{{$recieveraddress->destination_city}}</div>
                   <div class="col-md-3">State</div>
                  <div class="col-md-3">{{$sourceaddress->source_state}}</div>
                   <div class="col-md-3">State</div>
                  <div class="col-md-3">{{$recieveraddress->destination_state}}</div>
                </div>

                 <br><br>
                <h5>Parcel Description</h5>
                <hr>
                <div class="row" style="padding-top: 10px">
                 
                  <div class="col-md-3">Parcel Weight</div>
                  <div class="col-md-9">{{$parceldetails->weight}} KG</div>
                   <div class="col-md-3">Parcel Dimension</div>
                  <div class="col-md-9">{{$parceldetails->length}} * {{$parceldetails->width}} * {{$parceldetails->height}}</div>
                   <div class="col-md-3">Parcel Description</div>
                  <div class="col-md-9">{{$parceldetails->description}} </div>
                    <div class="col-md-3">Pickup Date </div>
                  <div class="col-md-9">{{$parceldetails->pickup_date}} </div>
                    <div class="col-md-3">Pickup Time</div>
                  <div class="col-md-9">{{$parceldetails->pickup_time}} </div>
                  
                   
                   
                   
                  
                </div>
                 <br><br>
                <h5>Payment Info</h5>
                <hr>
                <div class="row" style="padding-top: 10px">
                 
                  <div class="col-md-3">Parcel Charges</div>
                  <div class="col-md-9">{{$parceldetails->charges}} </div>
                </div>
                 <br><br>
                <h5>Select Payment Method</h5>
                <hr>
                <div class="row" style="padding-top: 10px">
                 
                  <div class="col-md-3"><input type="radio" name="paymentmethod" value="cash">&nbsp;&nbsp;Cash</div>
                  <div class="col-md-9"></div>
                </div>
                <div class="row">
                  <div class="col-md-4"></div>
                 <div class="col-md-4"><input type="submit" name="" class="cont_mainbtn"></div>
               </div>
            </form>
              </div>
               </div>
            </div>
            </div>
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
      var sessionuserid = $('#sessionuserid').val();
    
      if(sessionuserid == '')
      {
       
      }else{
         $('#cong').modal('show');
      }
   });
   function gettimeslot(the)
   {
    var date = $(the).val();
    var storeid = $('#storeid').val();
        $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
        $.ajax({
           url: "{{ route('parcelgettimeslot') }}",
           type:"GET",
           data:{datedata: date,storeid:storeid},
           success: function(result){
              $('#pickuptime').html(result);
           }
        });
   }
   
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