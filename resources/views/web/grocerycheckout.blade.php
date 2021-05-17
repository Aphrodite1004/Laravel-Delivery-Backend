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
   @include("web.grocerysubheader")
   <br>
      <style type="text/css">
       
         @media only screen and (max-width: 768px) {
         .checkout_cardbody
         {
         width: 100%;margin-left: 0px !important;
         }
         .checkout_input
         {
         max-width:95%;
         }
         .checkout_next
         {
         width: 100%;
         margin-top: 15px;margin-left: 0px;
         }
         .checkout_order
         {
         width: 100%;
         }
         #nono
         {
         min-height: 320px;
         }
         #nono2
         {
         min-height: 80px;
         }
         }
      </style>
  

      <input type="hidden" name="razorpay_key" id="razorpay_key" value="">
      <div class="container-fluid checkout_cont">
         <div class="row">
         <div class="col-xl-8">
               <?php if(session('userid') == ''){ ?>
               <div class="card shadow checkout_card">
                  <div class="card-header checkoutcard_head">
                     <h4 class="checkout_h4"><span class="first_num3" style="background-color: #ECECEC;">1</span> Log In / Register <span style="float: right;position: relative;top: 5px;color: blue">Change</span></h4>
                  </div>
               </div>
               <div class="card shadow checkout_card">
                  <div class="card-header checkoutcard_head2">
                     <h4 style="color: white;font-weight: 500;font-size: 17px;"><span class="first_num3">1</span> Log In / Register</h4>
                  </div>
                  <div class="card-body checkout_cardbody" id="nono">
                     <h6 style="font-size: 17px;margin-top: 20px;">As A Guest User <span style="float: right;color: #3571B7;">Already Have An Account?</span></h6>
                     <p class="card-text" style="margin-top: 30px;color: #717171;font-weight: 500;font-size: 15px;">We need to verify your phone number so that we can update you about your order.</p>
                     <p style="font-size: 14px;font-weight: 500;">Enter Your 10 Digit Mobile Number</p>
                     <div class="input-group" style="height: 45px;margin-bottom: 20px;margin-top: -9px;">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">+91</span>
                        </div>
                        <input type="text" class="form-control checkout_input"  placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        <button class="checkout_next">NEXT</button>
                     </div>
                  </div>
               </div>
               <?php } else {

               $addressdetails = DB::table('user_address')
               ->join('city', 'user_address.city_id','=','city.city_id')
               ->join('area', 'user_address.area_id','=','area.area_id')
               ->where(array('user_id' => session('userid'),'select_status' => 1))->first();

                $addressdetailsdata = DB::table('user_address')->where(array('user_id' => session('userid')))->get();
               ?>

               <div class="card shadow checkout_card">
                  <div class="card-header checkoutcard_head">
                     <h4 class="checkout_h4"><span class="first_num3" style="background-color: #ECECEC;">2</span> Delivery Address</h4>
                  </div>
               </div>
               <div class="card shadow checkout_card">
                  <div class="card-header checkoutcard_head2" id="nono2">
                     <h4 style="color: white;font-weight: 500;font-size: 17px;"><span class="first_num3">2</span> Delivery Address <!-- <span style="float: right;position: relative;top: 10px;font-size: 14px;"><i class="fas fa-plus-circle"></i> Add New Address</span> --></h4>
                  </div>
                  
                  <div class="card-body checkout_cardbody">
                     <div class="row" style="margin-top: 20px;">
                         <div class="col-xl-12">
                      <label>Select Address</label>
                      <select class="form-control" name="addressselection" id="addressselection" onchange="selectaddress(this)">
                          <option >Select Address</option>
                          <?php foreach($addressdetailsdata as $addressdetailsdatanew){?>
                          <option value="{{$addressdetailsdatanew->address_id}}" <?php if($addressdetailsdatanew->address_id == $addressdetails->address_id){echo 'selected';}?>>{{$addressdetailsdatanew->address}}</option>
                          <?php }?>
                      </select>
                        </div>
                        </div>
                        <div class="row" style="margin-top: 20px;" id="addressattached">
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Name <span style="color: red">*</span></label>
                                 
                                  <input type="text" class="checkout_input22" id="user_name" name="deliveryname" value="<?php if(isset($addressdetails)){ echo $addressdetails->user_name;}?>">
                               </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Mobile <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="user_number" name="deliverymobile" value="<?php if(isset($addressdetails)){ echo $addressdetails->user_number;}?> ">
                               </div>
                            </div>
                       
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">City <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="city_name"  name="deliverycity" value="<?php if(isset($addressdetails)){ echo $addressdetails->city_name;}?>">
                               </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Area <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="area_name" name="deliveryarea" value="<?php if(isset($addressdetails)){ echo $addressdetails->area_name;}?>">
                                   
                               </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Flat / House No / Building Name <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="houseno"  name="deliveryhouse" value="<?php if(isset($addressdetails)){ echo $addressdetails->houseno;}?> ">
                               </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Address Line 1<span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="street" name="deliverylandmark" value="<?php if(isset($addressdetails)){ echo $addressdetails->street;}?>">
                               </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">Pincode <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="pincode" name="deliverypincode" value="<?php if(isset($addressdetails)){ echo $addressdetails->pincode;}?>">
                               </div>
                            </div>
   
                            
                            <div class="col-xl-6">
                               <div class="form-group">
                                  <label for="usr" style="font-size: 14px;font-weight: 500;">State <span style="color: red">*</span></label>
                                  <input type="text" class="checkout_input22" id="state"  name="deliverystate" value="<?php if(isset($addressdetails)){ echo $addressdetails->state;}?>">
                               </div>
                            </div>
                        </div>
                      
                     <hr style="border-bottom: 2px solid black">
               
                           <div class="col-xl-6">
                           <h5 style="margin-top: 20px;margin-bottom: 30px;">Payement Method</h5>
                              
                                 <div class="form-group">

                                 <label class="form-check-label" style="padding-left: 30px;">
                                 <input type="radio" class="form-check-input" name="types" id="COD" value="COD">Cash On Delivery</label>
                                </div>
                                <div class="form-group">

                                 <label class="form-check-label" style="padding-left: 30px;">
                                 <input type="radio" class="form-check-input" name="types" id="wallet" value="wallet"  >Payment By Wallet</label>
                                </div>
                           </div>
                           
                           
                     
                     
                     <div class="col-xl-6" id="paymentonline">
                        <h5 style="margin-top: 20px;margin-bottom: 30px;">Online Payment</h5>
                              <div class="form-group">
                                  <label class="form-check-label" style="padding-left: 30px;">
                                 <input type="radio" class="form-check-input" name="types" id="razorpay" value="Razorpay">Razorpay</label>
                              </div>
                             
                           </div>
                     <div class="col-xl-6">
                           <button class="checkout_continue" id="nextbutton">Continue</button>
                        </div>
                  </div>
               </div>
               <div class="card shadow checkout_card" id="timedate">
                  <div class="card-header checkoutcard_head">
                     <h4 class="checkout_h4"><span class="first_num3" style="background-color: #ECECEC;">3</span> Delivery Date & Time</h4>
                  </div>
               </div>
               <div class="card shadow checkout_card" style="background-color: #F7F7F7">
                  <div class="card-header checkoutcard_head2">
                     <h4 style="color: white;font-weight: 500;font-size: 17px;"><span class="first_num3">3</span> Delivery Date & Time</h4>
                  </div>
                  <?php
                     $firstday = date('d',time() + 86400);
                     $firstmonth = date('M',time() + 86400);
                     $firstdate = date('D',time() + 86400);
                     $secondday = date('d',time() + 172800);
                     $secondmonth = date('M',time() + 172800);
                     $seconddate = date('D',time() + 172800);
                     $thirdday = date('d',time() + 259200);
                     $thirdmonth = date('M',time() + 259200);
                     $thirddate = date('D',time() + 259200);
                  ?>
                  <div class="card-body checkout_cardbody">
                        <p><b>Choose a delivery slot</b></p>
                        <div class="row">
                           <div class="col-md-3">{{ date('M') }}</div>
                           <div class="col-md-3"><?php echo  $firstmonth ?></div>
                           <div class="col-md-3"><?php echo $secondmonth ?></div>
                           <div class="col-md-3"><?php echo $thirdmonth ?></div>
                        </div>
                        <div class="row" style="background-color: white">
                           <div class="col-md-3" onclick="gettimeslot('<?php echo  date('Y-m-d'); ?>','<?php echo $storeid  ?>')"><b>{{ date('d') }}</b></div>
                           <div class="col-md-3" onclick="gettimeslot('<?php echo date('Y-m-d',time()+86400); ?>','<?php echo $storeid  ?>')"><b><?php echo $firstday ?></b></div>
                           <div class="col-md-3" onclick="gettimeslot('<?php echo date('Y-m-d',time()+172800);?>','<?php echo $storeid  ?>')"><b><?php echo $secondday ?></b></div>
                           <div class="col-md-3" onclick="gettimeslot('<?php echo date('Y-m-d',time()+259200);?>','<?php echo $storeid  ?>')"><b><?php echo $thirdday ?></b></div>
                        </div>
                        <div class="row">
                           <div class="col-md-3"><?php echo $dayOfWeek = date("D", strtotime(date('Y-m-d')));?></div>
                           <div class="col-md-3"><?php echo $firstdate ?></div>
                           <div class="col-md-3"><?php echo $seconddate ?></div>
                           <div class="col-md-3"><?php echo $thirddate ?></div>
                        </div>
                        <div class="" id="timedataslot"></div>
                        <br><br>
                        <center>
                       
                        <hr style="border-bottom: 2px solid black;margin-top: 20px;width: 30%;margin-bottom: 20px;">
                        
                        <p style="color: #A6A6A6;font-size: 15px;" id="finaldeliveryaddress"></p>
                        <button class="checkout_order" onclick="placeorder()">Place Order</button>
                     </center>
                  </div>
               </div>
               <div class="modal fade" id="cong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <p style="font-size: 18px;margin-top: -15px;" id="orderid">150340001178606</p>
                              <a href="{{ route('index') }}"><button style="background-color: #1461C9;color: white;height: 47px;width: 64%;border-radius: 25px;font-size: 17px;margin-top: 13px;border: 0;font-weight: 500;margin-bottom: 20px;" class="shadow">Continue Shopping</button></a>
                           </center>
                        </div>
                     </div>
                  </div>
               </div>
               <?php }?>
            </div>
            <div class="col-xl-4">
               <div class="card shadow checkout_card">
                  <h6 style="padding:17px 15px 17px 15px"><i class="fas fa-shopping-cart" style="color: #4BA345;"></i> &nbsp;Your Cart <span style="float: right;position: relative;top: 3px;">({{count($cartitem)}} items)</span></h6>
               </div>
               <div class="card shadow checkout_card">

                  <?php if(isset($cartitem)){ $sum=0; foreach($cartitem as $cartitemkey => $cartitem) { 
                        $productdetails = DB::table('product')->where(array('product_id' => $cartitem->product_id))->first();
                        $productvarient = DB::table('product_varient')->where(array('varient_id' => $cartitem->varient_id))->first();

                        if($productvarient->varient_image == '')
                        {
                            $finalimage = $productdetails->product_image;
                        }else
                        {
                             $finalimage = $productvarient->varient_image;
                        }
                        ?>
                  <div class="row" style="min-width: 100%;margin-left: 0px;padding-top: 14px;">
                     <div class="col-sm-3" style="max-width: 20%;border-left: 10px solid #41CF2E;"><img src="<?php echo $finalimage; ?>" style="height: 60px;width: 80px;"></div>
                     <div class="col-sm-5" style="max-width: 45%;">
                        <p style="white-space: pre-line;font-size: 14px;margin-bottom: 3px;">{{$productdetails->product_name}}</p>
                        <div class="btn-group btn-group-sm outer_but772" role="group" aria-label="...">
                           Quantity : {{ $cartitem->qty }}
                        </div>
                     </div>
                     <div class="col-sm-4" style="max-width: 29.5%;">
                        <p id="price{{$cartitemkey}}"  style="font-size: 14px;font-weight: 500;">Rs.{{ $cartitem->qty * $productvarient->price }}</p>
                     </div>
                  </div>
                  <hr>
                  <input type="hidden" name="cartid[]" id="cartiddata" value="{{$cartitem->cart_id}}">
                  <?php $sum += $cartitem->qty * $productvarient->price; }}  ?>
               </div>
               <input type="hidden" id="subtotaldata" name="subtotaldata" value="{{$sum}}">
               <div class="card shadow checkout_card">
                  <h6 style="padding:17px 15px 17px 15px;width: 88%;">Subtotal: <span id="subtotal" style="float: right;position: relative;top: 3px;">Rs.{{$sum}}</span></h6>
                  <h6 style="padding:17px 15px 17px 15px;width: 88%;">Delivery Charge: <span id="charge" style="float: right;position: relative;top: 3px;">
                      <?php if ($delivery == null) {
                     $deliverycharges = 0;
                     echo   $deliverycharges;}
                     else
                     {
                        $deliverycharges =  $delivery->delivery_charge;
                        echo   $deliverycharges;
                     }

                      ?>
                      </span></h6>
                      <h6 style="padding:17px 15px 17px 15px;margin-top: -24px;width: 88%;">Total: <span id="total" style="float: right;position: relative;top: 3px;">Rs.<?php  echo $sum + $deliverycharges; ?></span></h6>
                  <input type="hidden"  id="finalamount" name="finalamount" value="<?php  echo $sum + $deliverycharges; ?>">
                   <input type="hidden"  id="subtotal" name="subtotal" value="<?php echo $sum; ?>">
                   <input type="hidden"  id="addressid" name="addressid" value="<?php if(isset($addressdetails)){ echo $addressdetails->address_id;}?>">
                   <input type="hidden" name="storeid" id="storeid" value="<?php echo $storeid;?>">
                   <input type="hidden" name="uitype" id="uitype" value="1">
                    <input type="hidden" name="deliverycharges" id="deliverycharges" value="<?php echo $deliverycharges;?>">
               </div>
            </div>
         </div>
      </div>
      <br><br>
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
      
      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <script type="text/javascript">
     function FillBilling(the) {
            
            var checkBox = document.getElementById(the);
             if($(the).prop('checked')) {
            
              $('input[name=billingname]').val($('input[name=deliveryname]').val());
              $('input[name=billingmobile]').val($('input[name=deliverymobile]').val());
              $('input[name=billinghouse]').val($('input[name=deliveryhouse]').val());
              $('input[name=billingarea]').val($('input[name=deliveryarea]').val());
              $('input[name=billinglandmark]').val($('input[name=deliverylandmark]').val());
              $('input[name=billingcity]').val($('input[name=deliverycity]').val());
              $('input[name=billingpincode]').val($('input[name=deliverypincode]').val());
              $('input[name=billingstate]').val($('input[name=deliverystate]').val());
              
 
            }
          }
 
          $("#nextbutton").click(function() {
             $('html,body').animate({
                scrollTop: $("#timedate").offset().top},
         'slow');
             });

 function gettimeslot(date,storeid)
  {
   debugger;
      $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         url: "{{ route('gettimeslot') }}",
         type:"GET",
         data:{datedata: date,storeid:storeid},
         success: function(result){
            $('#timedataslot').html(result);
         }
      });
  
   
  }
  function selectaddress(the)
  {
       $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      var addressid = $(the).val();
       $.ajax({
         url: "{{ route('selectaddress') }}",
         type:"POST",
         data:{addressid: addressid},
         success: function(result){
             var obj = JSON.parse(result);
           $('#houseno').val(obj.address.houseno);
           $('#street').val(obj.address.street);
           $('#state').val(obj.address.state);
           $('#pincode').val(obj.address.pincode);
           $('#city_name').val(obj.address.city_name);
           $('#area_name').val(obj.address.area_name);
            $('#addressid').val(obj.address.address_id);
            $('#finaldeliveryaddress').html(obj.address.address);
         }
      });
  }
  function getpaymentonlinemethod()
   {
      $('#paymentonline').css('display','block');
   }
   $("#COD"). click(function(){
$("#razorpay"). prop("checked", false);
});

