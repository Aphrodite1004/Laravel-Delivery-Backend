@extends('cityadmin.layout.app')
 
@section ('content')

 <style>
     input[type="file"] {
    background-color:transparent;
    padding:0px;
}

 </style>


<!-- Begin Page Content -->
<div class="container-fluid">
 

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Products</h6>
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
   <div class="panel-body"> 
       {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
        <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12" align="center">
                <div class="form-group">
                    {!! Form::label('sample_file','Bulk Upload:',['class'=>'col-md-3 colst']) !!}<br>
                    <a href="https://i.imgur.com/iVCqeYz.png">click here</a> to know the right format of excel file.
                    <div class="col-md-4">
                    {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                    {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
            <hr>
            </div>
        </div>
       {!! Form::close() !!}
 </div> 
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('add-product')}}">Add single product</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example8" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>S.No</th>
                <th>Coupon Name</th>
                <th>Coupon Code</th>
                <th>Coupon Price</th>
                <th>Coupon Start Date</th>
                <th>Coupon End Date</th>
                <th>Action</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($coupon)>0)
                          @php $i=1; @endphp
                          @foreach($coupon as $cpn)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$cpn->coupon_name}}</td>
                            <td>{{$cpn->coupon_code}}</td>
                             <td>{{$cpn->coupon_value}}</td>
                             <td>{{$cpn->coupon_start_date}}</td>
                             <td>{{$cpn->coupon_end_date}}</td>
                            <td>
                               <a href="{{route('edit-product',$cpn->coupon_id)}}" style="width: 28px; padding-left: 6px;" class="btn btn-info"  style="width: 10px;padding-left: 9px;" style="color: #fff;"><i class="fa fa-edit" style="width: 10px;"></i></a>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$cpn->coupon_id}}"><i class="fa fa-trash"></i></button>
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
@foreach($coupon as $cpn)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$cpn->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete product.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('delete-product', $cpn->coupon_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection