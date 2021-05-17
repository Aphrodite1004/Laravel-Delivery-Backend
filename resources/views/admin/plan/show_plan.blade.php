@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Subcription plans</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('adminAddplan')}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Plan Name</th>
            <th>Days per month</th>
			<th>Description</th>
			<th>skip days</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>Plan Name</th>
            <th>Days per month</th>
			<th>Description</th>
			<th>skip days</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($adminplan)>0)
          @php $i=1; @endphp
          @foreach($adminplan as $adminplan)
        <tr>
            <td>{{$i}}</td>
            <td>{{$adminplan->plans}}</td>
            
            <td align="center">{{$adminplan->days}}</td>
			<td align="center">{{$adminplan->description}}</td>
			<td align="center">{{$adminplan->skip_days}}</td>
              <td>
              <a href="{{route('adminEditplan', [$adminplan->plan_id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('adminDeleteplan', [$adminplan->plan_id])}}" class="btn btn-danger">Delete</a>
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