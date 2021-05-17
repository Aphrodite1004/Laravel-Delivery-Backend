@extends('vendor.layout.app')
 
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
      <h6 class="m-0 font-weight-bold text-primary">Low Stock</h6>
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
              <form action="{{ route('searchstock') }}" method="post">
        {{csrf_field()}}
<input type="text" value=""  name="productname" class="form-control" placeholder="Enter Product Name" style="width: 20%; display: inline;">
    <button type="submit" class="btn btn-success btn-md" value="Search" style="margin-top: -5px;"><i class="fa fa-search"></i></button>
</form>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example8" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>S.No</th>
            <th>Product name</th>
            <th>Price</th>
            <th>stock</th>
            <th>varient Description</th>
            <th>Update Stock</th>
            </tr>
          </thead>
    
          <tbody>
          @if(count($product)>0)
                          @php $i=1; @endphp
                          @foreach($product as $products)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$products->product_name}}({{$products->quantity}}{{$products->unit}})</td>
                            <td>{{$products->price}}</td>
                            
                            <td>{{$products->stock}}</td>
                            <td>{{$products->description}}</td>
                            <td align="center">
                                <form action="{{route('update_stock')}}" method="post" class="form">   
                                			{{csrf_field()}}
                        			<div class="modal-body" style="display:flex">
                        				<div class="form-group" style="margin-bottom: 0px;margin-right: 5px;">
                        				    <input type="hidden" value="{{$products->varient_id}}" class="form-control" name="varient_id">
                        				    <input type="text" style="width: 61px;" value="{{$products->stock}}" class="form-control" name="st">
                        				</div>
                        				<button type="submit" class="btn btn-primary">Update</button>
                        			</div>
                        			
                        			</form></td>
                            
                         

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
        {!! $product->links("pagination::bootstrap-4") !!}
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
</div>

@endsection