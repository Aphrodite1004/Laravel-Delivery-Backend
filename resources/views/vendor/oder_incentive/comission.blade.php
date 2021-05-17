@extends('vendor.layout.app')

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
        <form action="{{ route('searchcomission') }}" method="post">
        {{csrf_field()}}
<input type="date" value="{{Request::input('startdate')}}"  name="startdate" class="form-control" placeholder="{{ __('messages.Enter_Start')}}" style="width: 20%; display: inline;">
<input type="date" value="{{Request::input('enddate')}}"  name="enddate" class="form-control" placeholder="{{ __('messages.Enter_End')}}" style="width: 20%; display: inline;">
    <button type="submit" class="btn btn-success btn-md" value="Search" style="margin-top: -5px;"><i class="fa fa-search"></i></button>
</form>
<div class="img-responsive col-xs-3 text-right">
     @if(isset($_REQUEST["startdate"]) && isset($_REQUEST["enddate"]))
     <b> <a href="{{ route('excelgenerator',['startdate' =>$_REQUEST["startdate"] , 'enddate' => $_REQUEST["enddate"]]) }}">{{ __('messages.Download_Excel_Report')}} </a></b>
    @else
      <b> <a href="{{ route('allexcelgenerator') }}">{{ __('messages.Download_Excel_Report')}}</a></b>
    @endif
    </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.s_n')}}</th>
            <th>{{ __('messages.Order_ID')}}</th>
            <th>{{ __('messages.User_Name')}}</th>
            <th>{{ __('messages.Total_Product_Price')}}</th>
            <th>{{ __('messages.Comission_Price')}}</th>
            <th>{{ __('messages.Order_Date')}}</th>
            <th>{{ __('messages.Payment_Method')}}</th>
            <th>{{ __('messages.Amount_Status')}}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>{{ __('messages.s_n')}}</th>
            <th>{{ __('messages.Order_ID')}}</th>
            <th>{{ __('messages.User_Name')}}</th>
            <th>{{ __('messages.Total_Product_Price')}}</th>
            <th>{{ __('messages.Comission_Price')}}</th>
            <th>{{ __('messages.Order_Date')}}</th>
            <th>{{ __('messages.Payment_Method')}}</th>
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
                                @if($comission->status=="Pending")
                        <a href="{{route('vendorsendrequest',$comission->com_id)}}" <button type="button" class="btn btn-danger">Claim</button></a>
                         
                       @elseif($comission->status==1)
                       <button type="button" disabled class="btn btn-info">In Process</button></a>

                            @else($comission->status=="Paid")
                             <button type="button" disabled class="btn btn-success">Paid by Admin</button></a>

                             @endif
                            </td>
                          
                            
                            
                            
                            

                        </tr>
                        @php $i++; @endphp
                        @endforeach
                      @else
                        <tr>
                          <td>{{ __('messages.No_data_found')}}</td>
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
				<h5 class="modal-title" id="exampleModalLabel">{{ __('messages.Delete_area')}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				{{ __('messages.Are_you_want_to_delete_area')}}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close')}}</button>
				<a href="" class="btn btn-primary">{{ __('messages.Delete')}}</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection