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
                  <h4 class="card-title">{{ __('messages.Add Coupon')}}</h4>
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
                  <form class="forms-sample" action="{{route('pharmacyupdatecoupon')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Coupon_Name')}}<sup>*</sup></label>
                      <input type="hidden" name="coupon_id"  value="{{$coupon->coupon_id}}">
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->coupon_name}}" name="coupon_name" placeholder="{{ __('messages.Enter')}} {{ __('messages.Coupon_Name')}}">
                    </div>
                    
                    
                
                <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Coupon_Code')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->coupon_code}}"  name="coupon_code" maxlength="6" placeholder="{{ __('messages.Coupon_Code')}}">
                    </div>
                   
                 <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Coupon_Description')}} </label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->coupon_description}}" name="coupon_desc" placeholder="{{ __('messages.Coupon_Description')}}">
                    </div>  
                   
                   <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Start_Date')}}</label>
                      <input type="date" class="form-control" id="exampleInputName1" value="{{date('Y-m-d', strtotime($coupon->start_date))}}" name="valid_to" placeholder="">
                    </div> 
            
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.End_Date')}}</label>
                      <input type="date" class="form-control" id="exampleInputName1" value="{{date('Y-m-d', strtotime($coupon->end_date))}}" name="valid_from" placeholder="">
                    </div>
                    
                 <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Cart_Value')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->cart_value}}" name="cart_value" placeholder="{{ __('messages.Cart_Value')}}">
                    </div> 
                    
                    <div class="form-group">
                      <label for="cod">{{ __('messages.Discount_Value')}}</label>
                      <select class="form-control" name="coupon_type" value="{{$coupon->type}}">
                          <option value="percentage" @if($coupon->type == 'percentage' || $coupon->type == 'Percentage' ||$coupon->type == 'PERCENTAGE') selected @endif>Percentage</option>
                      <option value="price" @if($coupon->type == 'price'|| $coupon->type == 'Price' ||$coupon->type == 'PRICE') selected @endif>Price</option>
                      </select><br>
                      
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->amount}}" name="coupon_discount" placeholder="Enter Amount">
                    </div>
            
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.User_Restriction')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$coupon->uses_restriction}}" name="restriction" placeholder="{{ __('messages.How_Many_times_single_user_Apply_this_coupon')}}">
                    </div>
                    
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
             
                     <a href="{{route('pharmacycouponlist')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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