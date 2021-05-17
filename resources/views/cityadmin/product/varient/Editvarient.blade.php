@extends('cityadmin.layout.app')

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
                  <form class="forms-sample" action="{{route('cityadminupdate-varient',$product->varient_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      
                     <div class="form-group">
                      <label>Varient image</label>
                      
                      <input type="hidden" name="old_product_image" value="{{$product->varient_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="product_image" class="file-upload-default">
                      </div>
                    </div>
                
                
                <div class="form-group">
                      <label for="exampleInputName1">MRP</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="mrp" value="{{$product->mrp}}">
                    </div>
                <div class="form-group">
                      <label for="exampleInputName1">Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" @if($product->price == NULL) placeholder="Enter price" @else value="{{$product->price}}" @endif >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Size</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="size" @if($product->varient_size == NULL) placeholder="Enter size if any" @else value="{{$product->varient_size}}" @endif>
                    </div> 
            
                    <div class="form-group">
                      <label for="exampleInputName1">Color</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="color"  @if($product->varient_color == NULL) placeholder="Enter color name if any" @else value="{{$product->varient_color}}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Subscription Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="subscription_price" @if($product->subscription_price == NULL) placeholder="Enter Subscription price" @else   value="{{$product->subscription_price}}" @endif>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">Unit quantity</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="qty"  @if($product->varient_unit_value == NULL) placeholder="Enter unit value no." @else value="{{$product->varient_unit_value}}" @endif>
                    </div>
                     
                <div class="form-group">
                      <label for="exampleInputName1">Stock</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="stock" value="{{$product->stock}}" placeholder="Enter stock quantity in numbers">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit" @if($product->varient_unit == NULL) placeholder="KG/Ltr/Pkts/Pcs" @else  value="{{$product->varient_unit}}" @endif>
                    </div>     
                     
                    <div class="form-group">
                      <label for="exampleInputName1">product Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" value="{{$product->varient_desc}}" placeholder="Enter description">
                    </div>
                      
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="" class="btn btn-light">Cancel</a>
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