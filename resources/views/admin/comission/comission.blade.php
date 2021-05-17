@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Comission_List_Per_Order')}}</h6>
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
              <form action="{{ route('adminsearchcomission') }}" method="post">
        {{csrf_field()}}
<input type="date" value="{{Request::input('startdate')}}"  name="startdate" class="form-control" placeholder="Enter Start" style="width: 20%; display: inline;">
<input type="date" value="{{Request::input('enddate')}}"  name="enddate" class="form-control" placeholder="Enter End" style="width: 20%; display: inline;">
<input type="hidden" value="{{Request::input('vendor_id')}}" name="vendor_id"/>


<select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="vendor_id" style="width: 20%; display: inline;" >
@if(count($orders)>0)
                      @foreach($vendors as $vendor)
		          	<option value="{{$vendor->vendor_id}}" @if($vendor->vendor_id == $orders[0]->vendor_id) selected @endif>{{$vendor->vendor_name}}</option>
		              @endforeach 
                  @else 
                  <option>No data Found</option>

                   @endif     
                    </select>
<button type="submit" class="btn btn-success btn-md" value="Search" style="margin-top: -5px;"><i class="fa fa-search"></i></button>
</form>
<div class="img-responsive col-xs-3 text-right">
     @if(isset($_REQUEST["startdate"]) && isset($_REQUEST["enddate"] ))
     <b> <a href="{{ route('adminexcelgenerator',['startdate' =>$_REQUEST["startdate"] , 'enddate' => $_REQUEST["enddate"] , 'vendor_id' => $_REQUEST["vendor_id"] ]) }}">Download Excel </a></b>
    @else
      <b> <a href="{{ route('adminallexcelgenerator') }}">{{ __('messages.Download_Excel_Report')}}</a></b>
    @endif
    </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.serial no')}}</th>
            <th>{{ __('messages.Order Id')}}</th>
            <th>{{ __('messages.User_Name')}}</th>
            <th>{{ __('messages.Total_Product_Price')}}</th>
            <th>{{ __('messages.Comission_Price')}}</th>
            <th>{{ __('messages.Order_Date')}}</th>
            <th>{{ __('messages.Payment_method')}}</th>
            <th>{{ __('messages.Amount_Status')}}</th>
            
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>{{ __('messages.serial no')}}</th>
            <th>{{ __('messages.Order Id')}}</th>
            <th>{{ __('messages.User_Name')}}</th>
            <th>{{ __('messages.Total_Product_Price')}}</th>
            <th>{{ __('messages.Comission_Price')}}</th>
            <th>{{ __('messages.Order_Date')}}</th>
            <th>{{ __('messages.Payment_method')}}</th>
            <th>{{ __('messages.Amount_Status')}}</th>
            
            
            </tr>
          </tfoot>
          <tbody>
          @if(count($orders)>0)
                          @php $i=1; @endphp
                          @foreach($orders as $comission)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$comission->cart_id}}</td>
                            <td>{{$comission->user_name}}</td>
                            <td>{{$comission->total_price}}</td>
                            <td>{{$comission->comission_price}}</td>
                            <td>{{$comission->order_date}}</td>
                            <td>{{$comission->payment_method}}</td>

                            <td>
                                @if($comission->status==1)
                                <a href="{{route('adminsendrequest',$comission->com_id)}}" <button type="button" class="btn btn-danger">Request Received </button></a>

                                  @elseif($comission->status=="Paid")
                             <button type="button" disabled class="btn btn-success">{{ __('messages.Paid by Admin')}}</button>

                                 @else
                                 <button type="button"disabled class="btn btn-success">Please contact Vendor</button>

                             @endif
                            </td>
                            
                            
                            

                        </tr>
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
<!-- /.container-fluid -->
</div>
</div>
@foreach($orders as $comission)
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete area</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete area.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection