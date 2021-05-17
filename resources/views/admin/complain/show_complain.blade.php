@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Order Complaints')}}</h6>
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
        <!--<a class="btn btn-success m-auto" style="float: right;" href="{{route('add-cityadmin')}}">Add</a>-->
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
          <th>{{ __('messages.serial no')}}</th>
            <th>{{ __('messages.Customer Name')}}</th>
			<th>{{ __('messages.Customer Number')}}</th>
            <th>{{ __('messages.Order Id')}}</th>
            <th>{{ __('messages.Vendor Name')}}</th>
            <th>{{ __('messages.Vendor Mobile')}}</th>
            <th>{{ __('messages.Resaon')}}</th>
            <th>{{ __('messages.Cancel Date | Time')}}</th>
            </tr>
          </thead>
         
          <tbody>
          @if(count($com_orders)>0)
                          @php $i=1; @endphp
                         @foreach($com_orders as $admincomplains)
                        <tr>
                        <td>{{$i}}</td>
                        <td>{{$admincomplains->user_name}}</td>
                        <td>{{$admincomplains->user_phone}}</td>
                        <td>{{$admincomplains->cart_id}}</td>
                        <td>{{$admincomplains->vendor_name}}</td>
                        <td>{{$admincomplains->vendor_phone}}</td>
                        <td>{{$admincomplains->cancelling_reason}}</td>
                        <td>{{$admincomplains->canceled_at}}</td>
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
        {!! $com_orders->links("pagination::bootstrap-4") !!}
      </div>
      </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
</div>
 
@endsection


