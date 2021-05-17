<!DOCTYPE html>
<html>
   <head>
      <title>profile</title>
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
   <body>
   @include("web.groceryheader")
      <div style="background-color: #F5F5F5;">
         <div class="container-fluid con_cont12">
            <div class="row">
               <div class="col-sm-4">
                  <div class="card shadow cont_card11">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item" >
                           <div class="row">
                              <div class="col-sm-3">
                                 <img src="{{ url(''.$profile->user_image)}}" class="contt_img43">
                              </div>
                              <div class="col-sm-9">
                                 <p class="cont_yname00">{{$profile->user_name}} &nbsp;<i class="far fa-check-circle" style="color: #66A74B;"></i></p>
                                 <p class="cont_ygmail00">{{$profile->user_phone}}</p>
                                 <p class="cont_ygmail00">{{$profile->user_email}}</p>
                              </div>
                           </div>
                        </li>
                        <li class="list-group-item con_accback">
                           <p style="font-size: 14px;">Accounts Credits <span class="con_accprice">Rs.{{$profile->wallet_credits}}</span></p>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                           <p class="cont_ptitle3">Personal Details<i class="fas fa-chevron-right cont_picon3"></i></p>
                           <p class="cont_psec3">Update name, mobile , email or change password</p>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                           <p class="cont_ptitle3">Address <i class="fas fa-chevron-right cont_picon3"></i></p>
                           <p class="cont_psec3">Add or remove a delivery address</p>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-wallet-tab" data-toggle="tab" href="#nav-wallet" role="tab" aria-controls="nav-wallet" aria-selected="false">
                           <p class="cont_ptitle3">Wallet <i class="fas fa-chevron-right cont_picon3"></i></p>
                           <p class="cont_psec3">Add Amount </p>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-reward-tab" data-toggle="tab" href="#nav-reward" role="tab" aria-controls="nav-reward" aria-selected="false">
                           <p class="cont_ptitle3">Rewards<i class="fas fa-chevron-right cont_picon3"></i></p>
                           <p class="cont_psec3"> </p>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-refer-tab" data-toggle="tab" href="#nav-refer" role="tab" aria-controls="nav-refer" aria-selected="false">
                           <p class="cont_ptitle3">Refer Friends <i class="fas fa-chevron-right cont_picon3"></i></p>
                           <p class="cont_psec4">Get RS.50 FREE</p>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-term-tab" data-toggle="tab" href="#nav-term" role="tab" aria-controls="nav-term" aria-selected="false">
                           <div class="row">
                              <div class="col-sm-1"><i class="fas fa-circle-notch contlefticon" style="background-color: #28A745;"></i></div>
                              <div class="col-sm-10">
                                 <p class="cont_delsame">Term & Conditions <i class="fas fa-chevron-right cont_arrowdel"></i></p>
                              </div>
                           </div>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-support-tab" data-toggle="tab" href="#nav-support" role="tab" aria-controls="nav-support" aria-selected="false">
                           <div class="row">
                              <div class="col-sm-1"><i class="fas fa-truck contlefticon"></i></div>
                              <div class="col-sm-10">
                                 <p class="cont_delsame"> Support <i class="fas fa-chevron-right cont_arrowdel"></i></p>
                              </div>
                           </div>
                           </a>
                        </li>
                        <li class="list-group-item" >
                        <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">
                           <div class="row">
                              <div class="col-sm-1"><i class="fas fa-lock contlefticon" style="background-color: #FFC107"></i></div>
                              <div class="col-sm-10">
                                 <p class="cont_delsame">About us<i class="fas fa-chevron-right cont_arrowdel"></i></p>
                              </div>
                           </div>
                           </a>
                        </li>
                        <!-- <li class="list-group-item" >
                           <div class="row">
                              <div class="col-sm-1"><i class="fas fa-blender-phone contlefticon"></i></div>
                              <div class="col-sm-10">
                                 <p class="cont_delsame">Contact <i class="fas fa-chevron-right cont_arrowdel"></i></p>
                              </div>
                           </div>
                        </li> -->
                   
                      
                     </ul>
                  </div>
               </div>



               <div class="col-sm-8">
               @if (Session::has('message'))
                   <div class="alert alert-success">
                       <ul>
                          {!! Session::get('message') !!}
                       </ul>
                   </div>
               @endif
               <div class="tab-content" id="nav-tabContent">

               <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <form method="POST" action="{{ route('webupdateprofile') }}">
                        {{ csrf_field() }}
                  <div class="card shadow cont_card22">
                 
                     <p class="cont_tellus">Personal Details</p>
                     <p class="cont_para54">Name</p>
                     <input type="" class="cont_input54" name="username" placeholder="Your First name" value="{{$profile->user_name}}">
                     <p class="cont_para54">Mobile Number</p>
                     <input type="" class="cont_input54" name="mobilenumber" placeholder="Enter Mobile Number" value="{{$profile->user_phone}}">
                     <p class="cont_para54">Email Address</p>
                     <input type="" class="cont_input54" name="useremail" placeholder="Enter Email Address"  value="{{$profile->user_email}}">
                       <p class="cont_para54">Password</p>
                     <input type="" class="cont_input54" name="password1" placeholder="Enter password">
                     <p class="cont_para54">Confirm Password</p>
                     <input type="" class="cont_input54" name="password2" placeholder="confirm password">
                     <button class="cont_mainbtn" style="font-size: 14px;">Save Changes</button>
                  </div>
                  </form>

                  </div>
           
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                  <div class="card shadow cont_card22">
                  <p class="cont_tellus">Delivery Address<span class="addnew_acc"><a href="{{ route('addaddressdetails')}}"><i class="fas fa-plus"></i> Add New Address</a></span></p>
                     <div class="container-fluid" style="margin-left: 8px;width: 98.6%;">
                        <div class="row" >
                           <?php foreach($address as $address){?>
                           <div class="col-xl-6">
                              <div class="card">
                                 <div class="card-header">
                                    <b> {{ $address->user_name}}</b>
                                 </div>
                                 <div class="card-body">
                                    <p style="font-weight: 400;font-size: 15px;color: #666;margin-top: -10px;"> {{ $address->address}}</p>

                                    <p style="font-weight: 400;font-size: 15px;color: #666;margin-top: 1px;">{{ $address->user_number}}</p>
                                    <p class="myaccount_para99">{{ $address->type}}</p>
                                 </div>
                              </div>
                              <p class="myaccount_add"><?php if($address->select_status == 1){?>Default Address<?php } else {?><a onclick="setaddress({{ $address->address_id}})">Set Default Address</a><?php }?> <span style="float: right;"><a href="{{ route('updateaddressdetails', $address->address_id)}}">Edit Address</a></span> </p>
                           </div>
                           <?php }?>
                        </div>
                     </div>
 
                  </div>
                  </div>


                  <div class="tab-pane fade" id="nav-wallet" role="tabpanel" aria-labelledby="nav-profile-tab">

               <div class="card shadow cont_card22">
               <p class="cont_tellus">Wallet</p>
               <div class="container-fluid" style="margin-left: 8px;width: 98.6%;">
                  <div class="row" >
                     <div id="paymentsuccess"></div>
                          <span style="padding-left:20px;"><span id="wallettotamount"><b>Total Wallet Amount: Rs. {{ $wallet}}</b></span></span><br><br>
                        <div class="col-md-3">
                        
                        <button class="cont_mainbtn" style="font-size: 14px;" onclick="openrechargediv()">Recharge wallet</button>

                        <br><br>
                        <div id="rechargediv" style="display:none;">
                            <label>Amount</label>
                            
                            <input type="text" class="form-control" id="amountrecharge">
                             <br><br>
                            <button class="btn btn-primary" onclick="getpayment()">Payment</button>
                            <br><br>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               </div>

               <div class="tab-pane fade" id="nav-reward" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card shadow cont_card22"> 
               <p class="cont_tellus">Rewards</p>   
               <span style="padding-left:20px;"><b>Total Reward Points: {{ $reward}}</b></span><br><br>
                       <?php if($reward > 0){?>
                       <div class="col-md-3">
                       <button class="cont_mainbtn" style="font-size: 14px;" onclick="reedempoint({{ $reward}})">Redeem</button>
                       </div>
                       <?php }else{?>
                       <div class="col-md-3">
                       <button class="cont_mainbtn" style="font-size: 14px;">Redeem</button>
                       </div>
                       <?php }?>
               </div>
               </div> 

               <div class="tab-pane fade" id="nav-refer" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card shadow cont_card22"> 
               <p class="cont_tellus">Refer Friends</p> 
               <span style="padding-left:20px;">Share Your the code below or ask them to enter it during they Signup.Earn when your friends Signup on our app.</span><br><br>
             
               <div class="col-md-3">
              <input type="" class="cont_input54" value="{{$profile->referral_code}}" id="myInput" onclick="myFunction()" readonly>
              Tap to copy
              </div>
              <!-- <button class="cont_mainbtn" style="font-size: 14px;">Invite Friends</button> -->
               </div>
               </div>

               <div class="tab-pane fade" id="nav-term" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card shadow cont_card22"> 
               <p class="cont_tellus">Term & Conditions</p> 
               <div class="row" >
               @foreach($termcondition as $termcondition)
               <div>{!!$termcondition->termcondition!!}</div>
               @endforeach
               </div>
               </div>
               </div>

               <div class="tab-pane fade" id="nav-support" role="tabpanel" aria-labelledby="nav-profile-tab">
               <form method="POST" action="{{ route('websupport') }}">
                        {{ csrf_field() }}
               <div class="card shadow cont_card22"> 
               <p class="cont_tellus">Support</p> 
               <span style="padding-left:20px;"><b>Or Write us your queries</b></span>
               <span style="padding-left:20px;">your words means a lot to us.</span>
               <input type="hidden" name="userid" id="userid" value="{{ session('userid')}}">
               <p class="cont_para54">Mobile Number</p>
                     <input type="" class="cont_input54" name="user_number" placeholder="Enter Mobile Number" value="{{$profile->user_phone}}">
                     <p class="cont_para54">Your Message</p>
                     <input type="" class="cont_input54" name="message" placeholder="Enter Your Message"  value="">
                     <button class="cont_mainbtn" style="font-size: 14px;">Submit</button>
               </div>
               </form>
               </div>

               <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="card shadow cont_card22"> 
               <p class="cont_tellus">About Us</p> 
               <div class="row" >
               @foreach($about as $about)
               <div>{!!$about->termcondition!!}</div>
               @endforeach
               </div>
               </div>
               </div>

               </div>
            </div>
         </div>
      </div>
      <input type="hidden" name="userid" id="userid" value="{{ session('userid')}}">
      @include("web.footer")
   </body>
