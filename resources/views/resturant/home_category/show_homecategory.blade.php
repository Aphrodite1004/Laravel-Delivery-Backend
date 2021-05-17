@extends('vendor.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Home Categories List</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route("addhomecategory")}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example9" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Home Category Name</th>
            <th align="center">Home Category Order</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>Home Category Name</th>
            <th align="center">Home Category Order</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($cityadminhomeCategory)>0)
          @php $i=1; @endphp
          @foreach($cityadminhomeCategory as $HomeCategory)
        <tr>
            <td>{{$i}}</td>
            <td>{{$HomeCategory->homecat_name}}</td>
            
            <td align="center">{{$HomeCategory->order}}</td>
            <td>
              <a href="{{route('edithomecategory', [$HomeCategory->homecat_id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('deletehomecategory', [$HomeCategory->homecat_id])}}" class="btn btn-danger">Delete</a>
              <a href="{{route('assignhomecategory', [$HomeCategory->homecat_id])}}" class="btn btn-success">Assign</a>
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