function placeorder()
   {
      debugger;  
         var addressid     = $('#addressid').val();
         var subtotal      = $('#subtotaldata').val();
         var storeid       = $('#storeid').val();
         var uitype        = $('#uitype').val();
         var finalamount   = $('#finalamount').val();
         var paymentmethod = $("input[name='types']:checked").val();
         var onlinemethod  = $("input[name='onlinemethod']:checked").val();
         var deliverycharges = $("#deliverycharges").val();
         var deliverydate   = $("input[name='deliverydate']").val();
         var deliverytime   = $("input[name='timedelivery']:checked").val();
        
          if(addressid == '')
            {
                alert("Please Select Address");
            }else if(paymentmethod == undefined)
            {
                alert("Please Select Payment Method");
            }else if(deliverydate == undefined)
            {
                alert("Please Select Date ");
            }else if(deliverycharges == 0)
            {
                alert("Please Select Delivery Area by store ");
            }else if(deliverytime == undefined)
            {
                alert("Please Select Time Slot");
            }else
            {
               debugger;
              $.ajaxSetup({
                         headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                });
              $.ajax({
                   url: "{{ route('placeorder') }}",
                   type:"POST",
                   data:{addressid: addressid,subtotal:subtotal,storeid:storeid,uitype:uitype,finalamount:finalamount,paymentmethod:paymentmethod,deliverycharges:deliverycharges,deliverydate:deliverydate,deliverytime:deliverytime},
                   success: function(result){
                      if(result != 0)
                      {
                            $('#orderid').html(result);
                            $("#cong"). modal('show');  

                     
                         
                   } 
                }
                });
            }
          
   }
     </script>
   
   </body>
</html>