</html>
<style>
.nav-item.nav-link.active{
   background-color: #EFF2F5;
}
</style>

<script type="text/javascript">
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
function getorderdetails(orderid)
{
      $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
      $.ajax({
         url: "{{ route('orderideatils') }}",
         type:"POST",
         data:{orderid: orderid},
         success: function(result){
            var obj = JSON.parse(result);
            debugger;
           $('#username').html(obj.address.user_name);
           $('#usernumber').html(obj.address.user_number);
           $('#useraddress').html(obj.address.address);
           $('#orderstatus').html(obj.order.order_status);
           $('#paymentmethod').html(obj.order.payment_method);
           $('#paymentmethod').html(obj.order.payment_method);
           $('#orderid').val(obj.order.order_id);
           $('#storename').html(obj.store.vendor_name);
           $('#subtotal').html('Rs.'+obj.order.price_without_delivery);
           $('#deliveryfee').html('Rs.'+obj.order.delivery_charge);
           $('#total').html('Rs.'+obj.totalprice);

           
           
             $('#orderdetails').modal('show');
         }
      });
}

function cancelorder()
{
   debugger;
   var order_id = $('#orderid').val();
     $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
     $.ajax({
         url: "{{ route('cancelorderload') }}",
         type:"POST",
         data:{order_id: order_id},
         success: function(result){
            var obj = JSON.parse(result);
                $('#orderid').val(obj.orderid);
                $('#orderdetails').modal('hide');
                $('#cancelorderdata').modal('show');
           
          
         }
      });
}
function getcancelorder()
{
     $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            var orderid = $('#orderid').val();
            var cancelreason = $('#cancelreason').val();
        $.ajax({
         url: "{{ route('cancelorder') }}",
         type:"POST",
         data:{orderid:orderid,cancelreason:cancelreason},
         success: function(result){
            if(result == 1)
            {
               alert('Order cancelled successfully') ;
               location.reload();
            }
               
           
          
         }
      });
}
function openrechargediv()
{
    $('#rechargediv').css('display','block');
}
    function getpayment()
    {
        var amountrecharge = $('#amountrecharge').val();
            $.ajaxSetup({
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
            var totalAmount = amountrecharge;
          
            var razorpay_key = "rzp_test_K4YMcaRBxHAFvi";
            var userid = $('#userid').val();
            var options = {
              "key": razorpay_key,
              "amount": (totalAmount*100), // 2000 paise = INR 20
             
              "description": "Payment",
              
              "handler": function (response){
               
                    $.ajax({
                        method: 'post',
                        url: "",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "razorpay_payment_id": response.razorpay_payment_id,
                            "totalAmount":totalAmount,
                            "userid":userid
                        },
                        success: function (result) {
                        var obj = JSON.parse(result);
                        if(obj.code == 200)
                        {  
                        $('#paymentsuccess').html('<div class="alert alert-success">Wallet Recharge Successfully</div>');
                        $('#wallettotamount').html('Total Wallet Amount: Rs.'+obj.walletamount);
                        $('#amountrecharge').val(0);
                           
                        }else
                        {
                            $('#paymentsuccess').html('<div class="alert alert-danger">Wallet Recharge Failed</div>'); 
                        }
                    }
                })
             
                 
                
              },
             "prefill": {
                  "contact": '9988665544',
                  "email":   'devfeedly21@gmail.com',
              },
              "theme": {
                  "color": "#528FF0"
              }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
    }
    
    function reedempoint(reddem)
    {
         var userid = $('#userid').val();
         $.ajax({
                method: 'post',
                url: "{!!route('updatereddempoint')!!}",
                data: {
                    "_token": "{{ csrf_token() }}",
                   
                    "reddem":reddem,
                    "userid":userid
                },
                success: function (result) {
                var obj = JSON.parse(result);
                if(obj.code == 200)
                {  
                    alert(obj.msg);
                   location.reload();
                }else
                {
                   
                }
                }
         });
    }
</script>
<script type="text/javascript">
function setaddress(addressid)
{
   debugger;

    $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
     $.ajax({
      url: "{{ route('setaddress') }}",
         type:"POST",
         data:{addressid: addressid},
         success: function(result){
            if(result == 1)
            {
                alert("Address set as default Successfully");
                location.reload();
            }
          
         }
      });
}
</script>