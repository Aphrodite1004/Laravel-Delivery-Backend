@extends('admin.layout.app')

@section ('content')



        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
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
            	<form action="{{route('Notification_to_store_Send')}}" method="post">   
    			{{csrf_field()}}
    			
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.notification')}}<sup>*</sup></label>
                      <input type="text" class="form-control" id="exampleInputName1" name="notification_title">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.message')}}<sup>*</sup></label>
                      <textarea class="form-control" id="exampleInputName1" name="notification_text"></textarea>
                    </div>
    			<div class="modal-footer">
    			    <button type="submit" class="btn btn-success mr-2">{{ __('messages.send notification')}}</button>
    			</div>
    			</form>
                                			
                                			
@endsection                                			
                                			