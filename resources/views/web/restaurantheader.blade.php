@if($mapset->mapbox == 1 && $mapset->google_map == 0)
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
    @endif
  @if($mapset->mapbox == 0 && $mapset->google_map == 1)  
 <style>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
      #map {
        height: 100%;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
    </style>
    @endif 

<?php 


$vendorgrocerycat = DB::table('vendor_category')->where('ui_type','=',2)->first();
$vendorcat = DB::table('vendor_category')->where('ui_type','!=',2)->get();
?>

<div class="fixed-top header_fixeder">
   <div class="navbar navbar-expand-lg header_naver">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
         <?php foreach($vendorcat as $service){ ?>
            <?php if($service->ui_type == 1){ ?>
            <li class="nav-item active">
               <a class="nav-link fi_li_a2" href="{{ route('index') }}"><img src="{{ url(''.$service->category_image)}}" style="height: 18px;">{{ $service->category_name }}</a>
            </li>
            <?php }elseif($service->ui_type == 3) {?>
               <li class="nav-item active">
               <a class="nav-link fi_li_a2" href="{{url('pharmacyindex')}}"><img src="{{ url(''.$service->category_image)}}" style="height: 18px;">{{ $service->category_name }}</a>
            </li>
               <?php }else {?>
                  <li class="nav-item active">
               <a class="nav-link fi_li_a2" href="{{url('parcalindex')}}"><img src="{{ url(''.$service->category_image)}}" style="height: 18px;">{{ $service->category_name }}</a>
            </li>
                  <?php }?>

            <?php }?>

         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link fi_li_a2" href="#"><i class="fas fa-exchange-alt"></i> 14-DAY RETURNS</a>
            </li>
            <li class="nav-item">
               <a class="nav-link fi_li_a2" href="#"><i class="fas fa-rupee-sign"></i> CASH ON DELIVERY</a>
            </li>
            <li class="nav-item">
               <a class="nav-link fi_li_a2" href="#"><i class="fab fa-dropbox"></i> 24*7 HELP: 011-4563-3498</a>
            </li>
         </ul>
      </div>
   </div>
   <div class="navbar navbar-expand-lg navtwo_back">
      <div class="navtwo_back2"></div>
      <center ><a class="navbar-brand navtwo_anchor" href="{{url('restaurantindex')}}"><img src="{{ url(''.$vendorgrocerycat->category_image)}}" class="navtwo_animg"><br>{{$vendorgrocerycat->category_name}}</a></center>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 124px;margin-bottom: -2px;">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
             
            </li>
         </ul>
         <ul class="navbar-nav ml-auto" style="margin-right: 55px;">
            <li class="nav-item" >
            <div class="btn-group btngroup_butt" role="group" aria-label="Basic example">
            
                  <form method="POST" action="{{route('restaurantshoplistSearch')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="shop_id" value="{{$id}}">
                    @if($mapset->mapbox == 0 && $mapset->google_map == 1)
                    <div class="input-group-prepend">
                    <input type="text" name="shop_name" placeholder="Search entire store here....." class="demo_store_input" style="width: 418px;">
                  <button class="select_butt56">GO</button>
                 </div>
                     @endif
                  @if($mapset->mapbox == 1 && $mapset->google_map == 0)
                  <div class="input-group-prepend">
                 <input id="lng" type="hidden" name="lng">
                  <input id="lat" type="hidden" name="lat">
                  <input type="text" name="shop_name" id="myInput" placeholder="Search entire store here....." class="demo_store_input" style="width: 418px;">
                  <button class="select_butt56">GO</button>
                  </div>
                  @endif
                  </form>
               </div>
            </li>
            @if(session('userid') == '')
            <li class="nav-item login_li65">
               <center><a class="nav-link link_item19" style="line-height: 18px;" href="{{ route('resturantweblogin')}}" ><img src="{{ url('frontassets/image/user.png') }}" height="20"><br>LOGIN</a></center>
            </li>
            <li class="nav-item login_li65">
               <center><a class="nav-link link_item19" style="line-height: 18px;" href="{{route('resturantsignup')}}" ><img src="{{ url('frontassets/image/user.png') }}" height="20"><br>SIGNUP</a></center>
            </li>
            @else
            <li class="nav-item login_li65"><center><a class="nav-link link_item19" style="line-height: 18px;" data-target="#navbardrop" data-toggle="dropdown" ><img src="{{ url('frontassets/image/user.png') }}" height="20"><br>{{ session('name') }}</a></center>
                <div class="dropdown-menu sm-menu shadow " id="navbardrop" style="position: fixed;top: 89px;left: 74%;">
                  <a class="dropdown-item" href="{{ route('resturantprofile') }}"><i class="fas fa-user"></i> My Profile</a>
                  <a class="dropdown-item" href="{{ route('resturantorder') }}"><i class="fas fa-align-justify"></i> My Order</a>
                  <a class="dropdown-item" href="{{ route('weblogout') }}"><i class="fas fa-lock"></i> logout</a>
               </div>
            </li>
            @endif
            <li class="nav-item cart_li65">
               <center><a class="nav-link link_item19" style="line-height: 18px;" href="#" onclick="getalert()"><img src="{{ url('frontassets/image/cart.png') }}" height="20"><br>CART</a></center>
            </li>
         </ul>
      </div>
   </div>
   <nav class="navbar navbar-expand-sm navbar-light " style="background-color: white !important;height: 40px;padding-left: 143px;border: 1px solid #DCDCDC;">
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      </div>
   </nav>
