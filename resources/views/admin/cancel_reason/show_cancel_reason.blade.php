@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Reason of Cancelling Order')}}</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('adminAddcancel_reason')}}">{{ __('messages.Add')}}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.Reason of Cancelling Order')}}</th>
			<th>{{ __('messages.Reason of Cancel')}}</th>
            <th>{{ __('messages.Action')}}</th>
            </tr>
          </thead>
         
          <tbody>
          @if(count($admincancel_reason)>0)
          @php $i=1; @endphp
          @foreach($admincancel_reason as $admincancel_reason)
        <tr>
            <td>{{$i}}</td>
            <td>{{$admincancel_reason->reason}}</td>
              <td>
              <a href="{{route('adminEditcancel_reason', [$admincancel_reason->res_id])}}" class="btn btn-primary">{{ __('messages.edit')}}</a>
              <a href="{{route('adminDeletecancel_reason', [$admincancel_reason->res_id])}}" class="btn btn-danger">{{ __('messages.Delete')}}</a>
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

@endsection