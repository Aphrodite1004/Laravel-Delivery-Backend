@extends('cityadmin.layout.app')
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
                  <h4 class="card-title">Add product</h4>
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
                  <form class="forms-sample" action="{{route('AddNewproduct')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a category<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="subcat_name">
                      @foreach($subcat as $subcat)
		          	<option value="{{$subcat->subcat_id}}"><span style="font-weight:bold">{{$subcat->category_name}}-></span>&nbsp;{{$subcat->subcat_name}}</option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Product Name<sup>*</sup></label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_name" placeholder="Enter product name">
                    </div>
                     <div class="form-group">
                      <label>Product Image</label>  
                      
                      <div class="input-group col-xs-12">
                      <input type="file" name="product_image"  class="file-upload-default">                        
                        </div>
                      </div>
                    
                
                <div class="form-group">
                      <label for="exampleInputName1">MRP</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="mrp" placeholder="Enter MRP">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">Buy Once Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" placeholder="Enter price">
                    </div>  
                   
                   
                    
                 <div class="form-group">
                      <label for="exampleInputName1">Subscription Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="subscription_price" placeholder="Enter price">
                    </div> 
                    
                 <div class="form-group">
                      <label for="exampleInputName1">Member Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="member_price" placeholder="Enter Member Price">
                    </div> 
                
                    <div class="form-group">
                      <label for="exampleInputName1">Quantity</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="qty" placeholder="Enter quantity of product">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Stock</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="stock" placeholder="Enter stock quantity in numbers">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit"  placeholder="kg/ltrs/gm/pkts">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputName1">product Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" placeholder="Enter description">
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