<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Store Page</title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">
      <!-- Google Fonts -->
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
   @include("web.header")
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
      <!-- ======= Services Section ======= -->
      <section id="services" class="services section-bg">
         <div class="container-fluid" style="width: 92.2%;">
         <br>
         <br>
         <br>
         <form method="post" action="{{route('shoplistSearch',$id)}}">
         {{csrf_field()}}
               <div class="input-group" style="margin-top: -7px;">
                 <input type="hidden" name="shop_id" value="{{$id}}">
                 @if($mapset->mapbox == 0 && $mapset->google_map == 1)
                 <div class="form-group">
                  <input type="text" class="form-control store_search" name="shop_name" placeholder="search for shop...." aria-label="Input group example" aria-describedby="btnGroupAddon">
                  </div>
                  @endif
                  @if($mapset->mapbox == 1 && $mapset->google_map == 0)
                  <div class="form-group">
                  <div class="autocomplete" style="width:100%;">
                           <input id="lng" type="hidden" name="lng">
                              <input id="lat" type="hidden" name="lat">
                  <input id="myInput" type="text" class="form-control store_search" name="shop_name" placeholder="search for shop...." aria-label="Input group example" aria-describedby="btnGroupAddon">
                  </div>
                  </div>
                  @endif
                  <div class="input-group-prepend">
                     <div class="input-group-text header_search" id="btnGroupAddon">
                     <input type="submit" class="input-group-text shop_search" id="btnGroupAddon" value="Search">
                     </div>

                  </div>
               </div>
            </form>
            <div class="section-title">
               <h2>Store</h2>
            </div>

      
            <div class="row">
               
            @if($storelist!=null)
            @foreach($storelist as $storelists)
            @if($storelists->ui_type==1)

               <div class="col-lg-4 col-md-6">
                 
                    <div class="icon-box" >
                     <a href="{{url('groceryhome')}}/{{$storelists->vendor_id}}" style="color: black">
                     <div class="icon"><i class="fas fa-store-alt" style="color:#41cf2e;"></i></div>
                     <h4 class="title" style="font-size: 18px;">{{$storelists->vendor_name}}</h4>
                     <p class="description store_font2">{{$storelists->vendor_loc}}</p>
                     <p class="description store_font">Open Now : {{$storelists->opening_time}} till {{$storelists->closing_time}}</p>
                     <p class="description store_font">Distance : {{round($storelists->distance, 2)}} km</p>
                     <p class="description store_font">Phone No : {{$storelists->vendor_phone}}</p>
                     <p class="description store_font"><b> 
                        <span style="color: #41CF2E;">HOME DELIVERY AVAILABLE</span> <br>
                     </b>
                     </p>
                     <p class="description store_font">Online Status : {{$storelists->online_status}}</p>
                      </a>
                  </div>
                 
               </div>
               @elseif($storelists->ui_type==3)
               <div class="col-lg-4 col-md-6">
                 
                 <div class="icon-box" >
                  <a href="{{url('pharmacyhome')}}/{{$storelists->vendor_id}}" style="color: black">
                  <div class="icon"><i class="fas fa-store-alt" style="color:#41cf2e;"></i></div>
                  <h4 class="title" style="font-size: 18px;">{{$storelists->vendor_name}}</h4>
                  <p class="description store_font2">{{$storelists->vendor_loc}}</p>
                  <p class="description store_font">Open Now : {{$storelists->opening_time}} till {{$storelists->closing_time}}</p>
                  <p class="description store_font">Distance : {{round($storelists->distance, 2)}} km</p>
                  <p class="description store_font">Phone No : {{$storelists->vendor_phone}}</p>
                  <p class="description store_font"><b> 
                     <span style="color: #41CF2E;">HOME DELIVERY AVAILABLE</span> <br>
                  </b>
                  </p>
                  <p class="description store_font">Online Status : {{$storelists->online_status}}</p>
                   </a>
               </div>
              
            </div>
            @else
            <div class="col-lg-4 col-md-6">
                 
                 <div class="icon-box" >
                 No Store Found at your location
               </div>
              
            </div>
               @endif

               @endforeach
                      @else
                      <div class="col-lg-4 col-md-6">
                 
                 <div class="icon-box" >
                 No Store Found at your location
               </div>
              
            </div>
                      @endif
            


       


        


        


            


               






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
      $( ".owl-prev").html('<img src="assets/img/l1.png" height="45" style="margin-left:10px;margin-top:30px;" height="55"  class="imgkl2 shadow">');
      $( ".owl-next").html('<img src="assets/img/r2.png" height="45" style="margin-right:10px;margin-top:30px;" height="55" class="imgkl2 shadow">');
   });
   
   
</script>
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