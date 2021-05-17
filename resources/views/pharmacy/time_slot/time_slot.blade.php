@extends('pharmacy.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Time_Slot_For_Delivery')}}</h4>
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
                  <form class="forms-sample" action="{{route('pharmacytimeslotupdate')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" class="form-control" name="time_slot_id" value="{{$city->time_slot_id}}">
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.open_Time')}}</label>
                      <input type="time" class="form-control" name="open_hour" value="{{$city->open_hour}}">
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputName1">{{ __('messages.close_Time')}}</label>
                      <input type="time" class="form-control" name="close_hour" value="{{$city->close_hour}}">

                    </div>
                    
                    <div class="form-group">
                      <label>{{ __('messages.Intervals')}}</label>
                      <input type="text" class="form-control" name="time_slot" value="{{$city->time_slot}}">
                    </div>
                    
                
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                 
                     
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