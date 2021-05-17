@extends('parcel.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Comission List | Per-Order</h6>
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
        <form action="{{ route('parcelsearchcomission') }}" method="post">
        {{csrf_field()}}
<input type="date" value="{{Request::input('startdate')}}"  name="startdate" class="form-control" placeholder="Enter Start" style="width: 20%; display: inline;">
<input type="date" value="{{Request::input('enddate')}}"  name="enddate" class="form-control" placeholder="Enter End" style="width: 20%; display: inline;">
    <button type="submit" class="btn btn-success btn-md" value="Search" style="margin-top: -5px;"><i class="fa fa-search"></i></button>
</form>
<div class="img-responsive col-xs-3 text-right">
     @if(isset($_REQUEST["startdate"]) && isset($_REQUEST["enddate"]))
     <b> <a href="{{ route('parcelexcelgenerator',['startdate' =>$_REQUEST["startdate"] , 'enddate' => $_REQUEST["enddate"]]) }}">Download Excel </a></b>
    @else
      <b> <a href="{{ route('parcelallexcelgenerator') }}">Download Excel Report</a></b>
    @endif
    </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Total Product Price</th>
            <th>Comission Price</th>
            <th>Order Date</th>
            <th>Amount Status</th>
            
            
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Total Product Price</th>
            <th>Comission Price</th>
            <th>Order Date</th>
            <th>Amount Status</th>
            
            
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
                     
                             <td>
                                @if($comission->status=="Pending")
                        <a href="{{route('parcelsendrequest',$comission->com_id)}}" <button type="button" class="btn btn-danger">Claim</button></a>
                         
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