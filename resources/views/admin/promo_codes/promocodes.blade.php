@extends('admin.layout.app')

@section ('content')


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">City Admin</h6>
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
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('add-cityadmin')}}">Add</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>cityadmin Name</th>
            <th>City-Admin Email</th>
            <th>cityadmin Image</th>
            <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>S.No</th>
            <th>cityadmin Name</th>
            <th>City-Admin Email</th>
            <th>cityadmin Image</th>
            <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          @if(count($cityadmin)>0)
                          @php $i=1; @endphp
                          @foreach($cityadmin as $cityadmins)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$cityadmins->cityadmin_name}}</td>
                            <td>{{$cityadmins->cityadmin_email}}</td>
                            <td align="center"><img src="{{url($cityadmins->cityadmin_image)}}" style="width: 21px;"></td>
                            <td>
                               <a href="{{route('edit-cityadmin',$cityadmins->cityadmin_id)}}" style="width: 28px; padding-left: 6px;" class="btn btn-info"  style="width: 10px;padding-left: 9px;" style="color: #fff;"><i class="fa fa-edit" style="width: 10px;"></i></a>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$cityadmins->cityadmin_id}}"><i class="fa fa-trash"></i></button>
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
@foreach($cityadmin as $cityadmins)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$cityadmins->cityadmin_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete cityadmin</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete cityadmin.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('delete-cityadmin', $cityadmins->cityadmin_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection