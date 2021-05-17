@extends('cityadmin.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">



    <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Next day orders</h6>
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
                    <table class="table table-bordered" id="example3" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>City</th>
                        <th>Delivery Date</th>
                        <th>Order Type</th>
                        <th>User Id</th>
                        <th>Assign</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($nextdayorder)>0)
                                      @php $i=1; @endphp
                                      @foreach($nextdayorder as $nextdayorder)
                                      
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$nextdayorder->product_name}}</td>
                                        <td>{{$nextdayorder->order_qty}}</td>
                                         <td>{{$nextdayorder->price}}</td>
                                         <td>{{$nextdayorder->city_name}}</td>
                                        <td>{{$nextdayorder->delivery_date}}</td>
                                        <td>{{$nextdayorder->order_type}}</td>
                                        <td>{{$nextdayorder->user_id}}</td>
                                       <td>
                                            @if($nextdayorder->delivery_boy_id == "N/A")               
                							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$nextdayorder->subs_id}}">Assign</button>
                							
                							 @else
                							 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$nextdayorder->subs_id}}">Assigned/edit<span>
                							 ({{$nextdayorder->delivery_boy_name}})</span></button></button>
                							 @endif
                                         </td>
            
                                    </tr>
                                     <div class="modal fade" id="exampleModal{{$nextdayorder->subs_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                	<div class="modal-dialog" role="document">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h5 class="modal-title" id="exampleModalLabel">Assign Delivery Boy/ Incentive</h5>
                                					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                						<span aria-hidden="true">&times;</span>
                                					</button>
                                			</div>
                                			<!--//form-->
                                			<form action="{{route('assigned')}}" method="post">   
                                			{{csrf_field()}}
                                			<div class="modal-body">
                                			 <div class="form-group">
                                                <label for="exampleFormControlSelect3">choose a Delivery Boy<sup>*</sup></label>
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="delivery_boy_name">
                                                  @foreach($delivery_boy as $delivery_boys)
                                                  @if($delivery_boys->area_id==$nextdayorder->area_id)
                            		          	    <option value="{{$delivery_boys->delivery_boy_id}}"><span style="font-weight:bold">{{$delivery_boys->delivery_boy_name}}</span> 
                            		          	    </option>
                            		          	  @endif
                            		              @endforeach
                                                  
                                                  
                                                </select>
                                                </div>
                                                
                                                  <!--<label for="exampleInputName1">Incentive for this order</label>-->
                                                  <!--<input type="text" class="form-control" id="exampleInputName1" name="incentive" placeholder="Incentive for this order">-->
                                                  <input type="hidden" class="form-control" name="subs_id" value={{$nextdayorder->subs_id}}>
                                                
                                                
                                			</div>
                                			<div class="modal-footer">
                                			    <button type="submit" class="btn btn-success mr-2">Assign</button>
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
      <!-- End of Main Content -->

     


   



@endsection        