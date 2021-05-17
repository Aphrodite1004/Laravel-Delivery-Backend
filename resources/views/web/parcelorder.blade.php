<!DOCTYPE html>
<html>
   <head>
      <title>My Order</title>
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
   @include("web.parcalheader")
      <div class="myord_back78">
         <section id="tabs" class="project-tab">
            <div class="container-fluid myord_cont78">
               <div class="row">
                  <div class="col-sm-3 card shadow-sm" style="border: 0;height: 195px;">
                     <div class="nav nav-tabs" id="nav-tab" role="tablist" style="border-bottom: 0;">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="far fa-check-circle sec_icon43" style="color: green;"></i> Completed</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="far fa-clock sec_icon43" style="color: #FFC107;"></i> On Progress</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="far fa-times-circle sec_icon43" style="color: #DC3545;"></i> Canceled</a>
                     </div>
                  </div>
                  <div class="col-sm-9">
                     <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @if(count($completed)>0) 
                        @foreach($completed as $orders)

                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                                    <div class="col-sm-2">
                                       <img src="{{ url(''.$orders['vendor_logo'])}}" class="shadow-sm myord_imge23">
                                    </div>
                                    <div class="col-sm-10" style="padding-left: 47px;">
                                       <p class="myord_title88">{{ $orders['vendor_name'] }}<span class="myor_del76">Delivered</span></p>
                                       <p class="myord_addr88">{{ $orders['vendor_loc'] }}<span class="myord_addr82"><i class="far fa-clock"></i>{{ $orders['delivery_date'] }}</span></p>
                                       <p class="myord_addr88">ORDER #{{ $orders['order_id'] }}</p>
                                       <p class="myord_viewdt" onclick="getorderdetails({{$orders['order_id']}})">View details</p>
                                    </div>
                                 </div>
                                 <hr class="myord_hr54">
                                 <div class="row" style="margin-bottom: -18px;">
                                    <div class="col-sm-8">
                                    @foreach($orders['data'] as $varient)
                                       <p class="myord_disquan">{{ $varient->product_name }} * {{ $varient->qty }}</p>
                                       @endforeach
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="btn-group" role="group" aria-label="Basic example">
                                          <p class="myord_tpay">Total payment <br>
                                             Rs.{{ $orders['price'] }}
                                          </p>
                                          <button class="shadow-sm reorder"> Reorder</button> &nbsp;<button class="shadow-sm help56"> Help</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           @else
                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                        <div>
                        <center><p style="color:red;">Order Not Found</p></center>
                        </div>
                        </div>
                                 </div>
                              </div>
                      @endif
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @if(count($ongoing)>0)
                        @foreach($ongoing as $orders)

                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                                    <div class="col-sm-2">
                                       <img src="{{ url(''.$orders['vendor_logo'])}}" class="shadow-sm myord_imge23">
                                    </div>
                                    <div class="col-sm-10" style="padding-left: 47px;">
                                       <p class="myord_title88">{{ $orders['vendor_name'] }} <span class="myor_del76" style="background-color: #FFC107;">On Progress</span></p>
                                       <p class="myord_addr88">{{ $orders['vendor_loc'] }} <span class="myord_addr82"><i class="far fa-clock"></i>{{ $orders['delivery_date'] }}</span></p>
                                       <p class="myord_addr88">ORDER #{{ $orders['order_id'] }}</p>
                                       <p class="myord_viewdt" onclick="getorderdetails({{$orders['order_id']}})">View details</p>
                                    </div>
                                 </div>
                                 <hr class="myord_hr54">
                                 <div class="row" style="margin-bottom: -18px;">
                                    <div class="col-sm-8">
                                    @foreach($orders['data'] as $varient)
                                       <p class="myord_disquan">{{ $varient->product_name }} * {{ $varient->qty }}</p>
                                       @endforeach
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="btn-group" role="group" aria-label="Basic example">
                                          <p class="myord_tpay">Total payment <br>
                                          Rs.{{ $orders['price'] }}
                                          </p>
                                          <button class="shadow-sm reorder"> Track</button> &nbsp;<button class="shadow-sm help56"> Help</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           @endforeach
                           @else
                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                        <div>
                        <center><p style="color:red;">Order Not Found</p></center>
                        </div>
                        </div>
                                 </div>
                              </div>
                      @endif
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @if(count($cancel)>0)
                        @foreach($cancel as $orders)

                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                                    <div class="col-sm-2">
                                       <img src="{{ url(''.$orders['vendor_logo'])}}" class="shadow-sm myord_imge23">
                                    </div>
                                    <div class="col-sm-10" style="padding-left: 47px;">
                                       <p class="myord_title88">{{ $orders['vendor_name'] }} <span class="myor_del76" style="background-color: #DB295D;">Cancel order</span></p>
                                       <p class="myord_addr88">{{ $orders['vendor_loc'] }}<span class="myord_addr82"><i class="far fa-clock"></i>{{ $orders['delivery_date'] }}</span></p>
                                       <p class="myord_addr88">ORDER #{{ $orders['order_id'] }}</p>
                                       <p class="myord_viewdt" onclick="getorderdetails({{$orders['order_id']}})">View details</p>
                                    </div>
                                 </div>
                                 <hr class="myord_hr54">
                                 <div class="row" style="margin-bottom: -18px;">
                                    <div class="col-sm-8">
                                    @foreach($orders['data'] as $varient)
                                       <p class="myord_disquan">{{ $varient->product_name }} * {{ $varient->qty }}</p>
                                       @endforeach
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
                                          <p class="myord_tpay">Total payment <br>
                                          Rs.{{ $orders['price'] }}
                                          </p>
                                          <button class="shadow-sm help56"> Help</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           @else
                           <div class="card myord_card23">
                              <div class="container-fluid">
                                 <div class="row">
                        <div>
                        <center><p style="color:red;">Order Not Found</p></center>
                        </div>
                        </div>
                                 </div>
                              </div>
                      @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      @include("web.footer")
      <!-- start popup -->
      <div class="modal fade" id="orderdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                     <div class="modal-dialog modalacc_doc" role="document">
                        <div class="modal-content modalacc_content">
                        <div class="modal-header">
                              <h5 class="modal-title modal_head" id="exampleModalLabel"><i class="fas fa-map-marker-alt" style="color: #F27A35;"></i> View Order</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body" style="padding: 30px 20px 20px 40px">
                              <div class="">
                                 <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"> <i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Delivery Address:</p>
                                       <p class="myaccount_para3" id="username">Kuwar Raman Singh</p>
                                       <p class="myaccount_para2" id="usernumber">9876543210</p>
                                       <p class="myaccount_para" id="useraddress">Your Local Address</p>
                           
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i>  Payment Info :</p>
                                       <p class="myaccount_para4">Status : <span style="color: #f27a35;" id="orderstatus">Ready for Dispatch</span></p>
                                       <p class="myaccount_para">Mode : <span id="paymentmethod">COD</span></p>
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Store Name :</p>
                                       <p class="myaccount_para4" id="storename">R.K trading Company</p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Order Summary :</p>
                                       <p class="myaccount_para4" >Sub-Total : <span style="float: right;" id="subtotal">Rs.1,693</span></p>
                                       <p class="myaccount_para4">Delivery Fee <span style="float: right;" id="deliveryfee">Rs.16</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                       <p class="myaccount_total">Total <span style="float: right;" id="total">Rs.1,712</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                    </div>
                                    <div class="col-xl-12">
                                       <button class="myaccount_cancel" id="orderid" onclick="cancelorder()">Cancel</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal fade" id="cancelorderdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                     <div class="modal-dialog modalacc_doc" role="document">
                        <div class="modal-content modalacc_content">
                           <div class="modal-header">
                              <h5 class="modal-title modal_head" id="exampleModalLabel"><i class="fas fa-map-marker-alt" style="color: #F27A35;"></i> Cancel Order</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body" style="padding: 30px 20px 20px 40px">
                               <form method="POST" action="">
                              <div class="">
                                  
                                 <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                       <select class="form-control" name="cancelreason" id="cancelreason">
                                           <?php foreach($ordercancelfor as $ordercanceldata){ ?>
                                           <option value="{{$ordercanceldata->reason}}">{{$ordercanceldata->reason}}</option>
                                           <?php }?>
                                           </select>
                                    </div>
                                   <button type="button" class="btn btn-primary" id="orderid" onclick="getcancelorder()">Submit</button>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="modal fade" id="orderdet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                     <div class="modal-dialog modalacc_doc" role="document">
                        <div class="modal-content modalacc_content">
                        <div class="modal-header">
                              <h5 class="modal-title modal_head" id="exampleModalLabel"><i class="fas fa-map-marker-alt" style="color: #F27A35;"></i> View Order</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body" style="padding: 30px 20px 20px 40px">
                              <div class="">
                                 <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"> <i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Delivery Address:</p>
                                       <p class="myaccount_para3" id="username1">Kuwar Raman Singh</p>
                                       <p class="myaccount_para2" id="usernumber1">9876543210</p>
                                       <p class="myaccount_para" id="useraddress1">Your Local Address</p>
                           
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i>  Payment Info :</p>
                                       <p class="myaccount_para4">Status : <span style="color: #f27a35;" id="orderstatus1">Ready for Dispatch</span></p>
                                       <p class="myaccount_para">Mode : <span id="paymentmethod1">COD</span></p>
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Store Name :</p>
                                       <p class="myaccount_para4" id="storename1">R.K trading Company</p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                       <p style="font-weight: 500;font-size: 15.5px;"><i class="fas fa-angle-double-right" style="color: #f27a35;"></i> Order Summary :</p>
                                       <p class="myaccount_para4" >Sub-Total : <span style="float: right;" id="subtotal1">Rs.1,693</span></p>
                                       <p class="myaccount_para4">Delivery Fee <span style="float: right;" id="deliveryfee1">Rs.16</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                       <p class="myaccount_total">Total <span style="float: right;" id="total1">Rs.1,712</span></p>
                                       <hr style="border-bottom: 8px solid #F6F6F6">
                                    </div>
                                    <div class="col-xl-12">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                                       <!-- end popup -->

   </body>
