@extends('admin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.User Details')}}</h4>
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
                  <form class="forms-sample" action="{{route('update-users',$user->user_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                    
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.User Name')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$user->user_name}}" name="user_name" placeholder="Enter cityadmin Name">
                    </div>
                     
                     <div class="form-group">
                      <label>{{ __('messages.image')}}</label>
                      
                      <input type="hidden" name="old_user_image" value="{{$user->user_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="user_image" class="file-upload-default">
                      </div>
                    </div>
                       <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.user email')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="user_email" value="{{$user->user_email}}">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.user phone')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="user_phone" value="{{$user->user_phone}}">
                    </div>
                    
                    <!-- <div class="form-group">-->
                    <!--  <label for="exampleInputName1">{{ __('messages.Password')}}</label>-->
                    <!--  <input type="text" class="form-control" id="exampleInputName1" name="user_password" value="{{$user->user_password}}"  placeholder="{{ __('messages.enter_new_password_if_you_want_to_change_the_previous_password')}}">-->
                    <!--</div>-->
                    
                   
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Update')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('edit-users',$user->user_id)}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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