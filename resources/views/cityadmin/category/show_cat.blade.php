@extends('cityadmin.layout.app')

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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('cityadminAddCategory')}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example6" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($cityadminCategory)>0)
          @php $i=1; @endphp
          @foreach($cityadminCategory as $adminCategories)
        <tr>
            <td>{{$i}}</td>
            <td>{{$adminCategories->category_name}}</td>
            
            <td align="center"><img src="{{url($adminCategories->category_image)}}" style="width: 43px;"></td>
              <td>
              <a href="{{route('cityadminEditCategory', [$adminCategories->category_id])}}" class="btn btn-primary">Edit</a>
              <a href="{{route('cityadminDeleteCategory', [$adminCategories->category_id])}}" class="btn btn-danger">Delete</a>
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