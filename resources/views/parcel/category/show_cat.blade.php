@extends('parcel.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('parcelAddCategory')}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example6" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Category Name</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>Category Name</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($vendorCategory)>0)
          @php $i=1; @endphp
          @foreach($vendorCategory as $adminCategories)
        <tr>
            <td>{{$i}}</td>
            <td>{{$adminCategories->cat_name}}</td>
            
              <td>
              <a href="{{route('parcelEditCategory', [$adminCategories->resturant_cat_id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('parcelDeleteCategory', [$adminCategories->resturant_cat_id])}}" class="btn btn-danger">Delete</a>
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
        {!! $vendorCategory->links("pagination::bootstrap-4") !!}
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>


@endsection