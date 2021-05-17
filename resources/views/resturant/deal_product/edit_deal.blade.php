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
                  <h4 class="card-title">{{ __('messages.Update')}} {{ __('messages.Deal')}} {{ __('messages.Products')}}</h4>
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
                  <form class="forms-sample" action="{{route('resturantUpdateDealproduct', $deal_p->deal_product_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="form-group">
                          <label class="bmd-label-floating">{{ __('messages.Select_Product')}}</label>
                          <select name="varient_id" class="form-control">
                              <option disabled selected>{{ __('messages.Select_Product')}}</option>
                              @foreach($deal as $deals)
        		          	<option value="{{$deals->variant_id}}" @if ( $deals->variant_id == $deal_p->variant_id) selected @endif>{{$deals->product_name}} ({{$deals->quantity}}{{$deals->unit}})</option>
        		              @endforeach
                              
                          </select>
                        </div>

                   
                 <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Deal_Price')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$deal_p->deal_price}}" name="deal_price" placeholder="{{ __('messages.Coupon_Description')}}">
                    </div>  
                   
                  
                    
                 
                    
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                    <a href="{{route('resturantdealroduct')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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