</div>

<!-- End Header -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel"><span data-toggle="modal" data-target="#login" data-dismiss="modal" style="cursor: pointer;">Login</span> &nbsp;|&nbsp; <span style="color: #1461C9;">Signup</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body" style="padding: 30px 20px 20px 40px">
            <div id="msgdetails"></div>
          
          <form method="POST" action="{{ url('/webregister') }}">
            <div class="input-group" style="margin-top: -7px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="far fa-user-circle"></i></div>
               </div>
               <input type="text" id="username2" class="modal_input2" placeholder="Enter Name..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="username">
            </div>
            <div class="input-group" style="margin-top: 17px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="padding-left: 2.5px;"></i></div>
               </div>
               <input type="text" id="username2" class="modal_input2" placeholder="Enter Mobile Number..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="mobile">
            </div>
            <div class="input-group" style="margin-top: 17px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="far fa-envelope"></i></div>
               </div>
               <input type="text" id="username2" class="modal_input2" placeholder="Enter Email Address..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="email">
            </div>
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="password" id="username2" class="modal_input2" placeholder="Enter Password..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="password">
            </div>
            <div class="input-group" style="margin-top: 17px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="password" id="username2" class="modal_input2" placeholder="Enter Confirm Password..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="confirm_password">
            </div>
            <button class="shadow haeder_button" type="button" id="submit-btn">Sign Up</button>
            <p class="by_sign_up">By signing up, you agree to our Terms And Conditions</p>
            <div class="loader" style="display:none;"></div>
          </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel"><span style="color: #1461C9;" >Login</span> &nbsp;|&nbsp; <span data-toggle="modal" style="cursor: pointer;" data-target="#signup" data-dismiss="modal">Signup</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
             
          <div id="loginmsgdetails"></div>
          <form method="POST" >
            <div class="input-group" style="margin-top: -7px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="padding-left: 2.5px;"></i></div>
               </div>
               <input type="text" id="mobile" class="modal_input2" placeholder="Enter Mobile Number..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="username">
            </div>
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="password" id="password" class="modal_input2" placeholder="Enter Password..." aria-label="Input group example" aria-describedby="btnGroupAddon" name="password">
            </div>
            <button class="shadow haeder_button" id="login-btn" type="button">Log In</button>
            <p class="forgot_header" data-toggle="modal" data-target="#forgot_pass" data-dismiss="modal">Forgot Password? 
            <div class="loader" style="display:none;"></div>
        </form>
         </div>
      </div>
   </div>
</div>
<center></center>

<div class="modal fade" id="verifyotp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel"><span style="color: #1461C9;" >Verify Mobile Number</span> 
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
             <div id="msgdetails"></div>
          <div id="loginmsgdetails"></div>
          <form method="POST" >
            <div class="input-group" style="margin-top: -7px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="padding-left: 2.5px;"></i></div>
               </div>
               <input type="text" id="mobile" class="modal_input2" placeholder="Enter OTP" aria-label="Input group example" aria-describedby="btnGroupAddon" name="verifyotpmobnew">
            </div>
     
            <button class="shadow haeder_button" id="verifyotpmobile-btn" type="button">Submit</button>
            <div class="loader" style="display:none;"></div>
        </form>
         </div>
      </div>
   </div>
