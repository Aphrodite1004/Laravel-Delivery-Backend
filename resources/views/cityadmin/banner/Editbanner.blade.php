@extends('cityadmin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Banner</h4>
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
                  <form class="forms-sample" action="{{route('update-banner',$banner->banner_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                    <label for="exampleFormControlSelect3">category</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="bannerloc_id">
                    <option value="home">Home</option> 
                    <option value="home2">Home-2</option> 
                      @foreach($category as $category)
		          	<option value="{{$category->category_id}}" @if($category->category_id == $banner->bannerloc_id) selected @endif>{{$category->category_name}}</option>
		              @endforeach
                      
                      
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">banner Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$banner->banner_name}}" name="banner_name" placeholder="Enter banner Name">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputName1">Keyword</label>
                      
                      <input type="text" class="form-control" id="exampleInputName1" name="banner_keyword" value="{{$banner->keyword}}">
                    </div>
                     <div class="form-group">
                      <label>banner image</label>
                      
                      <input type="hidden" name="old_banner_image" value="{{$banner->banner_image}}" class="file-upload-default">
                      <div class="input-group col-xs-12">
                      <input type="file" name="banner_image" class="file-upload-default">
                      </div>
                    </div>
                      
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="{{route('banner')}}" class="btn btn-light">Cancel</a>
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