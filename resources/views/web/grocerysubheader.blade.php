<style>
.dropbtn2 {
 border: 0;font-size: 15px;padding-left: 25px;padding-right: 25px;letter-spacing: .6px;background-color: #417DC6;color: white;font-weight: 500;height:40px;
}

.dropdown2 {
  position: relative;
  display: inline-block;
}

.dropdown-content2 {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 201px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content2 a {
  color: black;
  padding: 8px 26px;
  text-decoration: none;
  display: block;
  border-bottom: 1px solid #DDDDDD;
}

.dropdown-content2 a:hover {background-color: #ddd;}

.dropdown2:hover .dropdown-content2 {display: block;}
.dropdown-content2:hover .dropdown-contentnew {display: block;}
.dropdown-contentnew:hover .dropdown-content2 {background-color: #f1f1f1;}
.dropdown-contentnew
{
  position: absolute; left: 200px; top: 0; display: none;
   color: black; background-color: #f1f1f1;
   min-width: 201px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  
}
  .loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  margin-left: 150px;
  animation: spin 2s linear infinite;
   
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
<?php 
$vendorgrocerycat = DB::table('vendor_category')->where('ui_type','=',1)->first();
$vendorcat = DB::table('vendor_category')->where('ui_type','!=',1)->get();

  function getTableWhere($table,$where) {

   $data = \DB::table($table)
       ->select(\DB::raw('*'))
       ->where($where)
       ->get();

   return $data;
}
$where= array('user_id'=> session('userid'));

$cartdata = getTableWhere('cart',$where);
$path = base_path();
$productsearch = DB::table('product')->select('product_name')->where('vendor_id',$storeid)->get();
?>
<div class="fixed-top header_fixeder">
   <div class="navbar navbar-expand-lg header_naver">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
         <?php foreach($vendorcat as $service){ ?>
            <?php if($service->ui_type == 2){ ?>
            <li class="nav-item active">
               <a class="nav-link fi_li_a2" href="{{url('restaurantindex')}}"><img src="{{ url(''.$service->category_image)}}" style="height: 18px;">{{ $service->category_name }}</a>
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
      <center ><a class="navbar-brand navtwo_anchor" href="{{ route('index') }}"><img src="{{ url(''.$vendorgrocerycat->category_image)}}" class="navtwo_animg"><br>{{$vendorgrocerycat->category_name}}</a></center>
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
                  <div class="dropdown2">
                  <button class="btngroup_select">ALL&nbsp;<i class="fas fa-angle-down" style="position: relative;top: 1px;"></i></button>
                  <div class="dropdown-content2">
                     <?php 
                     $category = DB::table('tbl_category')->where('vendor_id',$storeid)->get();

                     $countdata = count($category);foreach($category as $key => $category){?>
                     <div  id="maincat<?php echo $key;?>">
                     <a href="#">
                     <span onclick="getsub('<?php echo $category->category_id;?>','<?php echo $key;?>',<?php echo $countdata;?>,<?php echo $storeid;?>)"><?php echo $category->category_name;?></span>
                        <div class="dropdown-contentnew" id="subcat<?php echo $key;?>">
                        </div>
                        </a>
                        
                    </div>
                     
                     <?php }?></div>
                  </div>
                  <form method="POST" action="{{ route('grocerysearchcategory') }}">
                    {{csrf_field()}}
                    <div class="input-group-prepend">
                    <input type="text" name="category" id="tags" placeholder="Search entire product here....." class="demo_store_input">
                  <button class="select_butt56">GO</button>
                 </div>
               
                  </form>
               </div>
            </li>
            @if(session('userid') == '')
            <li class="nav-item login_li65">
            <center><a class="nav-link link_item19" style="line-height: 18px;" href="{{ route('grocerylogin') }}" ><img src="{{ url('frontassets/image/user.png') }}" height="20"><br>LOGIN</a></center>
            </li>
            <li class="nav-item login_li65">
            <center><a class="nav-link link_item19" style="line-height: 18px;" href="{{ route('grocerysignup') }}"><img src="{{ url('frontassets/image/user.png') }}" height="20"><br>SIGNUP</a></center>
            </li>
            <li class="nav-item cart_li65">
               <center><a class="nav-link link_item19" style="line-height: 18px;" href="#" onclick="getalert()"><img src="{{ url('frontassets/image/cart.png') }}" height="20"><br>CART</a></center>
            </li>
            @else
            <li class="nav-item login_li65">
            <a class="nav-link link_item19" style="line-height: 18px;" href="#" data-target="#navbardrop" data-toggle="dropdown">
            <img src="{{ url('frontassets/image/user.png') }}" height="20"><br>
               {{ session('name') }}              
                </a>
               <div class="dropdown-menu sm-menu shadow " id="navbardrop" style="position: fixed;top: 89px;left: 74%;">
                  <a class="dropdown-item" href="{{ route('groceryprofile') }}"><i class="fa fa-user"></i>My Profile</a>
                  <a class="dropdown-item" href="{{ route('groceryorder') }}"><i class="fa fa-user"></i>My Order</a>
                  <a class="dropdown-item" href="{{ route('weblogout') }}"><i class="fa fa-lock"></i>logout</a>
               </div>
            </li>
            <li class="nav-item cart_li65">
            <center><a class="nav-link link_item19" data-toggle="modal" data-target="#cart123" style="line-height: 18px;cursor: pointer;"><img src="{{ url('frontassets/image/cart.png') }}" height="20"><br>CART</a></center>           
             </li>
            @endif
        
         </ul>
      </div>
   </div>
   <nav class="navbar navbar-expand-sm navbar-light " style="background-color: white !important;height: 40px;padding-left: 143px;border: 1px solid #DCDCDC;">
    
   </nav>
</div>

<!-- End Header -->
<div class="modal fade" id="cart123" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Your Cart <small>({{ count($cartdata) }} Products)</small></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
    <div class="row">
    <?php 
               $cartinfo = DB::table('cart')->where(array('user_id' => $where))->get();

               if(count($cartinfo) > 0)
               {
            ?>
        <div class="col-12">
            <div class="table-responsive" style="overflow-x: hidden;">
        
                <table class="table table-striped" >
                   
                    <tbody>
                    <?php
                  
                
                    
                  foreach($cartdata as $cartkey => $cartdata) {

                    $productdetails = DB::table('product_varient')->where(array('product_id' => $cartdata->product_id,'varient_id' => $cartdata->varient_id))->first();
                            
                      if($productdetails != '')
                      {
                          $varientimg = $productdetails->varient_image;
                          $price = $productdetails->price;
                      }else
                      {
                          $varientimg = '';
                          $price = '';
                      }
                      $currency = DB::table('currency')->first();
                     $product = DB::table('product')->where(array('product_id' => $cartdata->product_id))->first();
                     
                    ?>
                        <tr>
                            <td style="width: 10%;"><img src="{{ url(''.$product->product_image)}}" style="height: 45px;width: 70px;" /> </td>
                            <td style="font-weight: 500;font-size: 13px;width: 30%;">{{ $product->product_name }}</td>
                            
                            <td style="width: 40%;">
                            <button class="inner_one2 inner_oneuniquedata{{ $cartkey }}" onclick="getminusdata({{ $cartdata->cart_id }},{{ $cartkey }})" ><i class="fas fa-minus inner_one_i2" ></i></button>
                            <button class="inner_two2 inner_oneuniquedata{{ $cartkey }}" ><span class="inner_two_span2 inner_two_spanuniquedata{{ $cartkey }}">{{ $cartdata->qty }}</span></button>
                            <button class="inner_three2 inner_oneuniquedata{{ $cartkey }}"  onclick="getplusdata('<?php echo $cartdata->cart_id?>','<?php echo $cartkey;?>')" ><i class="fas fa-plus inner_three_i2" ></i></button>
                            </td>
                            <td class="text-right" style="font-size: 13px;font-weight: 500;width: 20%;">{{ $currency->currency_sign }}.{{ $productdetails->price }}</td>
                            <td style="width: 10%;" class="text-right"><button class="btn btn-sm btn-danger" onclick="removecartitem({{ $cartdata->cart_id }})"><i class="fa fa-trash" ></i> </button> </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-md-7"></div>
                   <div class="col-md-5">

                   </div>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                <a href="{{ route('grocerycart') }}">
                    <button class="btn btn-block text-uppercase btn-light" style="height: 35px;font-weight: 500;font-size: 13px;">Go To Cart</button>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                <a href="{{ route('grocerycheckout') }}">
                    <button style="height: 35px;font-size: 13px;font-weight: 500;" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
      <div class="col-12">
            <div class="table-responsive" style="overflow-x: hidden;">
        
                <table class="table table-striped" >
                   
                </table>
              
            </div>
        </div>
        </div>

      <?php  }?>      





</div>
      </div>
      
    </div>
  </div>
</div>
      <style type="text/css">


.category_block li:hover {
    background-color: #007bff;
}
.category_block li:hover a {
    color: #ffffff;
}
.category_block li a {
    color: #343a40;
}
.add_to_cart_block .price {
    color: #c01508;
    text-align: center;
    font-weight: bold;
    font-size: 200%;
    margin-bottom: 0;
}
.add_to_cart_block .price_discounted {
    color: #343a40;
    text-align: center;
    text-decoration: line-through;
    font-size: 140%;
}
.product_rassurance {
    padding: 10px;
    margin-top: 15px;
    background: #ffffff;
    border: 1px solid #6c757d;
    color: #6c757d;
}
.product_rassurance .list-inline {
    margin-bottom: 0;
    text-transform: uppercase;
    text-align: center;
}



      </style>
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
<script type="text/javascript">
  var xyz = [];
  xyz = <?php 
  echo $productsearch; ?>;
  var sercharray = [];
  for(var i= 0; i< xyz.length; i++)
  {
        sercharray.push(xyz[i]['product_name']);
  }
  $( "#tags" ).autocomplete({
      source: sercharray
  });

  function getalert()
  {
    alert('Please Login');
  }
  function getminusdata(cartid,count)
  {
   debugger;
      var data = $('.inner_two_spanuniquedata'+count).html();
      if(data > 0)
      {
         var minusdata = parseInt(data) - 1;
          $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('updateqtycart') }}",
               type:"POST",
               data:{cartid: cartid,data:minusdata},
               success: function(result){
                if(result == 1)
                {
                    $('.inner_two_spanuniquedata'+count).html(minusdata);
                }else 
                {

                }
                }
            });
        
      }else 
      {
         $('.inner_two_spanuniquedata'+count).html(0);
      }
     
   }
   function getplusdata(cartid,count)
   {
  
      var data = $('.inner_two_spanuniquedata'+count).html();
      
      var plusdata = parseInt(data) + 1;


          $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('updateqtycart') }}",
               type:"POST",
               data:{cartid: cartid,data:plusdata},
               success: function(result){
                if(result == 1)
                {
                    $('.inner_two_spanuniquedata'+count).html(plusdata);
                }else 
                {

                }
                }
            });
    }
    function removecartitem(cartid)
    {
      debugger;
         $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('removecartitem') }}",
               type:"POST",
               data:{cartid: cartid},
               success: function(result){
                    if(result == 1)
                    {
                      alert('Item Remove From Cart Successfully');
                      location.reload();
                    }else
                    {
                      alert('Somthing Went Wrong');
                      location.reload();
                    }
                }
            });
    }
    function getsub(catid,count,maincatcount,storeid)
  {
          $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
               url: "{{ route('grocerygetsubcat') }}",
               type:"POST",
               data:{catid: catid,storeid:storeid},
               success: function(result){
                  for(var j=0;j <= maincatcount; j++)
                  {
                    $('#subcat'+j).empty();
                    if(count == j)
                    { 
                      $('#subcat'+j).html(result);
                      $('#maincat'+j).css('background-color','skyblue');
                    }else 
                    {
                      // $('#subcat'+j).css('display','none');
                      $('#maincat'+j).css('background-color','#f1f1f1');
                    }
                  }
                  
               }
            });

  }
  function  geturlproduct(cat_id,storeid) {
     //local
    var url = "https://thecodecafe.in/hybrid_resturant/productdetail/"+cat_id+"?storeid="+storeid+"";
    //server
    window.location.href=url;
   
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 