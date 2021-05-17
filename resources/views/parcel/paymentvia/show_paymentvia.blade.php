@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Payment Mode</h6>
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Payment Mode</th>
            <th>Api Key/ Merchant ID</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @if(count($adminpaymentvia)>0)
          @php $i=1; @endphp
          @foreach($adminpaymentvia as $adminCategories)
        <tr>
            <td>{{$i}}</td>
            <td>{{$adminCategories->payment_mode}}</td>
            <td>{{$adminCategories->Papi_key}}</td>
            <td>@if($adminCategories->status==0)Off
            @else On @endif
            </td>
              <td>
              <a href="{{route('adminEditpaymentvia', [$adminCategories->paymentvia_id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('adminDeletepaymentvia', [$adminCategories->paymentvia_id])}}" class="btn btn-danger">Delete</a>
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


@endsection