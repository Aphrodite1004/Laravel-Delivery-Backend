@extends('vendor.layout.app')

@section ('content')


        <div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Category_Update')}}</h4>
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
                  <form class="forms-sample" action="{{route('vendorUpdateCategory', [$category->category_id])}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Category_Name')}}</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="category_name" placeholder="category name" value="{{$category->category_name}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.arabic category name')}}</label>
                      <input type="text" class="form-control" id="exampleInputName2" name="category_name_arabic" placeholder="{{ __('messages.arabic category name')}}" value="{{$category->category_name_arabic}}">
                    </div>
                    
                    <div class="form-group">
                      <label>{{ __('messages.Category_Image_Upload')}}</label>
                     
                      <div class="input-group col-xs-12">
                      <input type="file" name="category_image" class="file-upload-default">
                      <input type="hidden" name="vendor_id" value={{$vendor-> vendor_id}}>
                      </div>
                    </div>
                     
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <a href="{{route('vendorcategory')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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