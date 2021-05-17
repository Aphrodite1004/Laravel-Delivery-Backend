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
                  <h4 class="card-title">Add Charges</h4>
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
                  <form class="forms-sample" action="{{url('parcel/editcharge')}}/{{$charge_id}}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}

                    <div class="form-group">
                      <label for="cod">City Name</label>
                      <select class="form-control" name="city_from">
                          <option value="">---Select---</option>
						  @foreach($cities as $city)
                          <option value="{{$city->city_id}}" @if($charge->city_from == $city->city_id) selected @endif>{{$city->city_name}}</option>
						  @endforeach
                      </select>
                    </div>
                    
  
                <div class="form-group">
					<label for="exampleInputName1">Enter Charges</label>
					<input type="text" class="form-control" name="parcel_charge" value="{{$charge->parcel_charge}}" placeholder="Enter Charges">
				</div>

				<div class="form-group">
					<label for="exampleInputName1">Charge Description </label>
					<textarea class="form-control" name="charge_description" placeholder="Charge Description ">{{$charge->charge_description}}</textarea>
				</div>  
             
            
			
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <!--
                    <button class="btn btn-light">Cancel</button>
                    -->
                     <a href="" class="btn btn-light">Cancel</a>
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