</html>
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
<script type="text/javascript">

function orderdetails(orderid)
{
   debugger;
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
            debugger;
            var obj = JSON.parse(result);
           $('#username1').html(obj.address.user_name);
           $('#usernumber1').html(obj.address.user_number);
           $('#useraddress1').html(obj.address.address);
           $('#orderstatus1').html(obj.order.order_status);
           $('#paymentmethod1').html(obj.order.payment_method);
           $('#paymentmethod1').html(obj.order.payment_method);
           $('#orderid1').val(obj.order.order_id);
           $('#storename1').html(obj.store.vendor_name);
           $('#subtotal1').html('Rs.'+obj.order.price_without_delivery);
           $('#deliveryfee1').html('Rs.'+obj.order.delivery_charge);
           $('#total1').html('Rs.'+obj.totalprice);  
             $('#orderdet').modal('show');
         }
      });
}

function getorderdetails(orderid)
{
   debugger;

      $.ajaxSetup({
                     headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
      $.ajax({
         url: "{{ route('parcelorderideatils') }}",
         type:"POST",
         data:{orderid: orderid},
         success: function(result){
            var obj = JSON.parse(result);
           
           $('#username').html(obj.address.destination_name);
           $('#usernumber').html(obj.address.destination_phone);
           $('#useraddress').html(obj.address.destination_houseno+' '+obj.address.destination_landmark+' '+obj.address.destination_city+' '+obj.address.destination_state);
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
   
    

</script>
