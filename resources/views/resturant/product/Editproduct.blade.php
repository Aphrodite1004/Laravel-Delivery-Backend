@extends('resturant.layout.app')

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
                  <form class="forms-sample" action="{{route('resturantupdateproduct',$product->product_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a Category</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="subcat_name">
                      @foreach($subcat as $subcat)
		          	    <option value="{{$subcat->resturant_cat_id}}" @if($subcat->resturant_cat_id == $product->subcat_id) selected @endif>
		          	        <span style="font-weight:bold">{{$subcat->cat_name}}</span>
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
                      <label for="exampleInputName1">product Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" value="{{$product->description}}">
                    </div>
              
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('resturantproduct')}}" class="btn btn-light">Cancel</a>
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