</div>
<center></center>
<div class="modal fade" id="forgot_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel">Forgot Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
            <p style="margin-left: 9px;font-weight: 500;font-size: 14px;">Please verify your mobile number</p>
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="text" id="forgotmobile" name="forgotmobile" class="modal_input2" placeholder="Enter your 11 digit mobile number" aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>
            <button style="margin-bottom: 30px;" class="shadow haeder_button" id="forgotpassword">Next</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="forgot_pass_otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel">Forgot Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
             <input type="hidden" name="forgotphone" id="forgotphone">
             <div id="msgdiv"></div>
            <p style="margin-left: 9px;font-weight: 500;font-size: 14px;">OTP</p>
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="text" id="otp" name="otp" class="modal_input2" placeholder="Enter otp" aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>
            <button style="margin-bottom: 30px;" class="shadow haeder_button" onclick="finalotpverify()">Next</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name" id="exampleModalLabel">Update Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
             <input type="hidden" name="updatephone" id="updatephone">
           
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="password" id="newpassword" name="newpassword" class="modal_input2" placeholder="Enter New Password" aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>
           
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <input type="password" id="confirmpassword" name="confirmpassword" class="modal_input2" placeholder="Enter Confirm Password" aria-label="Input group example" aria-describedby="btnGroupAddon">
               <span id="confirmmsg"></span>
            </div>
            <button style="margin-bottom: 30px;" class="shadow haeder_button" onclick="updatepassword()">Next</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
   <div class="modal-dialog" role="document" style="top: 50px;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mix_name2" id="exampleModalLabel"><span >Select Your Location & Store</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 30px 20px 20px 40px">
            <div class="input-group" style="margin-top: -7px;">
               <div class="input-group-prepend">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-mobile-alt" style="padding-left: 2.5px;"></i></div>
               </div>
               <input type="text" id="username2" class="modal_input2" placeholder="Enter Your Pincode..." aria-label="Input group example" aria-describedby="btnGroupAddon">
            </div>
            <div class="input-group " style="margin-top: 17px;">
               <div class="input-group-prepend ">
                  <div class="input-group-text modal_div22" id="btnGroupAddon"><i class="fas fa-key"></i></div>
               </div>
               <select id="username2" class="modal_input2">
                  <option>Select Area</option>
                  <option>Delhi</option>
                  <option>Noida</option>
               </select>
            </div>
            <p class="or_header">OR </p>
            <a href="index.php"><button style="margin-bottom: 17px;outline: none;" class="shadow haeder_button">Submit</button></a>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
   $('.navbar-light .dmenu').hover(function () {
       $(this).find('.sm-menu').first().stop(true).slideDown(150);
   }, function () {
       $(this).find('.sm-menu').first().stop(true).slideUp(105)
   });
   });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@if($mapset->mapbox == 1 && $mapset->google_map == 0)          
<script>

    var geocodingClient = mapboxSdk({accessToken: '{{$mapbox->mapbox_api}}'});

    function autocompleteSuggestionMapBoxAPI(inputParams, callback) {
        geocodingClient.geocoding.forwardGeocode({
            query: inputParams,
            countries: ['In'],
            autocomplete: true,
            limit: 5,
        })
            .send()
            .then(response => {
                const match = response.body;
                callback(match);
            });
    }

    function autocompleteInputBox(inp) {
        var currentFocus;
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);

            // suggestion list MapBox api called with callback
            autocompleteSuggestionMapBoxAPI($('#myInput').val(), function (results) {
                results.features.forEach(function (key) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + key.place_name.substr(0, val.length) + "</strong>";
                    b.innerHTML += key.place_name.substr(val.length);
                    b.innerHTML += "<input type='hidden' data-lat='" + key.geometry.coordinates[1] + "' data-lng='" + key.geometry.coordinates[0] + "'  value='" + key.place_name + "'>";
                    b.addEventListener("click", function (e) {
                        let lat = $(this).find('input').attr('data-lat');
                        let long = $(this).find('input').attr('data-lng');
                        inp.value = $(this).find('input').val();
                        $(inp).attr('data-lat', lat);
                        $(inp).attr('data-lng', long);
                        document.getElementById("lat").value = lat;
                        document.getElementById("lng").value = long;
                        closeAllLists();
                        
                    });
                    a.appendChild(b);
                });
            })
        });


        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    autocompleteInputBox(document.getElementById("myInput"));
</script>





@endif

@if($mapset->mapbox == 0 && $mapset->google_map == 1)          
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
{{-- javascript code --}}
<script src="https://maps.google.com/maps/api/js?key={{$map}}=places&callback=initAutocomplete" type="text/javascript"></script>
<script>
   $(document).ready(function() {
        $("#lat_area").addClass("d-none");
        $("#long_area").addClass("d-none");
   });
</script>
<script>
   google.maps.event.addDomListener(window, 'load', initialize);

   function initialize() {
       var input = document.getElementById('autocomplete');
       var autocomplete = new google.maps.places.Autocomplete(input);
       autocomplete.addListener('place_changed', function() {
           var place = autocomplete.getPlace();
           $('#latitude').val(place.geometry['location'].lat());
           $('#longitude').val(place.geometry['location'].lng());
           $("#lat_area").removeClass("d-none");
           $("#long_area").removeClass("d-none");
       });
   }
</script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{$map}}&libraries=places&callback=initMap"
        async defer></script> 
        
@endif 