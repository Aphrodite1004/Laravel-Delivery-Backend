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
   <body>
   @include("web.pharmacysubheader")
   @include("web.pharmacycategory_slider")

      <div class="container-fluid" style="width: 91%;margin-top: 14px;">
         <div class="row">
            <div class="col-lg-12">
              <!--  <p style="font-size: 14px;"><b>Home</b> &nbsp;<i class="fas fa-chevron-right" style="font-size: 12px;"></i> <span style="color: #41CF2E;">Amul Pasturised Butter</span></p> -->
            </div>
         </div>
      </div>


      <!-- ======= Hero Section ======= -->
      <section class="d-flex align-items-center" style="background-color: white !important;">
         <div class="container-fluid" style="margin-top: -10px;">
            <div class="row">

               <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                  <center>
                  	<input type="hidden" name="getcountdata" id="getcountdata" value="<?php echo count($productdetails);?>">
                     <div class="prodiv98">

                        @foreach($productdetails as $key => $value)
                        @if($key==0)
                     	
                        <img src="{{ url(''.$value->product_image)}}" alt="" id="big{{$key}}" class="pro_detone">
                           @else
                       	<img src="{{ url(''.$value->product_image)}}" alt="" id="big{{$key}}" class="pro_detone" style="display:none;">
                          @endif
                          @endforeach

                     </div>
                     <br><br>
                     <div class="row" style="width: 85%;">
                    
                                                 @foreach($productdetails as $key => $value)

                        <div class="col-xl-3 mob_img34">
                           <div class="card shadow s{{$key}} pro_detcard"  style="border: 2px solid">
                              <img src="{{ url(''.$value->product_image)}}" alt="" id="small{{ $key}}" onclick="getdata('<?php echo $key?>','<?php echo count($productdetails)?>','<?php echo $value->product_id;?>',<?php echo $storeid;?>)" class="pro_detimg99">
                           </div>
                           <div class="shadow pro_detshadow"></div>
                        </div>
                        @endforeach

                       
                     </div>
                  </center>
               </div>

       <!-- add code -->

               @if(count($productvarient)>0)
               @foreach($productvarient as $products)
               @if($loop->first)  


               <div class="col-lg-6 order-2 order-lg-2 hero-img right_prodiv" id="productdetaildata">
                  <h3 id="productname">{{$products['product_name']}}</h3>
                  <p style="margin-top: 19px;font-size: 15px;" ><b>Select Size:</b></p>
                  <select class="select_gram23 shadow-sm" id="productvar" onchange="changeproductdeatils(this,<?php echo $storeid;?>)">
                        @foreach($products['data'] as $varient)

                     <option value="<?php echo $varient->variant_id;?>"><?php echo $varient->quantity.''.$varient->unit;?></option>
                     @endforeach
                  </select>
                  @foreach($products['data'] as $varient)
                                    @if($loop->first)  
                  <input type="hidden" name="piddata" id="piddata" value="<?php echo $varient->product_id;?>">
                  <input type="hidden" name="varientiddata" id="varientiddata" value="<?php echo $varient->variant_id;?>">
                  <h3 style="margin-top: 25px;"><b ><span id="pricedata">{{ $currency->currency_sign}}.<?php echo $varient->price;?></span></b></h3>
                  <p style="margin-bottom: 10px;font-size: 14px;margin-top: -6px;color: #37A235;"><!-- Extra ₹60 discount --></p>
               
                  <div class="btn-group btn-group-sm outer_but772new shadow"  style="border-radius: 30px;" role="group" aria-label="...">
                     <button class="inner_one2new" onclick="getminus()"><i class="fas fa-minus inner_one_i2new"></i></button>
                     <button class="inner_two2new"><span class="inner_two_span2new">1</span></button>
                     <button class="inner_three2new" onclick="getplus()"><i class="fas fa-plus inner_three_i2new"></i></button>
                  </div>
                  <?php if(session('userid') != '') { ?>
                  <button class="add_butnew shadow" onclick="addtobag(<?php echo session('userid') ?>,<?php echo $storeid;?>)">Add to bag</button>
                  <?php }else {?>
                  	<button class="add_butnew shadow" onclick="addtobag(0,0)">Add to bag</button>
                  		
                  <?php }?>

                  @endif
                  @endforeach
                  <h5 style="margin-top: 42px;">Product Description :</h5>
                  <p style="width: 90%;font-size: 13px;margin-top: 13px;color: #A6A6A6" id="description">{{$products['description']}}</p>
               </div>
               @endif
               @endforeach
               @else
               <h3 style="padding-left:803px;color:red">Product Not Avialable.</h3>
               @endif
            </div>
         </div>
      </section>
      <!-- End Hero -->
      <hr>

      <main id="main" class="shadow">
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
   $(document).ready(function(){
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
   .imgkl{
   background-color: white;
   }
   .imgkl:hover
   {
   background: white !important;
   }
   .imgkl2{
   background-color: white;
   }
   .imgkl2:hover
   {
   background: white !important;
   }
</style>
<script type="text/javascript">
	function getminus()
   {
   		
      var data = $('.inner_two_span2new').html();
      if(data > 0)
      {
         var minusdata = parseInt(data) - 1;
         $('.inner_two_span2new').html(minusdata);
      }else 
      {
         $('.inner_two_span2new').html(0);
      }
     
   }
   function getplus()
   {
      var data = $('.inner_two_span2new').html();
      
      var plusdata = parseInt(data) + 1;
      $('.inner_two_span2new').html(plusdata);
   }
   function  changeproductdeatils(the,storeid) {
   		var varientid = $(the).val();
   		$.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
         });
         $.ajax({
            url: "{{ route('getpharmacydetailschange') }}",
            type:"POST",
            data:{varientid: varientid,storeid:storeid},
            success: function(result){
            	var obj = JSON.parse(result);
               $('#pricedata').html('Rs.'+obj.price);
               $('#piddata').val(obj.pid);
               $('#varientiddata').val(varientid);
              
            }
         });
   }
   function addtobag(userid,storeid)
   {
   		if(userid == 0)
   		{
   			alert('Please Login !!!');
   		}else
   		{
   			var pid = $('#piddata').val();
   			var qty = $('.inner_two_span2new').html();
   			var varient = $('#varientiddata').val();
   			
   			$.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
         	});
	         $.ajax({
	            url: "{{ route('pharmacyaddtobag') }}",
	            type:"POST",
	            data:{userid: userid,pid:pid,qty:qty,varient:varient,storeid:storeid},
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
   function  getdata(iddata,count,pid,storeid) {
   		for(var i = 0;i <= count; i++)
		{
			if(iddata == i)
			{
 				$("#big"+i).show('slow');
 				$(".s"+i).css('border','2px solid');
			}else
			{
				$("#big"+i).hide('slow');
				$(".s"+i).css('border','1px solid #DFDFDF');
			}
		}

   		$.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
         });
         $.ajax({
            url: "{{ route('pharmacygetproductdata') }}",
            type:"POST",
            data:{pid: pid,storeid:storeid},
            success: function(result){
               var obj = JSON.parse(result);
               debugger;
               var html = "";
               for(var i=0;i<obj.productvarient[0].data.length;i++){ 
               html+="<option value="+obj.productvarient[0].data[i].varient_id+">"+obj.productvarient[0].data[i].quantity+obj.productvarient[0].data[i].unit+"</option>";
              }
               $("#productvar").html(html);
               $('#productname').html(obj.productvarient[0].product_name);
               $('#pricedata').html('Rs.'+obj.productvarient[0].data[0].price);
               $('#description').html(obj.productvarient[0].data[0].description);
              
            }
         });
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