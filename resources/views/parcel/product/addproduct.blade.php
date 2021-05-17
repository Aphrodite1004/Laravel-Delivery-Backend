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
                  <form class="forms-sample" action="{{route('parceladdnewproduct')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">choose a category<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="subcat_name">
                      @foreach($subcat as $subcat)
		              <option value="{{$subcat->parcel_cat_id}}"><span style="font-weight:bold">{{$subcat->cat_name}}</span></option>
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
                      <label for="exampleInputName1">Strick Price</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" placeholder="Enter price">
                    </div>  
                   
                   <div class="form-group">
                      <label for="exampleInputName1">Quantity</label>
                      <input type="number" class="form-control" id="exampleInputName1" name="quantity" placeholder="250/500....">
                    </div> 
            
                    <div class="form-group">
                      <label for="exampleInputName1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit" placeholder="Quator/half/full...">
                    </div>
                    

  
                    <div class="form-group">
                      <label for="exampleInputName1">product Description</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" placeholder="Enter description">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('vendorproduct')}}" class="btn btn-light">Cancel</a>
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