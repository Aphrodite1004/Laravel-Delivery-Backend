@extends('admin.layout.app')

@section ('content')
<div class="row">
  
<div class="col-md-3"></div>
		 <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> {{ __('messages.Admin Banner')}}</h4>
                  <!-- <p class="card-description">
                    Basic form elements
                  </p> -->
                  <form class="forms-sample" action="{{route('addnewbanner')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                     @if (count($errors) > 0)
                    @if($errors->any())
                   <div class="alert alert-primary" role="alert">
                  <strong>SUCCESS : </strong>{{$errors->first()}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>
                  @endif
                 @endif
                    <div class="form-group">
                    <label for="exampleFormControlSelect3">{{ __('messages.Select Vendor')}}</label>
                    
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3 " name="vendor_id">
                        <option value="0">No vendor Selected</option>
                      @foreach($vendor as $vendors)
		          	<option value="{{$vendors->vendor_id}}">{{$vendors->vendor_name}}</option>
		              @endforeach
		              
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Banner Name')}}</label>
                      <input type="text" class="form-control" name="banner_name"  id="exampleInputName1" placeholder="{{ __('messages.Banner Name')}}">
                    </div>
                 <div class="form-group">
                      <label>{{ __('messages.Banner Image')}}</label>
                      <div class="input-group col-xs-12">
                        <input type="file" name="city_image" class="file-upload-default">
                      </div>
                    </div>
                    
                  
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                   
                  </form>
                </div>
              </div>
            </div>
  <div class="col-md-3"></div>

</div>
</div>
@endsection