@extends('cityadmin.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Category Update</h4>
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
                  <form class="forms-sample" action="{{route('cityadminUpdateCategory', [$category->category_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">Category Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="category_name" placeholder="category name" value="{{$category->category_name}}">
                    </div>
                    
                    <div class="form-group">
                      <label>Category Image Upload</label>
                     
                      <div class="input-group col-xs-12">
                      <input type="file" name="category_image" class="file-upload-default">
                      <input type="hidden" name="cityadmin_id" value={{$cityadmin-> cityadmin_id}}>
                      </div>
                    </div>
                     <div class="form-group">
                      <label>Display in Homepage</label></label>
                      <input type="checkbox" name="homecat" value="1" <?php if($category->home==1){?> checked <?php } ?> ><br>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{route('cityadmincategory')}}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
             <div class="col-md-2">
		  </div>
     
          </div>
        </div>
</div>
 @endsection