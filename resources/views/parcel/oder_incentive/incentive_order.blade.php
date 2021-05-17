@extends('parcel.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
         <!-- DataTales Example -->
              <div class="card shadow" style="width:100%">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Delivery Boy Incentive</h6>
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
                    <table class="table table-bordered" id="example5" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                        <th>S.no.</th>
                        <th>Delivery boy Name</th>
                        <th>Delivery boy Id</th>
                        <th>Total Incentive</th>
                        <th>paid Incentive</th>
                        <th>Remaining Incentive</th>
                        <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @if(count($incentive)>0)
                                      @php $i=1; @endphp
                                      @foreach($incentive as $incentive)
                            
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$incentive->delivery_boy_name}}</td>
                                        <td>{{$incentive->delivery_boy_id}}</td>
                                        <td>{{$incentive->total_incentive}}</td>
                                        <td>{{$incentive->paid_incentive}}</td>
                                        <td>{{$incentive->remaining_incentive}}</td>
                                       
                                       <td>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$incentive->delivery_boy_id}}">Pay</button>
							
                            </td>
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$incentive->delivery_boy_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                	<div class="modal-dialog" role="document">
                                		<div class="modal-content">
                                			<div class="modal-header">
                                				<h5 class="modal-title" id="exampleModalLabel">Pay</h5>
                                					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                						<span aria-hidden="true">&times;</span>
                                					</button>
                                			</div>
                                			<!--//form-->
                                			<form action="{{route('pay_incentive')}}" method="post">   
                                			{{csrf_field()}}
                                			<div class="modal-body">
                                                <div class="form-group">
                                                  <label for="exampleInputName1">Pay<sup>*</sup></label>
                                                  <input type="text" class="form-control" id="exampleInputName1" name="pay" placeholder="amount you want to pay">
                                                  <input type="hidden" class="form-control" name="delivery_boy_id" value="{{$incentive->delivery_boy_id}}">
                                                  <input type="hidden" class="form-control" name="paid_incentive" value="{{$incentive->paid_incentive}}">
                                                  <input type="hidden" class="form-control" name="remaining_incentive" value="{{$incentive->remaining_incentive}}">
                                                
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