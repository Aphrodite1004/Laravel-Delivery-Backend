@extends('vendor.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Add_Delivery_Boy')}}</h4>
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
                  <form class="forms-sample" action="{{route('vendorAddNewdelivery_boy')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                     <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.choose_area')}}</label><br>
                  
                     <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." name="area_id[]" required>
                      <option value="" disabled style="background: #f1f1f1;">{{ __('messages.Choose_your_area')}}</option>
                       @foreach($area as $area)
		          	<option value="{{$area->area_id}}">{{$area->area_name}}</option>
		              @endforeach
                    </select>
                        <!--<label class="mdb-main-label">Label example</label>-->
                        <!--<button class="btn-save btn btn-primary btn-sm">Save</button>-->
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Name')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="delivery_boy_name" placeholder="{{ __('messages.Delivery_Boy_Name')}}" required>
                    </div>
                     <div class="form-group">
                      <label>{{ __('messages.Delivery_Boy_Image')}}</label>  
                      
                      <div class="input-group col-xs-12">
                      <input type="file" name="delivery_boy_image"  class="file-upload-default" required>                        
                        </div>
                      </div>
                      
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Phone')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="delivery_boy_phone" placeholder="{{ __('messages.Phone_Number')}}" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Comission')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="delivery_boy_comission" placeholder="{{ __('messages.Comission_in_Percentage')}}" required>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Password')}}</label>
                      <input type="password" class="form-control" id="exampleInputName1" name="password1" placeholder="{{ __('messages.Enter_password')}}" required>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Confirm_Password')}}</label>
                      <input type="password" class="form-control" id="exampleInputName1" name="password2" placeholder="{{ __('messages.Confirm_Password')}}" required>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('vendordelivery_boy')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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
<script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
@endsection