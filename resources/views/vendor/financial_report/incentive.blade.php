@extends('vendor.layout.app')


@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Financial Report</h6>
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
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>S.no.</th>
                        <th>Completed id</th>
                         <th>Cart id</th>
                         <th>User Name</th>
                        <th>Delivery Boy</th>
                        <th>Delivery date</th>
                        <th>Complain</th>
                        <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($inventory)>0)
                                      @php $i=1; @endphp
                                      @foreach($inventory as $inventorys)
                            
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$inventorys->completed_id}}</td>
                                        <td>{{$inventorys->order_cart_id}}</td>
                                        <td>{{$inventorys->user_name}}</td>
                                        <td>{{$inventorys->delivery_boy_name}}({{$inventorys->delivery_boy_phone}})</td>
                                        <td>{{$inventorys->delivery_date}}</td>
                                       
                                        @if($inventorys->complain_name == '')
                                        <td>No Complain</td>
                                        <td><h6 style="border-radius: 10px;background-color: #abffb2;text-align: center;padding: 12px;"><span style="color:white"><b style="color:green">Completed<b></h6></td>
                                        @else
                                        <td>{{$inventorys->complain_name}}</td>
                                        @if($inventorys->settled_amt > 0)
                                        <td><h6 style="border-radius: 10px;background-color: #abffb2;text-align: center;padding: 9px; font-size: 15px;"><span style="color:black"><b>Settled</b></span><br> <span  style="color:slateblue"><b>(rs. {{$inventorys->settled_amt}} )</b></span></h6></td>
                                        @else
                                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$inventorys->completed_id}}">Pay</button></td>
                                        @endif
                                        @endif
                                        
                                        
                                 
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$inventorys->completed_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                	<div class="modal-dialog" role="document">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h5 class="modal-title" id="exampleModalLabel">Pay</h5>
                                					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                						<span aria-hidden="true">&times;</span>
                                					</button>
                                			</div>
                                			<!--//form-->
                                			<form action="{{route('paycustomervendor',$inventorys->order_complain_id)}}" method="post">   
                                			{{csrf_field()}}
                                			<div class="modal-body">
                                                <div class="form-group">
                                                  <label for="exampleInputName1">Pay<sup>*</sup></label>
                                                  <input type="text" class="form-control" id="exampleInputName1" name="pay" value="{{$inventorys->total_price}}">
                                                  <input type="hidden" class="form-control" name="user_id" value="{{$inventorys->user_id}}">
                                                  <input type="hidden" class="form-control" name="complain_id" value="{{$inventorys->complain_id}}">
                                                  <input type="hidden" class="form-control" name="order_complain_id" value="{{$inventorys->order_complain_id}}">
                                                  
                                                
                                                </div>
                                			</div>
                                			<div class="modal-footer">
                                			    <button type="submit" class="btn btn-success mr-2">Mark Paid</button>
                                				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                			</div>
                                			</form>
                                			<!--//form-->
                                		</div>
                                	</div>
                                </div>
                                   
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

      </div>
               

     


   



@endsection        