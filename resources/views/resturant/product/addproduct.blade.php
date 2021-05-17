@extends('resturant.layout.app')
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
                  <h4 class="card-title">{{ __('messages.Add')}} {{ __('messages.Products')}}</h4>
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
                  <form class="forms-sample" action="{{route('resturantaddnewproduct')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.choose_a_category')}}<sup>*</sup></label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="subcat_name">
                      @foreach($subcat as $subcat)
		              <option value="{{$subcat->resturant_cat_id}}"><span style="font-weight:bold">{{$subcat->cat_name}}</span></option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.product_Name')}}<sup>*</sup></label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_name" placeholder="{{ __('messages.Enter')}} {{ __('messages.product_Name')}}">
                    </div>
                     <div class="form-group">
                          <label>{{ __('messages.product_Image')}}</label>  
                      
                      <div class="input-group col-xs-12">
                      <input type="file" name="product_image"  class="file-upload-default">                        
                        </div>
                      </div>
                    
                
                <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.MRP')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="mrp" placeholder="{{ __('messages.Enter')}} {{ __('messages.MRP')}}">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Strick_Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" placeholder="{{ __('messages.Enter')}} {{ __('messages.Strick_Price')}}">
                    </div>  
                   
                   <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Quantity')}}</label>
                      <input type="number" class="form-control" id="exampleInputName1" name="quantity" placeholder="250/500....">
                    </div> 
            
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Unit')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="unit" placeholder="Quator/half/full...">
                    </div>
                    

  
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.product_Description')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="product_description" placeholder="{{ __('messages.Enter_Description')}}">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('resturantproduct')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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