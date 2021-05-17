<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script async="" src="https://cdn.api.twitter.com/1/urls/count.json?url=http://labs.carsonshold.com/social-sharing-buttons&amp;callback=jQuery111103736574739395315_1556861023185&amp;_=1556861023186"></script>
    
  
  <title>
    gonearby - Deals and Coupons
  </title>
  <meta name="generator" content="#">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="{{url('public/frontcss/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/themify-icons.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/font-awesome.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/animate.min.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/animsition.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/plugins.min.css')}}" rel="stylesheet">
  <link href="{{url('public/frontcss/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">    


  <style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style></head>
  <style>
  @media (min-width: 1200px)
  {
		.container {
			width: 90%;
		}
	.site-wrapper.animsition {
    width: 80%;
    margin-left: 10%;
    border: 4px solid #8080804d;
	box-shadow: 5px 120px 120px grey;

}
}
.search-form.bg-white {
    background-image: linear-gradient(to right, rgba(152, 142, 142, 0.85), orange);
}
.navbar-brand img {
    margin-top: -17px !important;
}
  
   .paypal-button-text {
    display: none !important;
}
 @media screen and (max-width: 400px) {
            #paypal-button-container {
                width: 100% !important;
            }
        }
        
        /* Media query for desktop viewport */
        @media screen and (min-width: 400px) {
            #paypal-button-container {
                width: 250px !important;
            }
        }


.deal-entry.green .offer-discount, .deal-entry.green .bought {
    background-color: #ffffff !important;
}
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}



@media (max-width: 800px)
  {
  .logo {
    padding-bottom: 50px !important;
    }
    .dropdown{
       float:left !important;
    }
}

     @media (min-width: 1200px)
  {
		.container {
			width: 90%;
		}
	.site-wrapper.animsition {
    width: 80%;
    margin-left: 10%;
    border: 4px solid #8080804d;
	box-shadow: 5px 120px 120px orange, darkgrey 20px 120px 120px inset;

}
header {
    width: 80%;
    margin-left: 10%;
}
<!--.search-form.bg-white {-->
<!--    width: 80%;-->
<!--    margin-left: 10%;-->
<!--}-->

.logo {
    margin-left: -30px !important;
    padding-bottom: 50px !important;
    }
    #footer {
    padding-top: 0px !important;
    }
    }
</style>

  <body>
  <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out" style="animation-duration: 0.8s; opacity: 1;">
  	
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ-YSVmQS8h0Pv3hs_YwLZ65ifZqZ23X0&libraries=places"></script>

<script>
    

