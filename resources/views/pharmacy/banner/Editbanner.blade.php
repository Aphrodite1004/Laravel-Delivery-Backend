@extends('pharmacy.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Update')}} {{ __('messages.banner')}}</h4>
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
                  <form class="forms-sample" action="{{route('pharmacyUpdatebannervendor',$banner->banner_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      
                       <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.Categories')}}</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="bannerloc_id">
                   
                      @foreach($category as $category)
		          	<option value="{{$category->resturant_cat_id}}" @if($category->resturant_cat_id == $banner->cat_id) selected @endif>{{$category->cat_name}}</option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                
                     <div class="form-group">
                      <label class="image-hover">{{ __('messages.banner_Image')}} <img src="{{url($banner->banner_image)}}"  style="width: 21px;"></label>
                      <input type="hidden" name="old_banner_image" value="{{$banner->banner_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="banner_image" class="file-upload-default">
                      </div>
                    </div>
                      
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('pharmacybannervendor')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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