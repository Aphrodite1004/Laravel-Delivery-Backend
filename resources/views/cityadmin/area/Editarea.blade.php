@extends('cityadmin.layout.app')

@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Update_Area')}}</h4>
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
                  <form class="forms-sample" action="{{route('update-area',$area->area_id)}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Area')}}</label>
                       <input type="hidden" name ="cityadmin_id" value = "{{$cityadmin->cityadmin_id}}">
                      <input type="text" class="form-control" id="exampleInputName1" value="{{$area->area_name}}" name="area_name" placeholder="Enter area Name">
                    </div>
                    
                    
                    </div>
                    
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    
                     <a href="{{route('area')}}" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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