@extends('pharmacy.layout.app')
 
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
      <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Products')}}</h6>
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
            <form action="{{ route('searchproduct') }}" method="post">
        {{csrf_field()}}
    <input type="text" value=""  name="productname" class="form-control" placeholder="{{ __('messages.Enter')}} {{ __('messages.Product_name')}}" style="width: 20%; display: inline;">
    <button type="submit" class="btn btn-success btn-md" value="Search" style="margin-top: -5px;"><i class="fa fa-search"></i></button>
</form>
        <a class="btn btn-success m-auto" style="float: right;" href="{{route('pharmacyaddproduct')}}">{{ __('messages.Add_single_product')}}</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example8" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>{{ __('messages.cat_id')}}</th>
            <th>{{ __('messages.product_Name')}}</th>
            <th>{{ __('messages.product_Image')}}</th>
            <th>{{ __('messages.Action')}}</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($product)>0)
                          @php $i=1; @endphp
                          @foreach($product as $products)
                        <tr>
                            <td>{{$products->subcat_id}}</td>
                            <td>{{$products->product_name}}</td>
                           
                            <td align="center"><img src="{{url($products->product_image)}}" style="width: 21px;"></td>
                            <td>
                               <a href="{{route('pharmacyeditproduct',$products->product_id)}}" style="width: 28px; padding-left: 6px;" class="btn btn-info"  style="width: 10px;padding-left: 9px;" style="color: #fff;"><i class="fa fa-edit" style="width: 10px;"></i></a>
							<button type="button" style="width: 28px; padding-left: 6px;" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$products->product_id}}"><i class="fa fa-trash"></i></button>
							
							 <a href="{{route('pharmacyvarient',$products->product_id)}}" style="width: auto; padding: 6px;" class="btn btn-info">Varients</a>
							 <a href="{{route('pharmacyaddon',$products->product_id)}}" style="width: auto; padding: 6px;" class="btn btn-primary">Addons</a>
							</td>
							

                        </tr>
                        @php $i++; @endphp
                        @endforeach
                      @else
                        <tr>
                          <td>{{ __('messages.No_data_found')}}</td>
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
@foreach($product as $products)
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$products->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				Are you want to delete product with all its varient.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a href="{{route('pharmacydeleteproduct', $products->product_id)}}" class="btn btn-primary">Delete</a>
			</div>
		</div>
	</div>
</div>
@endforeach   
@endsection