@extends('parcel.layout.app')
<style>
sup {
    color:red;
    position: initial;
    font-size: 111%;
}
</style>
@section ('content')
<div class="content-wrapper">
          <div class="row">
		  <div class="col-md-2">
		  </div>
            
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('messages.Add_Charges')}}</h4>
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
                  <form class="forms-sample" action="{{route('addcharge')}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="form-group">
                      <label for="cod">{{ __('messages.City_Name')}}</label>
                      <select class="form-control" name="city_from">
                          <option value="">---Select---</option>
						  @foreach($cities as $city)
                          <option value="{{$city->city_id}}">{{$city->city_name}}</option>
						  @endforeach
                      </select>
                    </div>
                    
                <div class="form-group">
					<label for="exampleInputName1">{{ __('messages.Enter_Charges_Per_KM')}}</label>
					<input type="text" class="form-control" name="parcel_charge" placeholder="{{ __('messages.Enter_Charges_Per_KM')}}">
				</div>

				<div class="form-group">
					<label for="exampleInputName1"{{ __('messages.Charge_Description')}}</label>
					<textarea class="form-control" name="charge_description" placeholder="{{ __('messages.Charge_Description')}}"></textarea>
				</div>  
             
            
			
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Submit')}}</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="" class="btn btn-light">{{ __('messages.Cancel')}}</a>
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