@extends('admin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update City Admin</h4>
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
                  <form class="forms-sample" action="{{route('update-cityadmin',$cityadmin->cityadmin_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">city</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="city_name">
                      @foreach($city as $city)
		          	<option value="{{$city->city_id}}" @if($city->city_id == $cityadmin->city_id) selected @endif>{{$city->city_name}}</option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">cityadmin Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$cityadmin->cityadmin_name}}" name="cityadmin_name" placeholder="Enter cityadmin Name">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">address</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="cityadmin_address" value="{{$cityadmin->cityadmin_address}}">
                    </div>
                     <div class="form-group">
                      <label>cityadmin image</label>
                      
                      <input type="hidden" name="old_cityadmin_image" value="{{$cityadmin->cityadmin_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="cityadmin_image" class="file-upload-default">
                      </div>
                    </div>
                       <div class="form-group">
                      <label for="exampleInputName1">City-Admin Email</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="cityadmin_email" value="{{$cityadmin->cityadmin_email}}">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">City-Admin Phone</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="cityadmin_phone" value="{{$cityadmin->cityadmin_phone}}">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">Password</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password1"  placeholder="enter new password if you want to change the previous password">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">Confirm Password</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="password2"  placeholder="retype password">
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('cityadmin')}}" class="btn btn-light">Cancel</a>
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