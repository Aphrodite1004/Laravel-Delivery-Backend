@extends('vendor.layout.app')
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
                  <h4 class="card-title">{{__('messages.Update_Varient')}}</h4>
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
                  <form class="forms-sample" action="{{route('Updateproductvariant', $varient_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                     <div class="form-group">
                      <label>{{__('messages.varient Image')}}</label>  
                      <label class="image-hover">{{__('messages.product_Image')}} <img src="{{url($product->varient_image)}}"  style="width: 21px;"></label>

                      <div class="input-group col-xs-12">
                         <input type="hidden" name="varient_id" value="{{$varient_id}}">
                         <!-- <input type="hidden" name="product_id" value="{{$product->product_id}}"> -->

                      <input type="file" name="varient_image"  class="file-upload-default">                        
                        </div>
                      </div>
                    
                
                <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" value="{{$product->price}}" placeholder="Enter MRP">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.Strike_Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->strick_price}}" name="strick_price" placeholder="Enter price">
                    </div>  
            
                    <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.Quantity')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->quantity}}" name="quantity" placeholder="Enter quantity of product">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.stock')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->stock}}" name="stock" placeholder="Enter stock quantity in numbers">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.Unit')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->unit}}" name="unit"  placeholder="kg/ltrs/gm/pkts">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.product_Description')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->description}}" name="description" placeholder="{{__('messages.Enter_Description')}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{__('messages.product_Description_arabic')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="description_arabic" placeholder="{{__('messages.product_Description_arabic')}}" value="{{$product->description_arabic}}">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">{{__('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('varient',$product->product_id)}}" class="btn btn-light">{{__('messages.Cancel')}}</a>
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