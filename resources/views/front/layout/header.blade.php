<style>

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
.search-form.bg-white {
    width: 80%;
    margin-left: 10%;
}
}
.logo {
    margin-left: -30px !important;
    padding-bottom: 50px !important;
    }
</style>

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
                    <a href="{{route('mainhome')}}" class="navbar-brand logo col-sm-3">
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
            @if(Session::has('user_phone'))
        
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
            @else
            <div class="col-sm-3"  style="float:right;">
                <a href="{{route('login-user')}}" style="float:right;"><img style="width: 220px;" src="{{url('public/login.png')}}"></a>
                </div>
            @endif
            <!-- /.col 1 -->
          </div>
        </div>
      </div>