@extends('cityadmin.layout.app')

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
                  <form class="forms-sample" action="{{route('update-delivery_boy',$delivery_boy->delivery_boy_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                 <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.choose_area')}}</label><br>
                  
                    
                    <select style="border:1px solid gray" name="area_id[]" class="form-control" multiple requirment>
                                           <option value="" disabled style="background: #c8c8c8;color: #000;" >--- All ---</option>
                                           <?php 
                                               foreach($delivery_boy_area as $boy_assigns){
                                                   $area_id[] =  $boy_assigns->area_id;
                                               }
                                                foreach($area as $store)
                                                {?>
                                        <option value="<?= $store->area_id ?>" <?php if(in_array($store->area_id, $area_id)){ echo "selected"; } ?>><?= $store->area_name ?></option>
                                                                                    <?php } ?>
                                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Name')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$delivery_boy->delivery_boy_name}}" name="delivery_boy_name" placeholder="{{ __('messages.Delivery_Boy_Name')}}" requirment>
                    </div>
                     <div class="form-group">
                      <label>{{ __('messages.Delivery_Boy_Image')}}</label>
                      
                      <input type="hidden" name="old_delivery_boy_image" value="{{$delivery_boy->delivery_boy_image}}" class="file-upload-default" >
                      <div class="input-group col-xs-12">
                      <input type="file" name="delivery_boy_image" class="file-upload-default" requirment>
                      </div>
                    </div>
                       <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Phone')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="delivery_boy_phone" value="{{$delivery_boy->delivery_boy_phone}}" requirment>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Delivery_Boy_Comission')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="delivery_boy_comission" value="{{$delivery_boy->dboy_comission}}"requirment>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Password')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password1"  placeholder="{{ __('messages.enter_new_password_if_you_want_to_change_the_previous_password')}}" requirment>
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Confirm_Password')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password2"  placeholder="{{ __('messages.Retype_Password')}}" requirment>
                    </div>
                    <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.choose vendor')}}</label><br>
                  
                    
                    <select style="border:1px solid gray" name="vendor_id[]" class="form-control" multiple requirment>
                                           <option value="" disabled style="background: #c8c8c8;color: #000;" >--- All ---</option>
                                           <?php 
                                               foreach($delivery_boy_vendor as $boy_assigns){
                                                   $vendor_id[] =  $boy_assigns->vendor_id;
                                               }
                                                foreach($vendor as $store)
                                                {?>
                                        <option value="<?= $store->vendor_id ?>" <?php if(in_array($store->vendor_id, $vendor_id)){ echo "selected"; } ?>><?= $store->vendor_name ?></option>
                                                                                    <?php } ?>
                                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Update')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('delivery_boy')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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