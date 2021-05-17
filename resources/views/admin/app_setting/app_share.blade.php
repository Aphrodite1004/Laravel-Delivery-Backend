@extends('admin.layout.app')

@section ('content')
<div class="row">
  
<div class="col-md-3"></div>
		 <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.App Share Information')}}</h4>
                 
                  <form class="forms-sample" action="{{route('refferupdate',$reffer->id)}}" method="post" enctype="multipart/form-data">
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
                      <label for="exampleInputName1">{{ __('messages.message')}}</label>
            
                      <input type="text" class="form-control" name="message"  value="{{$reffer->reffer_message}}"  id="exampleInputName1" placeholder="Minimum Cart Value">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Set Min reward value')}}</label>
                      <input type="number" class="form-control" name="min_value"value="{{$reffer->min}}"   id="exampleInputName1" placeholder="Rewards Points">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Set Max reward value')}}</label>
                      <input type="number" class="form-control" name="max_value"value="{{$reffer->max}}"   id="exampleInputName1" placeholder="Rewards Points">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.App Link')}}</label>
                      <input type="text" class="form-control" name="app_link"value="{{$reffer->app_link}}"   id="exampleInputName1" placeholder="App Link">
                    </div>
                  
                  
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.message')}}</button>
                   
                  </form>
                </div>
              </div>
            </div>
  <div class="col-md-3"></div>

</div>
</div>
@endsection