/* script */
function initialize() {
   var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('location').value = address;
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>






          <!-- /#nav wrap -->
      
      <div class="search-form bg-white">
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <div class="row">
                <div class="col-md-12">
                    <a href="{{route('mainhome')}}" class="navbar-brand logo col-lg-3 col-sm-12">
                        <img src="{{url('public/frontcss/logo.png')}}" alt="" class="img-responsive logo">
                    </a>                
                </div>
              </div>
            </div>
            <!-- /.col 4 -->
            <div class="col-sm-5">
              <form method="post" action="{{route('placelat')}}">
                  {{ csrf_field() }}
               <input type="text" name="search" id="searchInput"  class="form-control">
               <div id="map" style="margin: 0px;">
                                        <div id="infowindow-content">
                                          <img src="" width="16" height="16" id="place-icon">
                                          <span id="place-name"  class="title"></span><br>
                                          <span id="place-address"></span>
                                        </div>
                                          </div>
              
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-raised ripple-effect btn-success btn-block">
                Search stores
              </button>
            </div>
            </form>
            <div class="col-sm-2">
              <a href="{{route('showfav')}}"><i class="fa fa-heart" style="border:none !important; float:right !important;font-size: 36px;    margin-top: 10px;"></i></a>
             
            </div>
             <div class="col-sm-1">
             
              <div class="dropdown" style="float:right;">
                   <img src="{{url($profile->user_image)}}" alt="" style="border-radius: 50%; float:right; width: 58px;height: 58px;"><br>
                  <p align="center">{{$profile->user_name}} &nbsp;<i class="fa fa-angle-down" style="border:none !important"></i></p>
                  <div class="dropdown-content">
                  <a href="{{route('userlogout')}}">Log Out</a>
                  <a href="{{route('mycoupons')}}">My Coupons</a>
                  </div>
                </div>
            </div>
            <!-- /.col 1 -->
          </div>
        </div>
      </div>
         <div class="row"  oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;">
         <div class="col-sm-4">
                <div class="deal-entry  green">
                  <!--<div class="offer-discount">-->
                  <!--  -81%-->
                  <!--</div>-->
                  <div class="image">
                    <a href="#" target="_blank" title="#">
                      <img src="{{url($coupon->coupon_image)}}" alt="#" class="img-responsive" style="width: 100%;height: 146px;">
                    </a>
                  </div>
                  <!-- /.image -->
                     <div class="title">
                    <a href="#" target="_blank" title="ATLETIKA 3 mēnešu abonements">
                      {{$coupon->coupon_name}}
                    </a>
                  </div>
                  <div class="entry-content">
                    <div class="prices clearfix">
                      <p><b>discount:</b>{{$coupon->coupon_discount}}</p>
                      
                      <p>{{$coupon->description}}</p>
                    </div>
                    
                  </div>
                  <!--/.entry content -->
                  <footer class="info_bar clearfix">
                    <ul class="unstyled list-inline row">
                     <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                     {{ csrf_field() }}
                          <input type="hidden" name="cmd" value="_xclick" />
                          <input type="hidden" name="business" value="nb@tecmanic.com" />
                          <input type="hidden" name="quantity" value="1" />
                          <input type="hidden" name="item_name" value="{{$coupon->description}}" />
                          <input type="hidden" name="item_number" value="{{$coupon->coupon_id}}" />
                          <input type="hidden" name="amount" value="{{$coupon->price}}" />
                          <input type="hidden" name="shipping" value="0.00" />
                          <input type="hidden" name="no_shipping" value="1" />
                          <input type="hidden" name="cn" value="Comments" />
                          <input type="hidden" name="currency_code" value="USD" />
                          <input type="hidden" name="lc" value="US" />
                          <input type="hidden" name="bn" value="PP-BuyNowBF" />
                          <input type="hidden" name="return" value="{{route('paysuccess',[$coupon->coupon_id])}}" />
                          <input type="hidden" name="cancel_return" value="{{route('payfailed')}}" />
                          <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
                          <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                          <input type="hidden" name="max_uses" value="{{$coupon->coupon_id}}" />
                          <input type="hidden" name="coupon_id" value="{{$coupon->coupon_id}}" />
                        </form>
                    </ul>
                  </footer>
                </div>
              </div>
         
          </div>
   
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscribe our Newsletter</h4>
            </div>
            <div class="modal-body">
				<p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
 


<footer id="footer">
        <div class="btmFooter">
          <div class="container">
            <div class="col-sm-7">
              <p>
                <strong>
                  Copyright 2015 
                </strong>
                gonearby- deals and Coupons template made with
                <i class="ti-heart">
                </i>
                <strong>
                  by gonearby
                </strong>
              </p>
            </div>
            <div class="col-sm-5">
          
            </div>
          </div>
        </div>
      </footer>
 

  	</div>
    <!-- JS files -->
  <script src="{{url('public/frontcss/jquery.min.js.download')}}">
  </script>
 
  <script src="{{url('public/frontcss/bootstrap.min.js.download')}}">
  </script>
  <script src="{{url('public/frontcss/jquery.animsition.min.js.download')}}">
  </script>
  <script src="{{url('public/frontcss/owl.carousel.js.download')}}">
  </script>
  <script src="{{url('public/frontcss/jquery.flexslider-min.js.download')}}">
  </script>
  <script src="{{url('public/frontcss/plugins.js.download')}}">
  </script>
 <script src="{{url('public/frontcss/gonearby.js.download')}}">
  </script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="{{url('public/frontjs/multislider.js')}}"></script> 
<script src="{{url('public/frontjs/multislider.min.js')}}"></script>
  
  
  
</body>
</html>
 <!-- Set up a container element for the button -->
    

    <!-- Include the PayPal JavaScript SDK -->
  
   
