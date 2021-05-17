@extends('cityadmin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update product</h4>
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
                  <form class="forms-sample" action="{{route('update-product',$product->product_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Category</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="subcat_name">
                      @foreach($subcat as $subcat)
		          	    <option value="{{$subcat->subcat_id}}" @if($subcat->subcat_id == $product->subcat_id) selected @endif>
		          	        <span style="font-weight:bold">{{$subcat->category_name}}-></span>&nbsp;
		          	        {{$subcat->subcat_name}}
		          	    </option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">product Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->product_name}}" name="product_name" placeholder="Enter product Name">
                    </div>
                     <div class="form-group">
                      <label>product image</label>
                      
                      <input type="hidden" name="old_product_image" value="{{$product->product_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="product_image" class="file-upload-default">
                      </div>
                    </div>
             
                <div class="form-group">
                      <label for="exampleInputName1">Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" value="{{$product->price}}" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Subscription Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="subscription_price"  value="{{$product->subscription_price}}" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Member Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="member_price" placeholder="Enter Member Price" value="{{$product->membership_price}}">
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputName1">Unit quantity</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="qty" value="{{$product->qty}}">
                    </div>
                     
                <div class="form-group">
                      <label for="exampleInputName1">Stock</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="stock" value="{{$product->stock}}" placeholder="Enter stock quantity in numbers">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit" value="{{$product->unit}}">
                    </div>     
                     
                    <div class="form-group">
                      <label for="exampleInputName1">product Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" value="{{$product->description}}" placeholder="Enter description">
                    </div>
                      
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('product')}}" class="btn btn-light">Cancel</a>
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