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
   </head>
   <body>
   @include("web.groceryheader")
      <div style="background-color: #F5F5F5;">
         <div class="container-fluid con_cont12">
         <form method="POST" action="#">
            {{ csrf_field() }}
            <div class="row">
            <div class="col-sm-12">
                  <div class="card shadow cont_card22">
                     <p class="cont_tellus">My Account</p>
                     <p class="cont_para54">Select Address Type</p>
                     <select class="cont_input54" name="type" id="type" >
                          <option >Select Address Type</option>
                          <option value="Home" >Home</option>
                          <option value="Office" >Office</option>
                          <option value="Other" >Other</option>
                      </select>
                     <p class="cont_para54">Select City</p>
                     <select class="cont_input54" name="city_id" id="city_id" >
                  <option value="">Salect City </option>
                  @foreach($city as $city)
                  <option value="{{$city->city_id}}"><span style="font-weight:bold">{{$city->city_name}}</span></option>
                  @endforeach  
                  </select>
                     <p class="cont_para54">Select near by</p>
                     <select class="cont_input54 unshow" name="area_id" id="area_id" >
                  </select>
                     <p class="cont_para54">House No </p>
                     <input type="text"  id="houseno" class="cont_input54" name="houseno"  value="" placeholder="Enter House No">
                     <p class="cont_para54">Pincode</p>
                     <input type="text"  id="pincode" class="cont_input54" name="pincode"  value="" placeholder="Enter Pincode">
                     <p class="cont_para54">State</p>
                     <input type="text"  id="state" class="cont_input54" name="state"  value="" placeholder="Enter State">
                     <p class="cont_para54">Address Line 1</p>
                     <input type="" class="cont_input54" id="address" name="address" placeholder="Enter Email Address">
                     <button class="cont_mainbtn" style="font-size: 14px;" id="addressinsert">Save Changes</button>

                  </div>
               </div>
       

            </div>
            </form>

         </div>
      </div>
      @include("web.footer")
   </body>
</html>
<script type="text/javascript">
      $(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#addressinsert").click(function(e){
      e.preventDefault();
      debugger;
        var type = $('#type').val();
        var city_id = $('#city_id').val();
        var area_id = $('#area_id').val();
        var houseno = $('#houseno').val();
        var pincode = $('#pincode').val();
        var state = $('#state').val();
        var address = $('#address').val();
        
         $.ajax({
           type:'post',
           url:"{{route('addaddressdetailsdata')}}",
           data:{type:type,city_id:city_id,area_id:area_id,houseno:houseno,pincode:pincode,state:state,address:address},
           success: function(result){
            if(result == 1)
                  {
              alert("Address added Successfully");
             
            }else
                  {
                     alert("Address not save");

            }
           }
         });
      });

    $('select[name="city_id"]').on('change', function() {
        
        var city_id = $(this).val();
                $.ajax({
                    url: "getbyarealist/"+encodeURI(city_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      debugger;
                      if ($.trim(data)){ 
                        var html = "";
                        for(var i=0;i<data.length;i++){ 
                            html+="<option value="+data[i].area_id+">"+data[i].area_name+"</option>";
                        }
                        $("#area_id").html(html);
                        $('.unshow').show();
                      }else{   
                            alert("Area not Exist");
                             $('.unshow').hide();
    
                            }
                        
                    }
                });
           
    });
   });
    </script>