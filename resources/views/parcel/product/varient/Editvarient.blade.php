@extends('parcel.layout.app')
<style>
sup {
    color:red;
    position: initial;
    font-size: 111%;
}
</style>
@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Varient</h4>
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
                  <form class="forms-sample" action="{{route('parcelUpdateproductvariant', $variant_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    
                      <input type="hidden" name="variant_id" value="{{$variant_id}}">

                <div class="form-group">
                      <label for="exampleInputName1">Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" value="{{$product->price}}" placeholder="Enter MRP">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">Strick Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->strick_price}}" name="strick_price" placeholder="Enter price">
                    </div>  
            
                    <div class="form-group">
                      <label for="exampleInputName1">Quantity</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->quantity}}" name="quantity" placeholder="Enter quantity of product">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->unit}}" name="unit"  placeholder="kg/ltrs/gm/pkts">
                    </div>  
                 
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                 
                     <a href="{{route('parcelvarient',$product->product_id)}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-2">
		  </div>
     
          </div>
        </div>
       </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
        	$(document).ready(function(){
        	
                $(".des_price").hide();
                
        		$(".img").on('change', function(){
        	        $(".des_price").show();
        			
        	});
        	});
</script>

@endsection