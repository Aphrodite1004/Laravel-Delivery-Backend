@extends('pharmacy.layout.app')
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
                  <h4 class="card-title">{{ __('messages.Update_Varient')}}</h4>
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
                  <form class="forms-sample" action="{{route('pharmacyUpdateproductvariant', $variant_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    
                      <input type="hidden" name="variant_id" value="{{$variant_id}}">

                <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="price" value="{{$product->price}}" placeholder="Enter_MRP">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Strick_Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->strick_price}}" name="strick_price" placeholder="{{ __('messages.Enter_price')}}">
                    </div>  
            
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Quantity')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->quantity}}" name="quantity" placeholder="{{ __('messages.Enter_quantity_of_product')}}">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Unit')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$product->unit}}" name="unit"  placeholder="{{ __('messages.kg_ltrs_gm_pkts')}}">
                    </div>  
                 
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                 
                     <a href="{{route('pharmacyvarient',$product->product_id)}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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