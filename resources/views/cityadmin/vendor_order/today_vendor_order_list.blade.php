@extends('cityadmin.layout.app')
<style>
    @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

</style>
@section ('content')

          <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Today orders</h6>
                  @if (count($errors) > 0)
                              @if($errors->any())
                                <div class="alert alert-primary" role="alert">
                                  {{$errors->first()}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                              @endif
                          @endif
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="example2" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                       <th>{{ __('messages.s_n')}}</th>
                        <th>{{ __('messages.Cart_Id')}}</th>
                        <th>{{ __('messages.Total_Price')}}</th>
                        <th>{{ __('messages.Products_Price')}}</th>
                        <th>{{ __('messages.Delivery_charge')}}</th>
                        <th>{{ __('messages.Delivery_Date')}}</th>
                        <th>{{ __('messages.User_Name')}}</th>
                        <th>{{ __('messages.Details')}}</th>
                        <th>{{ __('messages.Assign')}}</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($vendor)>0)
                                      @php $i=1; @endphp
                                      @foreach($vendor as $todayorders)
                                      <?php $current=date('d-m-Y');
                                            if(strtotime($current)==strtotime($todayorders->delivery_date))
                                            {
                                      ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$todayorders->order_id}}</td>
                                        <td>{{$todayorders->total_price}}</td>
                                         <td>{{$todayorders->total_products_mrp}}</td>
                                         <td>{{$todayorders->delivery_charge}}</td>
                                        <td>{{$todayorders->delivery_date}}</td>
                                        <td>{{$todayorders->user_name}}</td>
                                       <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1{{$todayorders->order_id}}">Details</button></td>
                                       <td>
                            @if($todayorders->dboy_id == "0")               
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$todayorders->order_id}}">Assign</button>
							
							 @else
							 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$todayorders->order_id}}">Assigned/edit<span>
                							 ({{$todayorders->delivery_boy_name}})</span></button>
							 @endif
                            </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$todayorders->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                	<div class="modal-dialog" role="document">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy/ Incentive</h5>
                                					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                						<span aria-hidden="true">&times;</span>
                                					</button>
                                			</div>
                                			@if($boy_area_id !='N/A')
                                			<!--//form-->
                                			<form action="{{route('assigned_order')}}" method="post">   
                                			{{csrf_field()}}
                                			<div class="modal-body">
                                			 <div class="form-group">
                                                <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                                                <input type="hidden" name="order_id" value="{{$todayorders->order_id}}">
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                                                  @foreach($delivery_boy as $delivery_boys)
                                                  @if($delivery_boys->area_id==$todayorders->area_id)
                            		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
                            		          	    </option>
                            		          	  @endif
                            		              @endforeach
                                                  
                                                  
                                                </select>
                                                </div>
                                                
                                                  <!--<label for="exampleInputName1">Incentive for this order</label>-->
                                                  <!--<input type="text" class="form-control" id="exampleInputName1" name="incentive" placeholder="Incentive for this order">-->
                                                  <input type="hidden" class="form-control" name="subs_id" value={{$todayorders->order_id}}>
                                                
                                                
                                			</div>
                                			<div class="modal-footer">
                                			    <button type="submit" class="btn btn-success mr-2">Assign</button>
                                				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                			</div>
                                			</form>
                                			<!--//form-->
                                			@else
                                			<h4>Uh-Oh! your delivery boys for this delivery area are offline</h4>
                                			@endif
                                		</div>
                                	</div>
                                </div>
                                
                                
                                
                                
                                
                                
                                    <?php } ?>
                                    @php $i++; @endphp
                                    @endforeach
                                  @else
                                    <tr>
                                      <td>No data found</td>
                                    </tr>
                                  @endif
                                  
                                  
                                   
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          </div>

        </div>
        <!-- /.container-fluid -->
<!--/////////details model//////////-->
@foreach($vendor as $todayorders)

 <div id="printThis">
<div class="modal fade" id="exampleModal1{{$todayorders->order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="container">
     
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    			</div>
        <div class="material-datatables">
              <form role="form" method="post" action="" >
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%" data-background-color="purple">

                
                <tbody>
                    <tr>
                        <td colspan="3">
                            <table class="table">
                                <tr>
                                    <td valign="top" style="width:50%">
                                    <strong> Order Id : </strong> {{$todayorders->cart_id}}
                                    <br />

                                    <strong>  Delivery Date : </strong>{{$todayorders->delivery_date}}
                                    <br />
                                    <strong>  Time Slot : </strong>{{$todayorders->time_slot}}
                                    <br />
                                    </td>
                                    <td  style="width:50%" align="right">
                                        <strong> Delivery Details </strong><br />
                                        <strong>Customer name : </strong>{{$todayorders->user_name}}<br/>
                                        <strong>Contact : </strong>{{$todayorders->user_number}}<br/> 
                                        <strong>Address : </strong> {{$todayorders->address}}<br />
                                     </td>
                                    
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Product Price</th>
                    </tr>
                    @if(count($details)>0)
                            @php $i=1; @endphp
                                      
                          <tr>             
                        @foreach($details as $detailss)
                          @if($detailss->cart_id==$todayorders->cart_id)
                         <td>{{$detailss->product_name}}({{$detailss->quantity}}{{$detailss->unit}})
                            </td>
                            <td>{{$detailss->qty}}</td>
                            <td> 
                            <p><span style="color:grey">{{$detailss->price}}</span></p>
                           </td>
    		          	  @endif
                         </tr>
                            @php $i++; @endphp
                            @endforeach
                          @else
                            <tr>
                              <td>No data found</td>
                            </tr>
                                  @endif
                   
                   
                    <tr>
                        <td colspan="2"><strong class="pull-right">Total Price : </strong></td>
                         <td >
                            <strong class="">{{$todayorders->price_without_delivery}}</strong>
                        </td>
                    </tr><tr>
                        <td colspan="2"><strong class="pull-right">Delivery Charge : </strong></td>
                         <td >
                            <strong class="">+{{$todayorders->delivery_charge}}</strong>
                        </td>
                    </tr>@if($todayorders->paid_by_wallet > 0)
                    <tr>    
                        <td colspan="2"><strong class="pull-right">Paid By Wallet : </strong></td>
                         <td >
                            <strong class="">-{{$todayorders->paid_by_wallet}}</strong>
                        </td>
                    </tr>@endif
                    @if($todayorders->coupon_discount > 0)
                    <tr>    
                        <td colspan="2"><strong class="pull-right">Coupon Discount : </strong></td>
                         <td >
                            <strong class="">-{{$todayorders->coupon_discount}}</strong>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2"><strong class="pull-right">Net Total(Payable) :</strong></td>
                        <td>{{$todayorders->rem_price}}</td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
         <div class="modal-footer">
       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button id="btnPrint" type="button" class="btn btn-default">Print</button>
      </div>
    </div>
    
    <!-- end content-->
</div></div>
                            <!--  end card  -->
	
		</div>
	</div>
</div>

                                
         @endforeach                       
                                
      </div>
      <!-- End of Main Content -->

<script>
    document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
</script>

    


@endsection